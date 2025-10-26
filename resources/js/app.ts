import '../css/app.css';

import { createInertiaApp, router } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';
import { createHead } from '@vueuse/head';
import { MotionPlugin } from '@vueuse/motion';
// Lazy load AOS for better initial page load
let AOS: any = null;
let aosInitialized = false;

// Declare gtag for TypeScript
declare global {
    interface Window {
        gtag?: (...args: any[]) => void;
    }
}

const appName = import.meta.env.VITE_APP_NAME || 'Türk Teknik';
const head = createHead();

createInertiaApp({
    title: (title) => {
        // If title already contains "Türk Teknik", don't append again
        if (title && title.includes('Türk Teknik')) {
            return title;
        }
        // If title exists, append brand
        if (title) {
            return `${title} | Türk Teknik`;
        }
        // Default fallback
        return 'Türk Teknik | İzmir Teknik Servis';
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
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        
        app.use(plugin)
            .use(ZiggyVue)
            .use(head)
            .use(MotionPlugin)
            .mount(el);

        const scheduleAOSInit = () => {
            const isMobileDevice = typeof window !== 'undefined'
                ? window.matchMedia('(max-width: 767px)').matches
                : false;

            if (isMobileDevice) {
                document.body.classList.add('aos-disabled');
                return;
            }

            const loadAOS = () => {
                if (aosInitialized) {
                    return;
                }

                import('aos').then((module) => {
                    if (aosInitialized) {
                        return;
                    }

                    AOS = module.default;
                    import('aos/dist/aos.css');
                    AOS.init({
                        duration: 800,
                        easing: 'ease-in-out',
                        once: true,
                        offset: 100,
                    });

                    document.addEventListener('inertia:success', () => {
                        if (!AOS) {
                            return;
                        }

                        setTimeout(() => {
                            AOS.refresh();
                        }, 100);
                    });

                    aosInitialized = true;
                });
            };

            if ('requestIdleCallback' in window) {
                requestIdleCallback(loadAOS, { timeout: 2000 });
            } else {
                setTimeout(loadAOS, 1000);
            }
        };

        scheduleAOSInit();
    },
    progress: {
        color: '#4B5563',
    },
});

// Google Analytics 4 - Track page views on SPA navigation
router.on('navigate', (event) => {
    if (typeof window.gtag === 'function') {
        // Get the full URL path
        const url = event.detail.page.url;
        
        window.gtag('config', 'G-2DW9PGYTDR', {
            page_path: url,
            page_title: document.title,
        });
        
        // Also send a page_view event for better tracking
        window.gtag('event', 'page_view', {
            page_path: url,
            page_title: document.title,
        });
    }
});

// This will set light / dark mode on page load...
initializeTheme();
