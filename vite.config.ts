import { defineConfig } from 'vite'

export default defineConfig({
    resolve: {
        alias: {
            '@css': 'resources/css',
        },
    },

    build: {
        rollupOptions: {
            input: [
                'resources/css/image.css',
                'resources/js/lightbox.js',
                'resources/js/carousel.js',
            ],
            output: {
                assetFileNames: (assetInfo) => {
                    let extType = assetInfo.name ? assetInfo.name.split('.').at(1) : 'asset';

                    return `${extType}/[name][extname]`;
                },
                chunkFileNames: 'js/[name].js',
                entryFileNames: 'js/[name].js',
            },
        }
    },
})
