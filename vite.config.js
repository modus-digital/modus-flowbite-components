import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.ts'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            input: {
                'scripts': 'resources/js/app.ts',
                'styles': 'resources/css/app.css',
            },
            output: {
                entryFileNames: '[name].js',
                assetFileNames: ({ name }) => {
                    if (name.endsWith('.css'))  return 'assets/[name].css';
                    return 'assets/[name].[ext]';
                },
                chunkFileNames: 'assets/[name].js',
            },
        }
    }
}); 