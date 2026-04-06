import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// Hapus import tailwindcss dari baris ini

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        // Hapus `tailwindcss(),` dari array ini
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});