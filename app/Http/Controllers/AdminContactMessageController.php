<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminContactMessageController extends Controller
{
    private function authorizeAccess(): void
    {
        abort_unless(Auth::check() && Auth::user()->hasAdminPermission('manage_contact_messages'), 403);
    }

    public function reply(Request $request, ContactMessage $contactMessage): JsonResponse
    {
        $this->authorizeAccess();

        $validated = $request->validate([
            'reply_message' => ['required', 'string', 'max:5000'],
        ]);

        $contactMessage->fill([
            'reply_message' => trim((string) $validated['reply_message']),
            'replied_at' => now(),
            'replied_by' => Auth::id(),
            'status' => 'Replied',
        ])->save();

        return response()->json([
            'message' => 'Reply saved successfully.',
            'contact_message' => $this->formatContactMessage($contactMessage->fresh(['customer', 'repliedBy'])),
        ]);
    }

    public function markRead(ContactMessage $contactMessage): JsonResponse
    {
        $this->authorizeAccess();

        if ($contactMessage->status !== 'Replied') {
            $contactMessage->status = 'Read';
            $contactMessage->save();
        }

        return response()->json([
            'message' => 'Message marked as read.',
            'contact_message' => $this->formatContactMessage($contactMessage->fresh(['customer', 'repliedBy'])),
        ]);
    }

    public function destroy(ContactMessage $contactMessage): JsonResponse
    {
        $this->authorizeAccess();

        $contactMessage->delete();

        return response()->json([
            'message' => 'Contact message deleted successfully.',
        ]);
    }

    private function formatContactMessage(ContactMessage $contactMessage): array
    {
        $customerName = trim((string) (($contactMessage->customer?->first_name ?? '') . ' ' . ($contactMessage->customer?->last_name ?? '')))
            ?: $contactMessage->name
            ?: 'Customer';
        $repliedByName = trim((string) (($contactMessage->repliedBy?->first_name ?? '') . ' ' . ($contactMessage->repliedBy?->last_name ?? '')))
            ?: null;

        return [
            'db_id' => $contactMessage->id,
            'message_id' => 'MSG-' . str_pad((string) $contactMessage->id, 3, '0', STR_PAD_LEFT),
            'name' => $customerName,
            'email' => $contactMessage->email,
            'date' => $contactMessage->date?->format('Y-m-d') ?? (string) $contactMessage->date,
            'subject' => $contactMessage->subject,
            'message' => $contactMessage->message,
            'status' => $contactMessage->status ?: 'Unread',
            'status_class' => match ((string) $contactMessage->status) {
                'Replied' => 'ok',
                'Read' => 'info',
                'Urgent' => 'bad',
                default => 'warn',
            },
            'reply_message' => $contactMessage->reply_message,
            'reply_date' => $contactMessage->replied_at?->format('Y-m-d h:i A'),
            'reply_by' => $repliedByName,
        ];
    }
}
