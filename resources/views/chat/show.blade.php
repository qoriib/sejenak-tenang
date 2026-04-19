@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5 pt-5">
        <div class="row">
            <div class="col-12">
                <div class="card" style="height: 80vh;">
                    <!-- Chat Header -->
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                @if (Auth::user()->isUser())
                                    @php $otherUser = $consultation->psychologist->user; @endphp
                                @else
                                    @php $otherUser = $consultation->user; @endphp
                                @endif

                                <div class="position-relative me-3">
                                    @if ($otherUser->avatar)
                                        <img src="{{ asset('storage/' . $otherUser->avatar) }}" alt="{{ $otherUser->name }}"
                                            class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-light text-primary d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            {{ substr($otherUser->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <!-- Online indicator -->
                                    <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border-2 border-white"
                                        style="width: 12px; height: 12px;" id="onlineIndicator"></div>
                                </div>

                                <div>
                                    <h6 class="mb-0">{{ $otherUser->name }}</h6>
                                    @if (Auth::user()->isUser())
                                        <small>{{ $consultation->psychologist->specialization }}</small>
                                    @else
                                        <small id="typingIndicator" class="text-warning" style="display: none;">
                                            <i class="ph-bold ph-dots-three"></i> sedang mengetik...
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-light btn-sm" onclick="toggleSound()" id="soundToggle">
                                    <i class="ph-bold ph-speaker-high" id="soundIcon"></i>
                                </button>
                                <a href="{{ Auth::user()->isUser() ? route('user.consultations.show', $consultation) : route('psychologist.consultations.show', $consultation) }}"
                                    class="btn btn-outline-light btn-sm">Detail</a>
                            </div>
                        </div>
                    </div>

                    <!-- Chat Messages -->
                    <div class="card-body p-0" style="height: calc(80vh - 200px); overflow-y: auto;" id="chatContainer">
                        <div class="p-3">
                            @if ($consultation->chats->count() > 0)
                                @foreach ($consultation->chats as $chat)
                                    <div
                                        class="mb-3 d-flex {{ $chat->sender_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                                        <div class="chat-message {{ $chat->sender_id == Auth::id() ? 'bg-primary text-white sent-message' : 'bg-white text-dark received-message' }}"
                                            style="max-width: 70%; padding: 12px 16px; border-radius: 18px;">
                                            <div class="message-content">
                                                {{ $chat->message }}
                                            </div>
                                            <div class="message-time mt-1">
                                                <small
                                                    class="{{ $chat->sender_id == Auth::id() ? 'text-white-50' : 'text-muted' }}">
                                                    {{ $chat->sent_at->format('H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center text-muted py-5">
                                    <i class="ph-duotone ph-chat-dots" style="font-size:60px;opacity:0.4;color:#4A90A4;"></i>
                                    <p class="mt-3">Belum ada pesan. Mulai percakapan!</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Chat Input -->
                    <div class="card-footer">
                        @if (Auth::user()->isUser())
                            <form method="POST" action="{{ route('user.chat.store', $consultation) }}" class="d-flex">
                            @else
                                <form method="POST" action="{{ route('psychologist.chat.store', $consultation) }}"
                                    class="d-flex">
                        @endif
                        @csrf
                        <div class="flex-grow-1 me-2">
                            <input type="text" class="form-control" name="message" placeholder="Ketik pesan Anda..."
                                required style="border-radius: 25px;">
                        </div>
                        <button type="submit" class="btn btn-primary"
                            style="border-radius: 50%; width: 50px; height: 50px;">
                            <span style="font-size: 18px;">→</span>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Setup CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let soundEnabled = true;
        let lastMessageCount = {{ $consultation->chats->count() }};

        // Auto scroll to bottom
        function scrollToBottom() {
            const chatContainer = document.getElementById('chatContainer');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Play notification sound
        function playNotificationSound() {
            if (soundEnabled) {
                const audio = new Audio(
                    'data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+7uu2YgBjWHzbXWgDAFl2+p6eV/aSSNRPqhRQAAAA=='
                );
                audio.play().catch(e => console.log('Could not play sound'));
            }
        }

        // Toggle sound
        function toggleSound() {
            soundEnabled = !soundEnabled;
            const icon = document.getElementById('soundIcon');
            icon.className = soundEnabled ? 'ph-bold ph-speaker-high' : 'ph-bold ph-speaker-slash';
        }

        // Scroll to bottom on page load
        document.addEventListener('DOMContentLoaded', scrollToBottom);

        // Setup ready functions
        $(document).ready(function() {

            // Append new message to chat (enhanced with optimistic UI)
            function appendMessage(chat, isOptimistic = false, isNewMessage = false) {
                const isOwn = chat.sender_id == {{ Auth::id() }};
                const messageTime = new Date(chat.sent_at).toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                const tempAttr = isOptimistic ? `data-temp-id="${chat.id}"` : '';
                const opacity = isOptimistic ? 'opacity-50' : '';
                const newMessageClass = (isNewMessage && !isOwn) ? 'new-message' : '';

                const messageHtml = `
                <div class="mb-3 d-flex ${isOwn ? 'justify-content-end' : 'justify-content-start'}" ${tempAttr}>
                    <div class="chat-message ${isOwn ? 'bg-primary text-white sent-message' : 'bg-white text-dark received-message'} ${opacity} ${newMessageClass}"
                         style="max-width: 70%; padding: 12px 16px; border-radius: 18px; animation: fadeInUp 0.3s ease;">
                        <div class="message-content">${chat.message}</div>
                        <div class="message-time mt-1 d-flex justify-content-between align-items-center">
                            <small class="${isOwn ? 'text-white-50' : 'text-muted'}">${messageTime}</small>
                            ${isOptimistic ? '<small class="text-warning">⏳</small>' : ''}
                        </div>
                    </div>
                </div>
            `;

                $('#chatContainer .p-3').append(messageHtml);
                
                // Remove new-message class after animation
                if (newMessageClass) {
                    setTimeout(() => {
                        $(`.${newMessageClass}`).removeClass('new-message');
                    }, 600);
                }
            }

            // Auto refresh messages every 1 second for real-time experience
            let pollInterval = setInterval(loadMessages, 1000);
            let isTyping = false;
            let typingTimeout;
            let retryCount = 0;
            const maxRetries = 3;

            // Enhanced load messages with error handling using API endpoint
            function loadMessages() {
                const messagesUrl =
                    @if (Auth::user()->isUser())
                        '{{ route('user.chat.messages', $consultation) }}'
                    @else
                        '{{ route('psychologist.chat.messages', $consultation) }}'
                    @endif ;

                console.log('Polling messages from:', messagesUrl);

                $.ajax({
                    url: messagesUrl,
                    method: 'GET',
                    timeout: 5000, // 5 second timeout
                    success: function(response) {
                        console.log('Messages response:', response);
                        retryCount = 0; // Reset retry count on success

                        if (response.success && response.count > lastMessageCount) {
                            console.log('New messages detected:', response.count, 'vs',
                                lastMessageCount);

                            // Get only new messages (from lastMessageCount index)
                            const newMessages = response.messages.slice(lastMessageCount);

                            // Add only new messages
                            newMessages.forEach(function(chat) {
                                appendMessage(chat, false, true); // true = is new message
                            });

                            // Play notification sound only for truly new messages (not initial load)
                            if (lastMessageCount > 0) {
                                playNotificationSound();
                            }

                            lastMessageCount = response.count;
                            scrollToBottom();
                        } else {
                            console.log('No new messages:', response.count, 'vs', lastMessageCount);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Messages polling error:', {
                            status: xhr.status,
                            statusText: xhr.statusText,
                            error: error,
                            responseText: xhr.responseText
                        });
                        retryCount++;

                        // If route not found, fallback to page refresh method
                        if (xhr.status === 404 || xhr.status === 405) {
                            console.log('Falling back to page refresh method');
                            clearInterval(pollInterval);
                            pollInterval = setInterval(fallbackLoadMessages, 3000);
                            return;
                        }

                        if (retryCount >= maxRetries) {
                            // Show connection error
                            showConnectionError();
                            // Increase polling interval to reduce server load
                            clearInterval(pollInterval);
                            pollInterval = setInterval(loadMessages, 5000);
                        }
                    }
                });
            }

            // Fallback method using page reload approach
            function fallbackLoadMessages() {
                $.ajax({
                    url: window.location.href + '?ajax=1',
                    method: 'GET',
                    success: function(response) {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(response, 'text/html');
                        const messageElements = doc.querySelectorAll('#chatContainer .p-3 .mb-3');

                        if (messageElements.length > lastMessageCount) {
                            console.log('Fallback: New messages detected');
                            if (lastMessageCount > 0) {
                                playNotificationSound();
                            }
                            lastMessageCount = messageElements.length;

                            // Update chat container
                            const newContent = doc.querySelector('#chatContainer .p-3').innerHTML;
                            $('#chatContainer .p-3').html(newContent);
                            scrollToBottom();
                        }
                    },
                    error: function() {
                        console.log('Fallback method also failed');
                    }
                });
            }

            // Show connection error message
            function showConnectionError() {
                if (!$('.connection-error').length) {
                    const errorHtml = `
                        <div class="connection-error alert alert-warning alert-dismissible fade show position-fixed" 
                             style="top: 80px; right: 20px; z-index: 1050;">
                            <strong>Koneksi Terputus!</strong> Mencoba menghubungkan kembali...
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `;
                    $('body').append(errorHtml);

                    // Auto hide after 5 seconds
                    setTimeout(() => {
                        $('.connection-error').fadeOut();
                    }, 5000);
                }
            }

            // Typing indicator
            function showTyping() {
                if (!isTyping) {
                    isTyping = true;
                    // Send typing indicator to server (optional)
                    $.post(window.location.href + '/typing', {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        typing: true
                    });
                }

                clearTimeout(typingTimeout);
                typingTimeout = setTimeout(() => {
                    isTyping = false;
                    // Send stop typing to server (optional)
                    $.post(window.location.href + '/typing', {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        typing: false
                    });
                }, 1000);
            }

            // Add typing event to message input
            $('input[name="message"]').on('input', function() {
                if ($(this).val().length > 0) {
                    showTyping();
                }
            });

            // Enhanced message sending with optimistic UI
            $('form').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const messageInput = form.find('input[name="message"]');
                const message = messageInput.val().trim();

                console.log('Form submission:', {
                    action: form.attr('action'),
                    message: message,
                    formData: form.serialize()
                });

                if (message === '') return;

                // Show optimistic message immediately
                const tempId = 'temp_' + Date.now();
                const optimisticMessage = {
                    id: tempId,
                    message: message,
                    sender_id: {{ Auth::id() }},
                    sent_at: new Date().toISOString()
                };

                appendMessage(optimisticMessage, true);
                scrollToBottom();

                // Show loading state
                const submitBtn = form.find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm"></span>');

                // Serialize form data before clearing input
                const formData = form.serialize();

                // Clear input after getting form data
                messageInput.val('');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Remove temporary message and add real one
                        $(`[data-temp-id="${tempId}"]`).remove();
                        appendMessage(response.chat);
                        scrollToBottom();
                        lastMessageCount++;
                    },
                    error: function(xhr) {
                        // Remove optimistic message on error
                        $(`[data-temp-id="${tempId}"]`).remove();
                        console.log('AJAX Error:', {
                            status: xhr.status,
                            statusText: xhr.statusText,
                            responseText: xhr.responseText,
                            responseJSON: xhr.responseJSON
                        });

                        let errorMessage = 'Gagal mengirim pesan. Silakan coba lagi.';
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        alert(errorMessage);
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalText);
                        messageInput.focus();
                    }
                });
            });

            // Focus on message input
            $('input[name="message"]').focus();

            // Initial load of messages
            loadMessages();

            // Heartbeat for online status
            function sendHeartbeat() {
                $.post(window.location.href + '/heartbeat', {
                    _token: $('meta[name="csrf-token"]').attr('content')
                }).done(function(response) {
                    // Update online status if needed
                    if (response.online !== undefined) {
                        const indicator = $('#onlineIndicator');
                        if (response.online) {
                            indicator.removeClass('bg-secondary').addClass('bg-success');
                        } else {
                            indicator.removeClass('bg-success').addClass('bg-secondary');
                        }
                    }
                }).fail(function() {
                    console.log('Heartbeat failed');
                });
            }

            // Send heartbeat every 30 seconds
            setInterval(sendHeartbeat, 30000);

            // Send initial heartbeat
            sendHeartbeat();

            // Page visibility change handling
            document.addEventListener('visibilitychange', function() {
                if (document.visibilityState === 'visible') {
                    // Page became visible, resume fast polling
                    clearInterval(pollInterval);
                    pollInterval = setInterval(loadMessages, 1000);
                    sendHeartbeat();
                } else {
                    // Page became hidden, reduce polling frequency
                    clearInterval(pollInterval);
                    pollInterval = setInterval(loadMessages, 5000);
                }
            });

            // Cleanup on page unload
            window.addEventListener('beforeunload', function() {
                clearInterval(pollInterval);
            });

            // Auto-focus input when clicking on chat area
            $('#chatContainer').on('click', function() {
                $('input[name="message"]').focus();
            });

            // Enhanced enter key handling
            $('input[name="message"]').on('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    $(this).closest('form').submit();
                }
            });

            // Connection recovery
            function recoverConnection() {
                retryCount = 0;
                clearInterval(pollInterval);
                pollInterval = setInterval(loadMessages, 1000);
                $('.connection-error').fadeOut();
            }

            // Manual retry button (if needed)
            $(document).on('click', '.retry-connection', recoverConnection);

            // Enter key to send message
            $('input[name="message"]').on('keypress', function(e) {
                if (e.which === 13) {
                    $(this).closest('form').submit();
                }
            });

            // Typing indicator (simple simulation)
            let typingTimer;
            $('input[name="message"]').on('input', function() {
                clearTimeout(typingTimer);
                // Could implement real typing indicator with WebSocket
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Enhanced Real-time Chat Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        @keyframes typing {

            0%,
            60%,
            100% {
                transform: translateY(0);
            }

            30% {
                transform: translateY(-10px);
            }
        }

        .chat-message {
            word-wrap: break-word;
            transition: all 0.3s ease;
            position: relative;
        }

        .chat-message:hover {
            transform: translateY(-1px);
        }

        /* Styling untuk pesan yang dikirim (biru) */
        .sent-message {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
            box-shadow: 0 3px 12px rgba(0, 123, 255, 0.25), 0 1px 4px rgba(0, 0, 0, 0.1);
            border-radius: 18px 18px 4px 18px !important;
        }

        .sent-message:hover {
            box-shadow: 0 5px 20px rgba(0, 123, 255, 0.35), 0 3px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-1px);
        }

        /* Styling untuk pesan yang diterima (putih) */
        .received-message {
            background: #ffffff !important;
            color: #333333 !important;
            border: 1.5px solid #e9ecef !important;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08), 0 1px 4px rgba(0, 0, 0, 0.04);
            border-radius: 18px 18px 18px 4px !important;
        }

        .received-message:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12), 0 3px 8px rgba(0, 0, 0, 0.06);
            border-color: #dee2e6 !important;
            transform: translateY(-1px);
        }

        /* Efek untuk pesan yang baru diterima */
        .received-message.new-message {
            animation: messageReceived 0.6s ease;
        }

        @keyframes messageReceived {
            0% {
                transform: scale(0.8) translateY(20px);
                opacity: 0;
            }
            50% {
                transform: scale(1.05) translateY(-5px);
            }
            100% {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
        }

        /* Smooth shadow transition */
        .chat-message {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Gradient overlay untuk depth */
        .sent-message::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 50%);
            border-radius: inherit;
            pointer-events: none;
        }

        .received-message::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.02) 0%, transparent 50%);
            border-radius: inherit;
            pointer-events: none;
        }

        .typing-indicator {
            animation: pulse 1.5s infinite;
        }

        .online-indicator {
            animation: pulse 2s infinite;
        }

        .connection-error {
            border-left: 4px solid #ffc107;
        }

        .message-sending {
            opacity: 0.7;
            animation: pulse 1s infinite;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.2), 0 1px 3px rgba(0, 0, 0, 0.1) !important;
        }

        /* Enhanced shadow for active messages */
        .chat-message:active {
            transform: translateY(1px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
        }

        .sent-message:active {
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3), 0 1px 3px rgba(0, 0, 0, 0.1) !important;
        }

        /* Smooth scrolling for chat container */
        #chatContainer {
            scroll-behavior: smooth;
        }

        /* Enhanced loading animation */
        .spinner-border-sm {
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Real-time notification badge */
        .notification-badge {
            animation: fadeInUp 0.5s ease;
        }

        /* Message status indicators */
        .message-status {
            font-size: 12px;
            margin-left: 5px;
        }

        .message-pending {
            color: #ffc107;
        }

        .message-sent {
            color: #28a745;
        }

        .message-delivered {
            color: #17a2b8;
        }

        .message-read {
            color: #007bff;
        }
    </style>
@endpush
