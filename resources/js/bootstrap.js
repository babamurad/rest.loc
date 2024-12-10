import axios from 'axios';
// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */



// import './echo';
// window.Pusher = Pusher;

<<<<<<< HEAD
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: pusherKey,
//     cluster: pusherCluster,
//     wsHost: import.meta.env.VITE_REVERB_HOST,
//     wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
//     wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

// window.Echo.channel('order-placed')
//     .listen('RTOrderPlacedNotificationEvent', (e) => {
//         console.log(e);
//     });
=======
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: pusherKey,
    cluster: pusherCluster,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log("Pusher connected");
    // Now, Echo is fully initialized, you can use Echo.private() here
    window.Echo.channel('order-placed')
        .listen('RTOrderPlacedNotificationEvent', (e) => {
            alert(e);
            console.log(e);
            // Handle the event data
        });
});

/*Echo.channel('order-placed')
    .listen('NewMessage', (e) => {
        console.log(e.message);
    });*/

/*window.Echo.channel('order-placed')
    .listen('.message.sent', (e) => {  // Обратите внимание на точку перед именем события
        console.log('New message:', e.message);
    });*/

/*window.Echo.channel('order-placed')
    .listen('RTOrderPlacedNotificationEvent', (e) => {
        console.log(e);
    });*/
>>>>>>> a8e8e3998b59918244e5ca6150febc7d4add159d
