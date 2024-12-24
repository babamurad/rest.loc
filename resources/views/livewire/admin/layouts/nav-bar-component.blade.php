<nav class="navbar navbar-expand-lg main-navbar">

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        //Pusher.logToConsole = true;

            
        let soundInitialized2 = false;
        const notificationSound = new Audio('/sounds/multimedia-message-arrival-sound.mp3');
        const notificationSound2 = new Audio('/sounds/notification-sound-for-messenger-messages.mp3');

        // Инициализация при первой загрузке
        document.addEventListener('DOMContentLoaded', initializeSoundState);

        // Обработчик событий Livewire
        document.addEventListener('livewire:navigated', initializeSoundState);
        document.addEventListener('livewire:navigating', initializeSoundState);

        function initializeSoundState() {
            const savedState = localStorage.getItem('soundInitialized');
            if (savedState === 'true') {
                notificationSound.volume = 0.5;
                soundInitialized = true;
                document.getElementById('soundIcon')?.classList.remove('fa-volume-mute');
                document.getElementById('soundIcon')?.classList.add('fa-volume-up');
            } else {
                notificationSound.volume = 0;
                soundInitialized = false;
                document.getElementById('soundIcon')?.classList.remove('fa-volume-up');
                document.getElementById('soundIcon')?.classList.add('fa-volume-mute');
            }
            localStorage.setItem('soundInitialized', soundInitialized.toString());
        }

        var pusher = new Pusher('e4438ee202f5ef502f3f', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('order-placed');

        function initSound() {
            if (soundInitialized) {
                notificationSound.volume = 0;
                soundInitialized = false;
                localStorage.setItem('soundInitialized', 'false');
                document.getElementById('soundIcon').classList.remove('fa-volume-up');
                document.getElementById('soundIcon').classList.add('fa-volume-mute');
            } else {
                notificationSound.load();
                notificationSound.volume = 0.5;
                soundInitialized = true;
                localStorage.setItem('soundInitialized', 'true');
                document.getElementById('soundIcon').classList.remove('fa-volume-mute');
                document.getElementById('soundIcon').classList.add('fa-volume-up');
            }
        }

        channel.bind('order-event', function(data) {
            try {
                if (!data || !data.id || !data.invoice_id || !data.created_at) {
                    console.error('Получены некорректные данные заказа');
                    return;
                }

                notificationSound.play().catch(function(error) {
                    console.log('Ошибка воспроизведения звука:', error);
                });

                function formatDate(dateString) {
                    const date = new Date(dateString);
                    const now = new Date();
                    const diffInMs = now - date;

                    const seconds = Math.floor(diffInMs / 1000);
                    const minutes = Math.floor(seconds / 60);
                    const hours = Math.floor(minutes / 60);
                    const days = Math.floor(hours / 24);

                    if (days > 0) {
                        return `${days} д. назад`;
                    } else if (hours > 0) {
                        return `${hours} ч. назад`;
                    } else if (minutes > 0) {
                        return `${minutes} мин. назад`;
                    } else {
                        return 'только что';
                    }
                }

                const dateString = data.created_at;
                const formattedDate = formatDate(dateString);

                //console.log(formattedDate);

                var html = `
                <a href="orders/${data.id}" class="dropdown-item">
                      <div class="dropdown-item-icon bg-info text-white">
                        <i class="fas fa-bell"></i>
                      </div>
                      <div class="dropdown-item-desc">
                        #${data.invoice_id}  a new order has been placed!
                        <div class="time">${formattedDate}</div>
                      </div>
                </a>
                    `;

                $('.rt_notification').prepend(html);
                $('#bell').addClass('beep');
            } catch (error) {
                console.error('Ошибка при обработке уведомления:', error);
            }
        });

        // Добавляем подписку на канал сообщений
        var messageChannel = pusher.subscribe('message-sent');

        messageChannel.bind('message-event', function(data) {
            try {
                if (!data || !data.message || !data.sender_id || !data.created_at) {
                    console.error('Получены некорректные данные сообщения');
                    return;
                }

                // Воспроизводим звук уведомления
                notificationSound2.play().catch(function(error) {
                    console.log('Ошибка воспроизведения звука:', error);
                });

                function formatDate(dateString) {
                    const date = new Date(dateString);
                    const now = new Date();
                    const diffInMs = now - date;

                    const seconds = Math.floor(diffInMs / 1000);
                    const minutes = Math.floor(seconds / 60);
                    const hours = Math.floor(minutes / 60);
                    const days = Math.floor(hours / 24);

                    if (days > 0) {
                        return `${days} д. назад`;
                    } else if (hours > 0) {
                        return `${hours} ч. назад`;
                    } else if (minutes > 0) {
                        return `${minutes} мин. назад`;
                    } else {
                        return 'только что';
                    }
                }

                const formattedDate = formatDate(data.created_at);

                var messageHtml = `
                <a href="#" class="dropdown-item dropdown-item-unread">
                    <div class="dropdown-item-avatar">
                        <img alt="image" src="/avatar/${data.sender_id}" class="rounded-circle">
                        <div class="is-online"></div>
                    </div>
                    <div class="dropdown-item-desc">
                        <b>Новое сообщение</b>
                        <p>${data.message}</p>
                        <div class="time">${formattedDate}</div>
                    </div>
                </a>
                `;

                // Добавляем сообщение в начало списка
                const messageContainer = document.querySelector('.dropdown-list-message');
                if (messageContainer) {
                    messageContainer.insertAdjacentHTML('afterbegin', messageHtml);
                }

                // Добавляем класс beep
                const messageIcon = document.getElementById('message-icon');                
                messageIcon.classList.add('beep');

                // Обновляем Livewire компонент
                Livewire.dispatch('refresh');

            } catch (error) {
                console.error('Ошибка при обработке сообщения:', error);
            }
        });
    </script>

    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>


    <ul class="navbar-nav navbar-right">

        <li class="dropdown dropdown-list-toggle"><a id="message-icon" href="#" data-toggle="dropdown" 
            class="nav-link nav-link-lg message-toggle {{ count($chatUsers) > 0 ? 'beep' : '' }}">
            <i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                @foreach ($chatUsers as $chatUser)
                <a href="{{ route('admin.chat', $chatUser->id) }}" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="{{ asset($chatUser->avatar) }}" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>{{ ucfirst($chatUser->name) }}</b>
                    <p>{{ $chatUser->unread_messages }} unread messages</p>
                    <div class="time">{{ $this->getFormattedDate($chatUser->chats_max_created_at) }}</div>
                  </div>
                </a>
                @endforeach
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
        <li class="dropdown dropdown-list-toggle">
        <a id="bell" href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg {{ count($messages) > 0 ? 'beep' : '' }}">
        <i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="#" wire:click.prevent='markAllSeen'>Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons rt_notification">
                    @if ($messages->count() > 0)
                        @foreach ($messages as $message)
                            <a href="{{ route('admin.orders.show', $message->order_id) }}" class="dropdown-item">
                                <div class="dropdown-item-icon bg-info text-white">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    {{ $message->message }}
                                    <div class="time">{{ $this->getFormattedDate($message->created_at) }}</div>
                                    <div class="time">{{ date('h:i | d, F Y', strtotime($message->created_at)) }}</div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
                <div class="dropdown-footer text-center">
                    <a href="{{ route('admin.orders.index') }}">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li>
            <button onclick="initSound()" class="btn btn-sm btn-primary">
                <i id="soundIcon" class="fas fa-volume-mute"></i>
            </button>
        </li>

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset(auth()->user()->avatar) }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon" wire:navigate>
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="features-activities.html" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="javascrip:;" class="dropdown-item has-icon text-danger" wire:click.prevent="logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>

</nav>
