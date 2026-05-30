import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: 'cdprado.local', // O seu Virtual Host aqui
        cors: true,
        hmr: {
            host: 'cdprado.local',
        },
    },
});
