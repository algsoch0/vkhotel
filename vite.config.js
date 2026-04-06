import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
            },
        },
        rollupOptions: {
            output: {
                manualChunks: {
                    'vendor': [
                        'axios',
                        'bootstrap',
                        'sweetalert2',
                        'swiper',
                    ],
                    'utils': [
                        'aos',
                        'date-fns',
                    ],
                },
            },
        },
        chunkSizeWarningLimit: 1000,
        cssCodeSplit: true,
        reportCompressedSize: false,
    },
    server: {
        hmr: {
            host: 'localhost',
            port: 5173,
        },
    },
    performance: {
        maxEntrypointSize: 512000,
        maxAssetSize: 512000,
    },
});
