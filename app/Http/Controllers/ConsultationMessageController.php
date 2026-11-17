<?php

namespace App\Http\Controllers;

use App\Models\ConsultationMessage;
use App\Models\ConsultationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ConsultationMessageController extends Controller
{
    public function store(Request $request, ConsultationRequest $consultationRequest): JsonResponse
    {
        abort_unless(Auth::check(), 403);

        $role = Auth::user()->role;
        abort_unless(in_array($role, ['customer', 'consultant'], true), 403);

        if ($role === 'customer') {
            abort_unless(
                $consultationRequest->user_id === Auth::id()
                && $consultationRequest->consultant_id !== null
                && $consultationRequest->status === 'Approved',
                403
            );
        }

        if ($role === 'consultant') {
            abort_unless($consultationRequest->consultant_id === Auth::id() && $consultationRequest->status === 'Approved', 403);
        }

        $validated = $request->validate([
            'message' => ['required', 'string', 'min:1', 'max:5000'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageDirectory = public_path('images/Consultations');
            if (!File::exists($imageDirectory)) {
                File::makeDirectory($imageDirectory, 0755, true);
            }

            $imageName = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
            $image->move($imageDirectory, $imageName);
            $imagePath = 'images/Consultations/' . $imageName;
        }

        $message = ConsultationMessage::create([
            'consultation_request_id' => $consultationRequest->id,
            'sender_user_id' => Auth::id(),
            'sender_role' => $role,
            'message' => $validated['message'],
            'image_path' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'sender_role' => $message->sender_role,
                'sender_name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                'time' => $message->created_at?->timezone('Asia/Colombo')->format('h:i A') ?? now()->timezone('Asia/Colombo')->format('h:i A'),
                'text' => $message->message,
                'image_path' => $message->image_path,
                'image_url' => $message->image_path ? asset($message->image_path) : null,
            ],
        ]);
    }
}
