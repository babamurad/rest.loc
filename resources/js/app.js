import './bootstrap';
import Echo from 'laravel-echo';
window.Echo = Echo;

import.meta.glob([
    // Импортировать все файлы в /resources/images/
    '../images/**',
    '../assets/**',
    ]);