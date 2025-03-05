import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {stylus} from "laravel-mix";
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            css: {
                preprocessorOptions: {
                    stylus: {
                        imports: [path.resolve(__dirname, 'resources/css/skins/ice/app.styl')]
                    }
                }
            },
            refresh: true,
        }),


    ],
});
