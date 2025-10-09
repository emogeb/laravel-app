import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { renderToString } from '@vue/server-renderer';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createSSRApp, h } from 'vue';
import { route as ziggyRoute } from 'ziggy-js';
import { createHead } from '@vueuse/head';
import { MotionPlugin } from '@vueuse/motion';

const appName = import.meta.env.VITE_APP_NAME || 'Fast Teknik';

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => {
            // If title already contains "Fast Teknik", don't append again
            if (title && title.includes('Fast Teknik')) {
                return title;
            }
            // If title exists, append brand
            if (title) {
                return `${title} | Fast Teknik`;
            }
            // Default fallback
            return 'Fast Teknik | İzmir Teknik Servis';
        },
        resolve: (name) => {
            const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue');
            const pagePath = `./pages/${name}.vue`;

            // Custom resolution for service pages
            if (name === 'services.camera') {
                return resolvePageComponent('./pages/CameraService.vue', pages);
            } else if (name === 'services.internet') {
                return resolvePageComponent('./pages/InternetService.vue', pages);
            } else if (name === 'services.satellite') {
                return resolvePageComponent('./pages/SatelliteService.vue', pages);
            }

            // Default resolution for other pages
            return resolvePageComponent(pagePath, pages);
        },
        setup({ App, props, plugin }) {
            const head = createHead();
            const app = createSSRApp({ render: () => h(App, props) });

            // Configure Ziggy for SSR...
            const ziggyConfig = {
                ...page.props.ziggy,
                location: new URL(page.props.ziggy.location),
            };

            // Create route function...
            const route = (name: string, params?: any, absolute?: boolean) => ziggyRoute(name, params, absolute, ziggyConfig);

            // Make route function available globally...
            app.config.globalProperties.route = route;

            // Make route function available globally for SSR...
            if (typeof window === 'undefined') {
                global.route = route;
            }

            app.use(plugin)
                .use(head)
                .use(MotionPlugin);

            return app;
        },
    }),
);
