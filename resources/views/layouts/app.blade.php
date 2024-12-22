// В секции head
@livewireStyles

// Перед закрывающим тегом body
@livewireScripts

<head>
    <!-- ... other tags ... -->
    
    @vite(['resources/js/app.js'])
    
    <!-- Добавляем скрипты для Echo и Pusher -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ config('broadcasting.connections.pusher.key') }}',
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
            encrypted: true
        });
    </script>
</head>
