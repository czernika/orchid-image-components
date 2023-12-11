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
                'resources/js/lightbox.js'
            ],
            output: {
                assetFileNames: (assetInfo) => {
                    // @ts-ignore It is ok type is defined in Rollup
                    let extType = assetInfo.name.split('.').at(1);

                    return `${extType}/[name][extname]`;
                },
                chunkFileNames: 'js/[name].js',
                entryFileNames: 'js/[name].js',
            },
        }
    },
})
