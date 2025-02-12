@extends('frontend.dashboard.contractor.app')

@section('title')
    Dashboard Contrator
@endsection
@section('header')
    @include('frontend.dashboard.contractor.partials.header')
@endsection
@push('styles')
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/css/inbox.css" />
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/css/style.css" />
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/css/responsive.css" />
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/css/notification.css" />
    <style>
        .chat-count-number {
            background-color: black;
            color: white;
            border-radius: 50%;
            font-size: 14px;
            display: inline-block;
            min-width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="col-12 p-2">

        <!-- main content start -->
        <div class="main-content">
            <div class="main-content-container">

                <div class="messages-container bg-white">
                    <!-- inbox container start -->
                    <div class="inbox">
                        <div class="inbox-top">
                            <div class="inbox-title">Inbox</div>
                            <div class="search-container">
                                <div class="search-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                        viewBox="0 0 25 24" fill="none">
                                        <ellipse cx="12.6286" cy="11.7666" rx="8.96453" ry="8.98856"
                                            stroke="#6B7280" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M18.8633 18.4851L22.3779 22" stroke="#6B7280" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <input placeholder="Search mail..." type="text" id='customSearchBox' />
                            </div>
                        </div>
                        <div class="general-title-container">
                            <div class="general-title">General</div>
                            <div class="general-title-border"></div>
                        </div>
                        <div class="inbox-messages" id="chatRoomList">

                            {{-- here show all chat room --}}

                        </div>
                    </div>
                    <!-- inbox container end -->

                    <!-- indevidual user messages start -->
                    @if ($lastChatRommMessage)
                        <div id="user-messages" class="user-messages" data-chat-room-id="{{ $lastChatRommMessage->id }}">
                            <div class="user-title">
                                <div class=" d-flex align-item-center gap-4 ">
                                    <div style=" width: 50px; height: 50px; " class="">
                                        <img src="{{ asset($lastChatRommMessage->customer->avatar ?? 'backend/assets/images/avatar_defult.png') }}"
                                            alt="user"
                                            style="border-radius: 50%; width: 100%; height: 100%; object-fit: cover;" />
                                    </div>
                                    <div class=" pt-2 ">
                                        <span>
                                            {{ $lastChatRommMessage->customer->name ?? ($lastChatRommMessage->contactor->name ?? '') }}
                                            {{-- <h6 style="color:green">online</h6> --}}
                                        </span>
                                    </div>

                                </div>

                                <hr>
                                <div class="d-flex align-item-center gap-2">
                                    <svg class="back-to-inbox-btn" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M19 12H5M5 12L11 18M5 12L11 6" stroke="#121715" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                            </div>
                            <hr>
                            <div class="individual-messages">
                                @if ($lastChatRommMessage)
                                    @foreach ($lastChatRommMessage->messages as $key => $message)
                                        <div
                                            class="single-message {{ $message->sender_id == Auth::id() ? 'my-message' : 'opposite-message' }}">
                                            @if ($message->sender_id !== Auth::id())
                                                <div class="user-profile">
                                                    <img src="{{ $message->sender->avatar ? asset($message->sender->avatar) : asset('backend/assets/images/avatar_defult.png') }}"
                                                        alt="user" />
                                                </div>
                                            @endif
                                            <div class="right-content">
                                                <div class="user-name">{{ $message->sender->name }}</div>

                                                <div class="user-text">
                                                    <div class="text">
                                                        {!! $message->content !!}
                                                    </div>
                                                    <div class="time">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 16 16" fill="none">
                                                            <g clip-path="url(#clip0_248_163)">
                                                                <path d="M9.25 5.25L3.75 10.75L1 8" stroke="#F8CF2C"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M14.9996 5.25L9.49961 10.75L8.03711 9.2875"
                                                                    stroke="#F8CF2C" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_248_163">
                                                                    <rect width="16" height="16" fill="white" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                        <span>{{ \Carbon\Carbon::parse($message->created_at)->format('h:i A') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($message->sender_id == Auth::id())
                                                <div class="user-profile">
                                                    <img src="{{ $message->sender->avatar ? asset($message->sender->avatar) : asset('backend/assets/images/avatar_defult.png') }}"
                                                        alt="user" />
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif


                            </div>
                            @if ($lastChatRommMessage)
                                <div class="reply-input-container mb-2">
                                    <form id="sendFormOpen">
                                        @csrf
                                        <div>
                                            <textarea placeholder="Type a message" name="content" id="messageInput" required></textarea>
                                        </div>
                                        <div class="actions">
                                            <button type="submit" class="send-btn ms-auto"> <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <g clip-path="url(#clip0_248_391)">
                                                        <path
                                                            d="M13.963 7.12523L3.43173 1.23148C3.25625 1.12915 3.05419 1.08162 2.8515 1.09498C2.64881 1.10835 2.45475 1.182 2.29423 1.30648C2.13029 1.43582 2.01127 1.61352 1.95405 1.81434C1.89683 2.01516 1.90433 2.22891 1.97548 2.42523L3.73173 7.33148C3.74949 7.3804 3.78173 7.42275 3.82416 7.45289C3.86659 7.48304 3.91719 7.49955 3.96923 7.50023H8.48173C8.61147 7.49817 8.73717 7.54541 8.83345 7.63241C8.92972 7.71941 8.98942 7.83969 9.00048 7.96898C9.00475 8.03722 8.99498 8.10561 8.97178 8.16993C8.94857 8.23425 8.91242 8.29312 8.86556 8.34291C8.81869 8.3927 8.76212 8.43235 8.69932 8.45941C8.63653 8.48647 8.56885 8.50036 8.50048 8.50023H3.96923C3.91719 8.50091 3.86659 8.51742 3.82416 8.54757C3.78173 8.57771 3.74949 8.62006 3.73173 8.66898L1.97548 13.5752C1.92278 13.7264 1.9069 13.8879 1.92916 14.0464C1.95142 14.2049 2.01117 14.3559 2.10345 14.4866C2.19574 14.6174 2.31789 14.7243 2.45977 14.7984C2.60165 14.8725 2.75916 14.9117 2.91923 14.9127C3.08956 14.912 3.25704 14.869 3.40673 14.7877L13.963 8.87523C14.1176 8.7874 14.2462 8.66016 14.3357 8.50645C14.4252 8.35275 14.4723 8.17808 14.4723 8.00023C14.4723 7.82238 14.4252 7.64771 14.3357 7.494C14.2462 7.3403 14.1176 7.21305 13.963 7.12523Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_248_391">
                                                            <rect width="16" height="16" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg></button>
                                        </div>
                                    </form>
                                </div>
                            @endif

                        </div>
                    @else
                        <div class="user-messages">
                            <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
                                <h1>You don't have any active conversations</h1>
                            </div>
                        </div>
                    @endif
                    <!-- iindevidual user messages end -->
                </div>
            </div>
        </div>

    </div>
@endsection


@push('scripts')
    <script>
        // Define activeChannels globally
        let activeChannels = new Map(); // Track active listeners

        // Fetch chat rooms function start==========================
        function fetchChatRooms() {
            let allChatUrl = "{{ route('contractor.message.chat_rooms') }}";
            $.ajax({
                url: allChatUrl,
                type: "GET",
                success: function(res) {
                    $('#chatRoomList').empty();
                    res.data.forEach(function(chatRoom) {
                        let channelName = 'chat.' + chatRoom.chatRoom_id;
                        // Register real-time updates only if not already registered
                        if (!activeChannels.has(channelName)) {
                            activeChannels.set(channelName, true); // Mark channel as registered

                            window.Echo.private(channelName)
                                .listen('MessageEvent', (e) => {
                                    // console.log(e)
                                    // Refresh chat rooms and update messages
                                    fetchChatRooms();
                                    updateActiveMessage(e.message);
                                });
                        }
                        let formattedTime = "";
                        if (chatRoom.last_message !== null) {
                            // Format the sent_at time
                            formattedTime = new Date(chatRoom.last_message.created_at)
                                .toLocaleTimeString("en-US", {
                                    hour: "2-digit",
                                    minute: "2-digit",
                                    hour12: true // Set to true if you want 12-hour format (with AM/PM)
                                });
                        }

                        let avatarUrl = chatRoom.other_user.avatar ? "{{ asset('') }}" + chatRoom
                            .other_user
                            .avatar : "{{ asset('backend/assets/images/avatar_defult.png') }}";

                        $('#chatRoomList').append(`
                            <div class="item people-chat-item" onclick="getChatRoom(${chatRoom.chatRoom_id})">
                                <div class="profile-container">
                                    <img src="${avatarUrl}" alt="user" />
                                </div>
                                <div class="message-container">
                                    <div class="message-container-top">
                                        <div class="title people-name">${chatRoom.other_user.name}</div>
                                        <div class="time">${chatRoom.last_message ? (formattedTime || '') : ''}</div>
                                    </div>
                                    <div class="text">
                                        ${chatRoom.last_message ? (chatRoom.last_message.content.length > 40 ? chatRoom.last_message.content.slice(0, 40) + '...' : chatRoom.last_message.content || " ") : ''}
                                    </div>
                                </div>
                                ${chatRoom.unread_count ? `<div class="chat-count"><span class="chat-count-number">${ chatRoom.unread_count }</span></div>
    ` : ""}
                            </div>
                            <div class="chat-separator"></div>
                        `);
                    });
                },
                error: function(res) {
                    if (res.responseJSON.errors) {
                        flasher.error(res.responseJSON.message);
                    }
                }
            });
        }
        // Fetch chat rooms function end==========================


        // Define getChatRoom globally start========================
        function getChatRoom(chatRoomId) {
            let getMessageUrl = "{{ route('contractor.message.get_messages', ':chatRoomId') }}".replace(':chatRoomId',
                chatRoomId);
            $.ajax({
                url: getMessageUrl,
                type: "GET",
                success: function(res) {
                    fetchChatRooms();
                    let messagesHtml = '';
                    res.messages.forEach(function(content) {
                        // Format the sent_at time
                        const formattedTime = new Date(content.sent_at).toLocaleTimeString("en-US", {
                            hour: "2-digit",
                            minute: "2-digit",
                            hour12: true // Set to true if you want 12-hour format (with AM/PM)
                        });
                        let chatAlignment = content.sender_id === {{ auth()->id() }} ? `<div class="single-message my-message">
                                <div class="right-content">
                                    <div class="user-name">${content.sender.name}</div>
                                    <div class="user-text">
                                        <div class="text">
                                            ${content.content}
                                        </div>
                                        <div class="time">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16" fill="none">
                                                <g clip-path="url(#clip0_248_163)">
                                                    <path d="M9.25 5.25L3.75 10.75L1 8" stroke="#F8CF2C"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M14.9996 5.25L9.49961 10.75L8.03711 9.2875" stroke="#F8CF2C"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_248_163">
                                                        <rect width="16" height="16" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <span>${formattedTime}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-profile">
                                    <img src="${content.sender.avatar ? `{{ asset('') }}${content.sender.avatar}` : '{{ asset('backend/assets/images/avatar_defult.png') }}'}" alt="user" />
                                </div>
                            </div>` :
                            `<div class="single-message opposite-message">
                                <div class="user-profile">
                                    <img src="${content.sender.avatar ? `{{ asset('') }}${content.sender.avatar}` : '{{ asset('backend/assets/images/avatar_defult.png') }}'}" alt="user" />
                                </div>
                                <div class="right-content">
                                    <div class="user-name">${content.sender.name}</div>
                                    <div class="user-text">
                                        <div class="text">
                                            ${content.content}
                                        </div>
                                        <div class="time">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16" fill="none">
                                                <g clip-path="url(#clip0_248_163)">
                                                    <path d="M9.25 5.25L3.75 10.75L1 8" stroke="#F8CF2C"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M14.9996 5.25L9.49961 10.75L8.03711 9.2875" stroke="#F8CF2C"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_248_163">
                                                        <rect width="16" height="16" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <span>${formattedTime}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        messagesHtml += chatAlignment;

                    });

                    $('#user-messages').empty();
                    $('#user-messages').append(`
                        <div class="user-title">
                            <div class=" d-flex align-item-center gap-4 ">
                                <div style=" width: 50px; height: 50px; " class="">
                                    <img src="${res.avatar ? `{{ asset('') }}${res.avatar}` : '{{ asset('backend/assets/images/avatar_defult.png') }}'}"
                                alt="user" style="border-radius: 50%; width: 100%; height: 100%; object-fit: cover;" />
                                </div>
                                <div class=" pt-2 " >
                                    <span>
                                        ${res.receiverName || ''}
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex align-item-center gap-2">
                                <svg class="back-to-inbox-btn" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M19 12H5M5 12L11 18M5 12L11 6" stroke="#121715" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <hr>
                        <div class="individual-messages" >

                            ${messagesHtml}
                        </div>
                        <div class="reply-input-container mb-2">
                            <form id="sendForm">
                                @csrf
                                <div>
                                    <textarea placeholder="Type a message" name="content" id="messageInput" required></textarea>
                                </div>
                                <div class="actions">
                                    <button type="submit" class="send-btn ms-auto"> <svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <g clip-path="url(#clip0_248_391)">
                                                <path
                                                    d="M13.963 7.12523L3.43173 1.23148C3.25625 1.12915 3.05419 1.08162 2.8515 1.09498C2.64881 1.10835 2.45475 1.182 2.29423 1.30648C2.13029 1.43582 2.01127 1.61352 1.95405 1.81434C1.89683 2.01516 1.90433 2.22891 1.97548 2.42523L3.73173 7.33148C3.74949 7.3804 3.78173 7.42275 3.82416 7.45289C3.86659 7.48304 3.91719 7.49955 3.96923 7.50023H8.48173C8.61147 7.49817 8.73717 7.54541 8.83345 7.63241C8.92972 7.71941 8.98942 7.83969 9.00048 7.96898C9.00475 8.03722 8.99498 8.10561 8.97178 8.16993C8.94857 8.23425 8.91242 8.29312 8.86556 8.34291C8.81869 8.3927 8.76212 8.43235 8.69932 8.45941C8.63653 8.48647 8.56885 8.50036 8.50048 8.50023H3.96923C3.91719 8.50091 3.86659 8.51742 3.82416 8.54757C3.78173 8.57771 3.74949 8.62006 3.73173 8.66898L1.97548 13.5752C1.92278 13.7264 1.9069 13.8879 1.92916 14.0464C1.95142 14.2049 2.01117 14.3559 2.10345 14.4866C2.19574 14.6174 2.31789 14.7243 2.45977 14.7984C2.60165 14.8725 2.75916 14.9117 2.91923 14.9127C3.08956 14.912 3.25704 14.869 3.40673 14.7877L13.963 8.87523C14.1176 8.7874 14.2462 8.66016 14.3357 8.50645C14.4252 8.35275 14.4723 8.17808 14.4723 8.00023C14.4723 7.82238 14.4252 7.64771 14.3357 7.494C14.2462 7.3403 14.1176 7.21305 13.963 7.12523Z"
                                                    fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_248_391">
                                                    <rect width="16" height="16" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg></button>
                                </div>
                            </form>
                        </div>
            `);

                    $('#user-messages').data('chat-room-id', res.chatRoomId);

                    const chatBody = document.querySelector("div.individual-messages");
                    chatBody.scrollTop = chatBody.scrollHeight;

                    let storeurl = "{{ route('contractor.message.send_message', ':chatRoomId') }}".replace(
                        ':chatRoomId', res.chatRoomId);

                    // ==================sending message here function start================== 
                    $('#sendForm').on('submit', function(event) {
                        event.preventDefault();
                        let formData = new FormData(this);
                        $.ajax({
                            url: storeurl,
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.success) {
                                    $('#messageInput').val('');
                                    getChatRoom(response.messages.chat_room_id)
                                    fetchChatRooms();
                                } else {
                                    flasher.error('Something went wrong.');
                                }
                            },
                            error: function(response) {
                                if (response.responseJSON.errors) {
                                    flasher.error(response.responseJSON.message);
                                }
                            }
                        });
                    });
                    // ==================sending message here function end================== 

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching chat rooms:', error);
                }
            });
        }
        // Define getChatRoom globally end========================


        // Initialize chat rooms when the document is ready
        $(document).ready(function() {
            fetchChatRooms();
            const chatBody = document.querySelector("div.individual-messages");
            if (chatBody) {
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        });

        function updateActiveMessage(message) {

            const chatSection = $('#user-messages');
            const activeChatRoomId = chatSection.data('chat-room-id');
            // console.log(activeChatRoomId);
            if (activeChatRoomId === message.chat_room_id) {
                // Format the sent_at time
                const formattedTime = new Date(message.sent_at).toLocaleTimeString("en-US", {
                    hour: "2-digit",
                    minute: "2-digit",
                    hour12: true // Set to true if you want 12-hour format (with AM/PM)
                });

                let messagesHtml = `<div class="single-message opposite-message">
                                <div class="user-profile">
                                    <img src="${message.sender.avatar ? `{{ asset('') }}${message.sender.avatar}` : '{{ asset('backend/assets/images/avatar_defult.png') }}'}" alt="user" />
                                </div>
                                <div class="right-content">
                                    <div class="user-name">${message.sender.name}</div>
                                    <div class="user-text">
                                        <div class="text">
                                            ${message.content}
                                        </div>
                                        <div class="time">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16" fill="none">
                                                <g clip-path="url(#clip0_248_163)">
                                                    <path d="M9.25 5.25L3.75 10.75L1 8" stroke="#F8CF2C"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M14.9996 5.25L9.49961 10.75L8.03711 9.2875" stroke="#F8CF2C"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_248_163">
                                                        <rect width="16" height="16" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <span>${formattedTime}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                const chatBody = chatSection.find('div.individual-messages');
                chatBody.append(messagesHtml);
                chatBody.scrollTop(chatBody[0].scrollHeight); // Scroll to the bottom
            }


        }
        // here its for open last chat =========================
        let Opnestoreurl = "{{ route('contractor.message.send_message', ':chatRoomId') }}".replace(
            ':chatRoomId', {{ $lastChatRommMessage ? $lastChatRommMessage->id : 'null' }});
        $('#sendFormOpen').on('submit', function(event) {
            event.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: Opnestoreurl,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Format the sent_at time
                        const formattedTime = new Date(response.messages.created_at).toLocaleTimeString(
                            "en-US", {
                                hour: "2-digit",
                                minute: "2-digit",
                                hour12: true // Set to true if you want 12-hour format (with AM/PM)
                            });

                        $('.individual-messages').append(`
                            <div class="single-message my-message">
                                <div class="right-content">
                                    <div class="user-name">${response.messages.sender.name?? ""}</div>
                                    <div class="user-text">
                                        <div class="text">
                                             ${response.messages.content}
                                        </div>
                                        <div class="time">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16" fill="none">
                                                <g clip-path="url(#clip0_248_163)">
                                                    <path d="M9.25 5.25L3.75 10.75L1 8" stroke="#F8CF2C"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M14.9996 5.25L9.49961 10.75L8.03711 9.2875" stroke="#F8CF2C"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_248_163">
                                                        <rect width="16" height="16" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <span>${formattedTime}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-profile">
                                    <img src="${response.messages.sender.avatar ? `{{ asset('') }}${response.messages.sender.avatar}` : '{{ asset('backend/assets/images/avatar_defult.png') }}'}" alt="user" />
                                </div>
                            </div>
                                     `);
                        $('#messageInput').val('');
                        const chatBody = document.querySelector("div.individual-messages");
                        chatBody.scrollTop = chatBody.scrollHeight;

                        fetchChatRooms();
                    } else {
                        flasher.error('Something went wrong.');
                    }
                },
                error: function(response) {
                    if (response.responseJSON.errors) {
                        flasher.error(response.responseJSON.message);
                    }
                }
            });
        });

        // ================== Searching chat room here start ================== 
        document.getElementById('customSearchBox').addEventListener('input', function() {
            let query = this.value.toLowerCase();
            let people_chat_item = document.querySelectorAll('.people-chat-item');

            people_chat_item.forEach(function(item) {
                let name = item.querySelector('.people-name').textContent.toLowerCase();

                if (name.includes(query)) {
                    item.style.display = ''; // Reset display property (show the item)
                } else {
                    item.style.display = 'none'; // Hide the item
                }
            });
        });
        // ================== Searching chat room here end ================== 
    </script>
@endpush
