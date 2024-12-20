<section class="section">

    <div class="section-header">
        <h1>Messages</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.chat') }}">Messages</a></div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-sm-12">
                @include('components.layouts.preloader')
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Who's Online? {{ $senderId }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach($chatUsers as $chatUser)
                            <li class="media btn {{ $senderId == $chatUser->id ? 'active bg-light rounded' : '' }}" wire:click="setSenderId({{ $chatUser->id }})">
                                <a class="pl-3 d-flex align-items-start" href="javascript:;">
                                    <img alt="image" class="mr-3 rounded-circle" width="50"
                                        src="{{ asset($chatUser->avatar) }}">
                                    <div class="media-body">
                                        <div class="mt-0 mb-1 font-weight-bold">{{ ucfirst($chatUser->name) }}</div>
                                        @if($chatUser->isOnline())
                                        <div class="text-success text-small font-weight-600"><i class="fas fa-circle"></i> Online</div>
                                        @else
                                        <div class="text-danger text-small font-weight-600"><i class="fas fa-circle"></i> Offline</div>
                                        @endif
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
                <div class="card chat-box" id="mychatbox">
                    <div class="card-header">
                        <h4>Chat with {{ $senderName }}</h4>
                    </div>
                    <div class="card-body chat-content" id="chatContent" tabindex="2" style="height: 34rem; overflow-y: auto;">
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
                        <form id="chat-form" wire:submit.prevent="sendMessage">
                            @csrf
                            <input type="text" class="form-control" placeholder="Type a message" wire:model="message">
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>j
</section>

<script>
    document.addEventListener('livewire:initialized', function () {
        function scrollToBottom() {
            const chatContent = document.getElementById('chatContent');
            if (chatContent) {
                setTimeout(() => {
                    chatContent.scrollTop = chatContent.scrollHeight + 1000;
                }, 100);
            }
        }

        // Прокрутка при инициализации
        scrollToBottom();

        // Прокрутка при обновлении чата
        Livewire.on('chatUpdated', () => {
            scrollToBottom();
        });
    });
</script>
