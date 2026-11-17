<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        abort_unless(Auth::check() && Auth::user()->role === 'customer', 403);

        $validated = $request->validate([
            'appointment_mode' => ['required', Rule::in(['In-store', 'Video Call'])],
            'appointment_topic' => ['required', 'string', 'max:120'],
            'preferred_date' => ['required', 'date', 'after_or_equal:today'],
            'preferred_time' => ['required', 'date_format:H:i'],
            'contact_number' => ['required', 'string', 'max:30'],
            'customer_note' => ['required', 'string', 'max:5000'],
        ]);

        $preferredDate = Carbon::parse($validated['preferred_date'])->startOfDay();
        $preferredTime = trim((string) $validated['preferred_time']);

        if (!$this->isBookableDate($preferredDate)) {
            throw ValidationException::withMessages([
                'preferred_date' => 'Appointments are available only from Monday to Saturday.',
            ]);
        }

        if (!$this->isBookableTime($preferredTime)) {
            throw ValidationException::withMessages([
                'preferred_time' => 'Please choose one of the 30-minute appointment slots.',
            ]);
        }

        if ($preferredDate->isToday() && $this->isTimeInPast($preferredTime)) {
            throw ValidationException::withMessages([
                'preferred_time' => 'Please choose a future time slot for today.',
            ]);
        }

        if (!$this->isSlotAvailable($preferredDate->toDateString(), $preferredTime)) {
            throw ValidationException::withMessages([
                'preferred_time' => 'That time slot is no longer available. Please choose another one.',
            ]);
        }

        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'appointment_number' => $this->makeAppointmentNumber(),
            'appointment_mode' => $validated['appointment_mode'],
            'appointment_topic' => $validated['appointment_topic'],
            'preferred_date' => $preferredDate->toDateString(),
            'preferred_time' => $preferredTime,
            'contact_number' => $validated['contact_number'],
            'customer_note' => $validated['customer_note'],
            'status' => 'Pending',
        ]);

        $message = "Your appointment request {$appointment->appointment_number} has been submitted.";

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'appointment' => [
                    'id' => $appointment->id,
                    'appointment_number' => $appointment->appointment_number,
                    'appointment_mode' => $appointment->appointment_mode,
                    'appointment_topic' => $appointment->appointment_topic,
                    'preferred_date' => $appointment->preferred_date?->format('Y-m-d'),
                    'preferred_time' => $appointment->preferred_time,
                    'contact_number' => $appointment->contact_number,
                    'customer_note' => $appointment->customer_note,
                ],
            ], 201);
        }

        return redirect()
            ->route('consultations')
            ->with('appointment_success', $message);
    }

    public function update(Request $request, Appointment $appointment): JsonResponse|RedirectResponse
    {
        abort_unless(Auth::check() && in_array(Auth::user()->role, ['consultant', 'customer'], true), 403);

        $validated = $request->validate([
            'action' => ['required', Rule::in(['confirm', 'complete', 'cancel', 'reschedule', 'request-reschedule', 'accept-reschedule', 'reject-reschedule'])],
            'preferred_date' => ['required_if:action,reschedule,request-reschedule', 'nullable', 'date'],
            'preferred_time' => ['required_if:action,reschedule,request-reschedule', 'nullable', 'date_format:H:i'],
            'reschedule_note' => ['nullable', 'string', 'max:5000'],
            'consultant_note' => ['nullable', 'string', 'max:5000'],
        ]);

        if (in_array($validated['action'], ['reschedule', 'request-reschedule'], true)) {
            $preferredDate = Carbon::parse($validated['preferred_date'])->startOfDay();
            $preferredTime = trim((string) $validated['preferred_time']);

            if (!$this->isBookableDate($preferredDate)) {
                throw ValidationException::withMessages([
                    'preferred_date' => 'Appointments are available only from Monday to Saturday.',
                ]);
            }

            if (!$this->isBookableTime($preferredTime)) {
                throw ValidationException::withMessages([
                    'preferred_time' => 'Please choose one of the 30-minute appointment slots.',
                ]);
            }

            if ($preferredDate->isToday() && $this->isTimeInPast($preferredTime)) {
                throw ValidationException::withMessages([
                    'preferred_time' => 'Please choose a future time slot for today.',
                ]);
            }

            if (!$this->isSlotAvailable($preferredDate->toDateString(), $preferredTime, $appointment->id)) {
                throw ValidationException::withMessages([
                    'preferred_time' => 'That time slot is no longer available. Please choose another one.',
                ]);
            }
        }

        $appointment->consultant_note = $validated['consultant_note'] ?? $appointment->consultant_note;

        switch ($validated['action']) {
            case 'confirm':
                $appointment->status = 'Confirmed';
                $appointment->approved_at = now();
                break;
            case 'complete':
                $appointment->status = 'Completed';
                $appointment->completed_at = now();
                break;
            case 'cancel':
                $appointment->status = 'Cancelled';
                $appointment->cancelled_at = now();
                $appointment->reschedule_requested_at = null;
                $appointment->reschedule_responded_at = now();
                $appointment->reschedule_proposed_date = null;
                $appointment->reschedule_proposed_time = null;
                $appointment->reschedule_note = null;
                break;
            case 'reschedule':
            case 'request-reschedule':
                abort_unless(Auth::user()->role === 'consultant', 403);
                $appointment->reschedule_requested_at = now();
                $appointment->reschedule_responded_at = null;
                $appointment->reschedule_proposed_date = $validated['preferred_date'];
                $appointment->reschedule_proposed_time = $validated['preferred_time'];
                $appointment->reschedule_note = $validated['reschedule_note'] ?? null;
                break;
            case 'accept-reschedule':
                abort_unless(Auth::user()->role === 'customer', 403);
                abort_unless((int) $appointment->user_id === (int) Auth::id(), 403);
                abort_unless($appointment->has_pending_reschedule, 422, 'There is no pending reschedule request to accept.');
                $proposedDate = Carbon::parse((string) $appointment->reschedule_proposed_date)->startOfDay();
                $proposedTime = trim((string) $appointment->reschedule_proposed_time);
                if (!$this->isSlotAvailable($proposedDate->toDateString(), $proposedTime, $appointment->id)) {
                    throw ValidationException::withMessages([
                        'preferred_time' => 'That proposed slot is no longer available.',
                    ]);
                }
                $appointment->preferred_date = $proposedDate->toDateString();
                $appointment->preferred_time = $proposedTime;
                $appointment->status = 'Confirmed';
                $appointment->approved_at = now();
                $appointment->reschedule_requested_at = null;
                $appointment->reschedule_responded_at = now();
                $appointment->reschedule_proposed_date = null;
                $appointment->reschedule_proposed_time = null;
                $appointment->reschedule_note = null;
                break;
            case 'reject-reschedule':
                abort_unless(Auth::user()->role === 'customer', 403);
                abort_unless((int) $appointment->user_id === (int) Auth::id(), 403);
                abort_unless($appointment->has_pending_reschedule, 422, 'There is no pending reschedule request to reject.');
                $appointment->status = 'Cancelled';
                $appointment->cancelled_at = now();
                $appointment->reschedule_requested_at = null;
                $appointment->reschedule_responded_at = now();
                $appointment->reschedule_proposed_date = null;
                $appointment->reschedule_proposed_time = null;
                $appointment->reschedule_note = null;
                break;
        }

        $appointment->save();

        $message = 'Appointment updated successfully.';

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'appointment' => [
                    'id' => $appointment->id,
                    'appointment_number' => $appointment->appointment_number,
                    'status' => $appointment->status,
                    'preferred_date' => $appointment->preferred_date?->format('Y-m-d'),
                    'preferred_time' => $appointment->preferred_time,
                ],
            ]);
        }

        return back()->with('appointment_success', $message);
    }

    private function makeAppointmentNumber(): string
    {
        return 'APT-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));
    }

    private function isBookableDate(Carbon $date): bool
    {
        $dayOfWeekIso = (int) $date->dayOfWeekIso;

        return $dayOfWeekIso >= 1 && $dayOfWeekIso <= 6;
    }

    private function isBookableTime(string $time): bool
    {
        return in_array($time, $this->appointmentSlotTimes(), true);
    }

    private function isTimeInPast(string $time): bool
    {
        return Carbon::createFromFormat('H:i', $time)->lessThanOrEqualTo(Carbon::createFromFormat('H:i', now()->format('H:i')));
    }

    private function isSlotAvailable(string $date, string $time, ?int $ignoreAppointmentId = null): bool
    {
        return !Appointment::query()
            ->where(function ($query) use ($date, $time) {
                $query->where(function ($preferredQuery) use ($date, $time) {
                    $preferredQuery->whereDate('preferred_date', $date)
                        ->where('preferred_time', $time)
                        ->where('status', '!=', 'Cancelled');
                })->orWhere(function ($proposalQuery) use ($date, $time) {
                    $proposalQuery->whereDate('reschedule_proposed_date', $date)
                        ->where('reschedule_proposed_time', $time)
                        ->where('status', '!=', 'Cancelled')
                        ->whereNull('reschedule_responded_at');
                });
            })
            ->when($ignoreAppointmentId, fn ($query) => $query->where('id', '!=', $ignoreAppointmentId))
            ->exists();
    }

    private function appointmentSlotTimes(): array
    {
        $slots = [];

        for ($hour = 8; $hour < 16; $hour++) {
            $slots[] = sprintf('%02d:00', $hour);
            $slots[] = sprintf('%02d:30', $hour);
        }

        return $slots;
    }
}
