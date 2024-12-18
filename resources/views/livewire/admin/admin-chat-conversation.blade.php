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
            <form id="chat-form" wire:submit.prevent="sendMessage">
                @csrf
                <input type="text" class="form-control" placeholder="Type a message" wire:model="message">
                <button type="submit" class="btn btn-primary">
                    <i class="far fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>
