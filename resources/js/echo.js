import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
   broadcaster: 'reverb',
   key: import.meta.env.VITE_REVERB_APP_KEY,
   wsHost: import.meta.env.VITE_REVERB_HOST,
   wsPort: 8081,
   wssPort: 8081,
   forceTLS: true,
   enabledTransports: ['ws', 'wss'],
});
