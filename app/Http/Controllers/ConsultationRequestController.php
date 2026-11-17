<?php

namespace App\Http\Controllers;

use App\Models\ConsultationMessage;
use App\Models\ConsultationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class ConsultationRequestController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        abort_unless(Auth::check() && Auth::user()->role === 'customer', 403);

        $validated = $request->validate([
            'request_type' => ['required', 'string', 'max:120'],
            'customer_note' => ['required', 'string', 'max:5000'],
        ]);

        $requestKind = 'Consultation';
        $requestType = trim((string) $validated['request_type']);
        $requestNumber = $this->makeRequestNumber();
        $chatThreadId = 'consultation-' . Str::slug($requestNumber, '-');
        $consultationRequest = ConsultationRequest::create([
            'user_id' => Auth::id(),
            'request_number' => $requestNumber,
            'request_kind' => $requestKind,
            'request_type' => $requestType,
            'preferred_date' => null,
            'preferred_time' => null,
            'appointment_mode' => null,
            'contact_number' => null,
            'customer_note' => $validated['customer_note'],
            'status' => 'Pending',
            'chat_thread_id' => $chatThreadId,
        ]);

        ConsultationMessage::create([
            'consultation_request_id' => $consultationRequest->id,
            'sender_user_id' => Auth::id(),
            'sender_role' => 'customer',
            'message' => $validated['customer_note'],
        ]);

        $message = "Your consultation chat request {$requestNumber} has been submitted.";

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'request' => [
                    'id' => $consultationRequest->id,
                    'request_number' => $consultationRequest->request_number,
                    'chat_thread_id' => $consultationRequest->chat_thread_id,
                    'request_kind' => $consultationRequest->request_kind,
                    'request_type' => $consultationRequest->request_type,
                    'customer_note' => $consultationRequest->customer_note,
                ],
            ], 201);
        }

        return redirect()
            ->route('consultations')
            ->with('consultation_request_success', $message);
    }

    public function update(Request $request, ConsultationRequest $consultationRequest): JsonResponse|RedirectResponse
    {
        abort_unless(Auth::check() && in_array(Auth::user()->role, ['admin', 'consultant'], true), 403);

        $validated = $request->validate([
            'action' => ['required', Rule::in(['approve', 'assign', 'reject', 'complete', 'cancel', 'reschedule'])],
            'preferred_date' => ['required_if:action,reschedule', 'nullable', 'date'],
            'preferred_time' => ['required_if:action,reschedule', 'nullable', 'date_format:H:i'],
            'consultant_note' => ['nullable', 'string', 'max:5000'],
            'consultant_id' => ['nullable', 'exists:users,id'],
        ]);

        if (Auth::user()->role === 'consultant') {
            abort_unless($consultationRequest->consultant_id === Auth::id(), 403);
        }

        $consultationRequest->consultant_note = $validated['consultant_note'] ?? $consultationRequest->consultant_note;

        switch ($validated['action']) {
            case 'approve':
                if (empty($validated['consultant_id'])) {
                    throw ValidationException::withMessages([
                        'consultant_id' => 'Please choose a consultant before approving this request.',
                    ]);
                }

                $consultationRequest->consultant_id = (int) $validated['consultant_id'];
                $consultationRequest->status = 'Approved';
                $consultationRequest->approved_at = now();
                break;
            case 'assign':
                if ($consultationRequest->status !== 'Approved') {
                    throw ValidationException::withMessages([
                        'consultant_id' => 'Approve the consultation before assigning a consultant.',
                    ]);
                }

                if (empty($validated['consultant_id'])) {
                    throw ValidationException::withMessages([
                        'consultant_id' => 'Please choose a consultant to assign.',
                    ]);
                }

                $consultationRequest->consultant_id = (int) $validated['consultant_id'];
                break;
            case 'reject':
                $consultationRequest->status = 'Rejected';
                $consultationRequest->rejected_at = now();
                break;
            case 'complete':
                $consultationRequest->status = 'Completed';
                $consultationRequest->completed_at = now();
                break;
            case 'cancel':
                $consultationRequest->status = 'Cancelled';
                $consultationRequest->cancelled_at = now();
                break;
            case 'reschedule':
                $consultationRequest->preferred_date = $validated['preferred_date'];
                $consultationRequest->preferred_time = $validated['preferred_time'];
                $consultationRequest->status = 'Approved';
                $consultationRequest->approved_at = now();
                break;
        }

        $consultationRequest->save();

        $message = 'Consultation request updated successfully.';

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'request' => [
                    'id' => $consultationRequest->id,
                    'request_number' => $consultationRequest->request_number,
                    'status' => $consultationRequest->status,
                    'preferred_date' => $consultationRequest->preferred_date?->format('Y-m-d'),
                    'preferred_time' => $consultationRequest->preferred_time,
                ],
            ]);
        }

        return back()->with('consultation_request_success', $message);
    }

    private function makeRequestNumber(): string
    {
        return 'CON-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));
    }
}
