import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

<<<<<<< HEAD
//console.log('import.meta');

=======
>>>>>>> a8e8e3998b59918244e5ca6150febc7d4add159d
window.Echo.channel('order-placed')
    .listen('RTOrderPlacedNotificationEvent', (e) => {
    //console.log(e);
});
