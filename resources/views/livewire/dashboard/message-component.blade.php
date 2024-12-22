@push('notif')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    document.addEventListener('livewire:initialized', function () {
        function scrollToBottom() {
            const chatBody = document.querySelector('.fp__chat_body');
            if (chatBody) {
                setTimeout(() => {
                    chatBody.scrollTop = chatBody.scrollHeight + 1000;
                }, 100);
            }
        }

        scrollToBottom();

        let soundInitialized = false;
        const notificationSound = new Audio('/sounds/multimedia-message-arrival-sound.mp3');

        // Инициализируем звук при первом клике пользователя
        document.addEventListener('click', function() {
            if (!soundInitialized) {
                notificationSound.load();
                soundInitialized = true;
            }
        }, { once: true });

        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        const channel = pusher.subscribe('message-sent');
        
        channel.bind('message-event', function(data) {
            if (data.receiver_id == {{ Auth::id() }}) {
                const chatBody = document.querySelector('.fp__chat_body');
                
                const messageHtml = `
                    <div class="fp__chating">
                        <div class="fp__chating_img">
                            <img src="{{ asset('assets/images/service_provider.png') }}" 
                                 alt="person" 
                                 class="img-fluid w-100">
                        </div>
                        <div class="fp__chating_text">
                            <p>${data.message}</p>
                            <span>${new Date(data.created_at).toLocaleString(undefined, {
                                year: 'numeric',
                                month: 'numeric',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            })}</span>
                        </div>
                    </div>
                `;
                
                chatBody.insertAdjacentHTML('beforeend', messageHtml);
                scrollToBottom();

                if (soundInitialized) {
                    notificationSound.play().catch(function(error) {
                        console.log('Ошибка воспроизведения звука:', error);
                    });
                }
            }
        });
    });
</script>
@endpush
<div class="tab-pane fade"  x-show="activeTab === 'messages'"
:class="activeTab === 'messages' ? 'tab-pane fade active show' : 'tab-pane fade'">
    <div class="fp_dashboard_body fp__change_password">
        <div class="fp__message">
            <h3>Messages</h3>
            @include('components.layouts.preloader')
            
            <div class="fp__chat_area">

                <div class="fp__chat_body">
                    @foreach($chats as $chat)
                    @if($chat->sender_id != Auth::user()->id)
                    <div class="fp__chating">
                        <div class="fp__chating_img">
                            <img src="{{ asset('assets/images/service_provider.png') }}" alt="person"
                                class="img-fluid w-100">
                        </div>
                        <div class="fp__chating_text">
                            <p>{{ $chat->message }}</p>
                            <span>{{ \Carbon\Carbon::create($chat->created_at)->format('F d, Y H:i') }}</span>
                        </div>
                    </div>
                    @else
                    <div class="fp__chating tf_chat_right">
                        <div class="fp__chating_img">
                            <img src="{{ asset(auth()->user()->avatar) }}" alt="person"
                                class="img-fluid rounded-circle w-100">
                        </div>
                        <div class="fp__chating_text">
                            <p>{{ $chat->message }}</p>
                            <span>{{ \Carbon\Carbon::create($chat->created_at)->format('F d, Y H:i') }}</span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    
                </div>
                <form class="fp__single_chat_bottom" wire:submit.prevent="sendMessage">
                    @csrf
                    <label for="select_file"><i class="fas fa-file-medical" aria-hidden="true"></i></label>
                    <input id="select_file" type="file" hidden="">
                    <input type="text" placeholder="Type a message..." wire:model="message">
                    <button type="submit" class="fp__massage_btn"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
