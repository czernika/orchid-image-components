import { defineConfig, squooshImageService } from 'astro/config';
import starlight from '@astrojs/starlight';

// https://astro.build/config
export default defineConfig({
    site: 'https://czernika.github.io',
    base: 'orchid-image-components',
    image: {
        service: squooshImageService(),
    },
	integrations: [
		starlight({
            defaultLocale: 'root',
            locales: {
                root: { label: 'En', lang: 'en' },
                ru: { label: 'Ru' },
            },
			title: 'Orchid Images v2.x',
            description: 'Package that adds new image-based components to your Orchid app',
			social: {
				github: 'https://github.com/czernika/orchid-image-components',
			},
			sidebar: [
                {
                    label: 'Introduction',
                    translations: {
                        ru: 'Введение',
                    },
                    link: '/',
                },
				{
					label: 'Getting Started',
                    translations: {
                        ru: 'Начало работы',
                    },
					autogenerate: { directory: 'introduction' },
				},
                {
					label: 'Usage',
                    translations: {
                        ru: 'Использование',
                    },
					autogenerate: { directory: 'usage' },
				},
			],
		}),
	],
});
