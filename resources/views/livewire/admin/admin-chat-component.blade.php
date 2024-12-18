<section class="section">
    @php
        $senderId = $chatUsers->first() ? $chatUsers->first()->id : null;
        $key = $senderId;
    @endphp

    <div class="section-header">
        <h1>Messages</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.chat') }}">Messages</a></div>
        </div>
    </div>

    <div class="section-body">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card" style="height: 100vh;">
                    <div class="card-header">
                        <h4>Who's Online?</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach($chatUsers as $chatUser)
                            @php
                                $senderId = $chatUser->id;
                                $key = $senderId;
                            @endphp
                            <li class="media">
                                <a href="javascript:;" wire:click.prevent="setSenderId({{ $chatUser->id }})">
                                    <img alt="image" class="mr-3 rounded-circle" width="50"
                                    src="{{ asset($chatUser->avatar) }}">
                                    <div class="media-body">
                                        <div class="mt-0 mb-1 font-weight-bold">{{ $chatUser->name }}</div>
                                        <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i>
                                            Online {{ $userId }}</div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- <livewire:admin.admin-chat-conversation :senderId="$senderId ?? null" :key="$key" /> --}}

            <div class="col-12 col-sm-6 col-lg-6">
                <div class="card chat-box" id="mychatbox" style="height: 100vh;">
                    <div class="card-header">
                        <h4>Chat with {{ $senderId }} {{ $senderName }}</h4>
                    </div>
                    <div class="card-body chat-content" tabindex="2" style="overflow: hidden; outline: none;">
                        @foreach($chats as $chat)
                            @if($chat->sender_id == Auth::user()->id)
                            <div class="chat-item chat-left" style=""><img src="{{ asset(auth()->user()->avatar) }}">
                                <div class="chat-details">
                                    <div class="chat-text">{{ $chat->message }}</div>
                                    <div class="chat-time">{{ \Carbon\Carbon::create($chat->created_at)->format('F d, Y H:i') }}</div>
                                </div>
                            </div>
                            @else
                            <div class="chat-item chat-right" style=""><img src="{{ asset($chat->sender->avatar) }}">
                                <div class="chat-details">
                                    <div class="chat-text">{{ $chat->message }}</div>
                                    <div class="chat-time">{{ \Carbon\Carbon::create($chat->created_at)->format('F d, Y H:i') }}</div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="card-footer chat-form">
                        <form id="chat-form" wire:submit.prevent="sendMessage({{ $senderId }})">
                            @csrf
                            <input type="text" class="form-control" placeholder="Type a message" wire:model="message">
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
