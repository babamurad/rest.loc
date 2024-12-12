<nav class="navbar navbar-expand-lg main-navbar">

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        //Pusher.logToConsole = true;

        var pusher = new Pusher('e4438ee202f5ef502f3f', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('order-placed');

        channel.bind('order-event', function(data) {

            function formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffInMs = now - date;

        const seconds = Math.floor(diffInMs / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);

        if (days > 0) {
            return `${days} день${days === 1 ? '' : 'а'} назад`;
        } else if (hours > 0) {
            return `${hours} час${hours === 1 ? '' : 'а'} назад`;
        } else if (minutes > 0) {
            return `${minutes} минут${minutes === 1 ? 'у' : 'ы'} назад`;
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
