<li class="nav-item dropdown">
    <a href="{{ route('dashboard', ['activeTab' => 'messages']) }}" class="nav-link">
        <i class="fas fa-comments"></i>
            <span>{{ $unreadMessages }}</span>
    </a>
</li>

@push('scripts-pusher')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    document.addEventListener('livewire:initialized', function () {
        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });
    
        const messageChannel = pusher.subscribe('message-sent');
        
        messageChannel.bind('message-event', function(data) {
            try {
                // Проверяем, является ли текущий пользователь получателем
                if (data.receiver_id == {{ Auth::id() }}) {
                    // Обновляем счетчик непрочитанных сообщений
                    @this.updateUnreadCount();
                    
                    // Воспроизводим звук уведомления, если он определен
                    if (typeof notificationSound !== 'undefined') {
                        notificationSound.play().catch(function(error) {
                            console.log('Ошибка воспроизведения звука:', error);
                        });
                    }
                }
            } catch (error) {
                console.error('Ошибка при обработке сообщения:', error);
            }
        });
    });
</script>
@endpush
