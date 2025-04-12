import axios from 'axios';
import Pusher from "pusher-js";


window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true,

});

// Echo.private('App.Models.User.3')
//     .notification((notification) => {
//         console.log(notification.message);
//     });

window.Pusher = Pusher;
var pusher = new Pusher('77cd51035dad53e2b7aa', {
    cluster: 'mt1'
});
Pusher.logToConsole = true;
var channel = pusher.subscribe('user');

channel.bind('App\\Events\\UserFollowed', function (data) {
    console.log(data);
});
// console.log("User ID: ", userId);
// window.Echo.private(`user.${userId}`)
//     .listen('user.followed', (e) => {
//         console.log(' إشعار جديد: ', e.message);
//     });




