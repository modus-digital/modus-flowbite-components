import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/ts/pin-input.ts',
                'resources/ts/toast.ts',
                'resources/ts/dropzone.ts',
                'resources/ts/select.ts',
            ],
            refresh: true,
            publicDirectory: 'resources',
            buildDirectory: 'dist',
        }),
    ],
    build: {
        sourcemap: false,
        manifest: false,
        minify: true,
        rollupOptions: {
            output: {
                entryFileNames: `[name].js`,
                chunkFileNames: `[name].js`,
                assetFileNames: `[name].[ext]`
            },
        },
    },
    server: {
        host: '127.0.0.1',
        port: 5174,
        hmr: true,
    },
}); 