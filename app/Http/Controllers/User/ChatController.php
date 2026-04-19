<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Consultation $consultation)
    {
        $user = request()->user();

        // Enhanced access check with proper psychologist relationship
        $hasAccess = false;

        if ($user) {
            // Check if user is the consultation client
            if ($consultation->user_id === $user->id) {
                $hasAccess = true;
            }
            // Check if user is the psychologist for this consultation
            else if ($consultation->psychologist && $consultation->psychologist->user_id === $user->id) {
                $hasAccess = true;
            }
        }

        if (!$hasAccess) {
            return redirect('/')->with('error', 'Access denied');
        }

        // Check if consultation is active or completed
        if (!in_array($consultation->status, ['active', 'completed'])) {
            return redirect()->back()->with('error', 'Konsultasi belum aktif atau tidak dapat diakses.');
        }

        $consultation->load(['psychologist.user', 'user', 'chats.sender']);

        // If AJAX request for polling, return only the chat messages
        if (request()->ajax() && request()->has('ajax')) {
            return view('chat.show', compact('consultation'));
        }

        return view('chat.show', compact('consultation'));
    }

    public function store(Request $request, Consultation $consultation)
    {
        $user = request()->user();

        // Enhanced access check with proper psychologist relationship
        $hasAccess = false;

        if ($user) {
            // Check if user is the consultation client
            if ($consultation->user_id === $user->id) {
                $hasAccess = true;
            }
            // Check if user is the psychologist for this consultation
            else if ($consultation->psychologist && $consultation->psychologist->user_id === $user->id) {
                $hasAccess = true;
            }
        }

        if (!$hasAccess) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Access denied'], 403);
            }
            return redirect('/')->with('error', 'Access denied');
        }

        // Validate request
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        try {
            $chat = Chat::create([
                'consultation_id' => $consultation->id,
                'sender_id' => $user->id,
                'message' => $request->message,
                'sent_at' => now()
            ]);

            if ($request->ajax()) {
                $chat->load('sender');
                return response()->json([
                    'success' => true,
                    'chat' => $chat,
                    'message' => 'Pesan berhasil dikirim'
                ]);
            }

            return redirect()->back();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Database error: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Gagal mengirim pesan');
        }
    }

    public function heartbeat(Request $request, Consultation $consultation)
    {
        $user = request()->user();

        // Enhanced access check with proper psychologist relationship
        $hasAccess = false;

        if ($user) {
            // Check if user is the consultation client
            if ($consultation->user_id === $user->id) {
                $hasAccess = true;
            }
            // Check if user is the psychologist for this consultation
            else if ($consultation->psychologist && $consultation->psychologist->user_id === $user->id) {
                $hasAccess = true;
            }
        }

        if (!$hasAccess) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        // Update user's last activity
        $user->update(['last_active_at' => now()]);

        // Get other participant's status
        $otherUser = $consultation->user_id === $user->id
            ? $consultation->psychologist->user
            : $consultation->user;

        $isOnline = $otherUser->last_active_at && $otherUser->last_active_at->diffInMinutes(now()) < 5;

        return response()->json([
            'success' => true,
            'online' => $isOnline,
            'last_seen' => $otherUser->last_active_at ? $otherUser->last_active_at->diffForHumans() : null
        ]);
    }

    public function typing(Request $request, Consultation $consultation)
    {
        $user = request()->user();

        // Check access
        if (!$user || ($consultation->user_id !== $user->id && $consultation->psychologist->user_id !== $user->id)) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        // Here you could implement Redis or cache-based typing indicators
        // For now, just return success
        return response()->json(['success' => true]);
    }

    public function getMessages(Request $request, Consultation $consultation)
    {
        $user = request()->user();

        // Enhanced access check with proper psychologist relationship
        $hasAccess = false;

        if ($user) {
            // Check if user is the consultation client
            if ($consultation->user_id === $user->id) {
                $hasAccess = true;
            }
            // Check if user is the psychologist for this consultation
            else if ($consultation->psychologist && $consultation->psychologist->user_id === $user->id) {
                $hasAccess = true;
            }
        }

        if (!$hasAccess) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        // Get all messages from this consultation
        $messages = $consultation->chats()
            ->with('sender')
            ->orderBy('sent_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages,
            'count' => $messages->count()
        ]);
    }
}
