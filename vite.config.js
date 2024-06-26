import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/main.js',
                'resources/scss/bootstrap.scss',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            'select2': 'node_modules/select2/dist/js/select2.full.min.js',

        }
    },
});
