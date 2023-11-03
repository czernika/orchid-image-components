import { defineConfig } from 'vite'

export default defineConfig({
    build: {
        rollupOptions: {
            input: [
                'resources/css/image.css'
            ],
            output: {
                assetFileNames: (assetInfo) => {
                    // @ts-ignore It is ok type is defined in Rollup
                    let extType = assetInfo.name.split('.').at(1);

                    return `${extType}/[name][extname]`;
                },
            },
        }
    },
})
