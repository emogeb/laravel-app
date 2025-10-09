import { resolve } from 'path';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig(({ command, isSsrBuild }) => ({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            '@': resolve(__dirname, './resources/js'),
            'ziggy-js': resolve(__dirname, 'vendor/tightenco/ziggy'),
        },
    },
    server: {
        hmr: {
            host: '127.0.0.1',
            port: 5173,
        },
        host: '127.0.0.1',
        port: 5173,
    },
    build: {
        target: 'esnext',
        outDir: isSsrBuild ? 'bootstrap/ssr' : 'public/build',
        assetsDir: 'assets',
        emptyOutDir: isSsrBuild ? false : true,
        manifest: !isSsrBuild,
        rollupOptions: isSsrBuild ? undefined : {
            input: {
                app: resolve(__dirname, 'resources/js/app.ts'),
            },
        },
    },
    // SSR Build Configuration
    ssr: {
        noExternal: ['@inertiajs/vue3', 'ziggy-js'],
    },
}));
