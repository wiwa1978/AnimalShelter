import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/admin/theme.css'],
            refresh: true,
        }),
    ],
    // server: {
    //     https: {
    //         key: 'C:/Laragon/etc/ssl/laragon.key',
    //         cert: 'C:/Laragon/etc/ssl/laragon.crt',
    //     },
    // },
});
