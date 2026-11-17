<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Ensure user is logged in as a customer
        if (!Auth::check() || Auth::user()->role !== 'customer') {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in as a customer to send messages.',
            ], 403);
        }

        // Custom error messages
        $messages = [
            'name.required' => 'Please enter your name.',
            'name.min' => 'Your name must be at least 3 characters long.',
            'name.regex' => 'Your name should only contain letters, spaces, dots, and hyphens.',
            'email.required' => 'Your email is required.',
            'email.email' => 'Please enter a valid email address.',
            'date.required' => 'Please select a date.',
            'subject.required' => 'Subject is required.',
            'subject.min' => 'The subject must have at least 4 characters.',
            'message.required' => 'Don’t forget to write your message.',
            'message.min' => 'Please write at least 15 characters so we can understand your message.'
        ];

        try {
            // Step 1: Check fields one by one in sequence

            // Name
            if (!$request->filled('name')) {
                return response()->json([
                    'success' => false,
                    'errors' => ['name' => [$messages['name.required']]]
                ], 422);
            }
            if (strlen($request->input('name')) < 3) {
                return response()->json([
                    'success' => false,
                    'errors' => ['name' => [$messages['name.min']]]
                ], 422);
            }
            if (!preg_match("/^[A-Za-z\s'.-]+$/", $request->input('name'))) {
                return response()->json([
                    'success' => false,
                    'errors' => ['name' => [$messages['name.regex']]]
                ], 422);
            }

            // Email
            if (!$request->filled('email')) {
                return response()->json([
                    'success' => false,
                    'errors' => ['email' => [$messages['email.required']]]
                ], 422);
            }
            if (!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
                return response()->json([
                    'success' => false,
                    'errors' => ['email' => [$messages['email.email']]]
                ], 422);
            }

            // Date
            if (!$request->filled('date')) {
                return response()->json([
                    'success' => false,
                    'errors' => ['date' => [$messages['date.required']]]
                ], 422);
            }
            if (!strtotime($request->input('date'))) {
                return response()->json([
                    'success' => false,
                    'errors' => ['date' => ['Invalid date format.']]
                ], 422);
            }

            // Subject
            if (!$request->filled('subject')) {
                return response()->json([
                    'success' => false,
                    'errors' => ['subject' => [$messages['subject.required']]]
                ], 422);
            }
            if (strlen($request->input('subject')) < 4) {
                return response()->json([
                    'success' => false,
                    'errors' => ['subject' => [$messages['subject.min']]]
                ], 422);
            }

            // Message
            if (!$request->filled('message')) {
                return response()->json([
                    'success' => false,
                    'errors' => ['message' => [$messages['message.required']]]
                ], 422);
            }
            if (strlen($request->input('message')) < 15) {
                return response()->json([
                    'success' => false,
                    'errors' => ['message' => [$messages['message.min']]]
                ], 422);
            }

            // Step 2: Save message if all passed
            ContactMessage::create([
                'customer_id' => Auth::user()->id,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'date' => $request->input('date'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message'),
                'status' => 'Unread',
                'source' => 'customer-contact-form',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to save message. Please try again later.'
            ], 500);
        }
    }
}