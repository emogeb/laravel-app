import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { renderToString } from '@vue/server-renderer';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createSSRApp, h } from 'vue';
import { route as ziggyRoute } from 'ziggy-js';
import { createHead } from '@vueuse/head';
import { MotionPlugin } from '@vueuse/motion';

// Vue global property tip genişletmesi
declare module 'vue' {
  interface ComponentCustomProperties {
    route: typeof ziggyRoute;
  }
}

const appName = import.meta.env.VITE_APP_NAME || 'Türk Teknik';

createServer((page) =>
  createInertiaApp({
    page,
    render: renderToString,
    title: (title) => {
      if (title && title.includes('Türk Teknik')) return title;
      if (title) return `${title} | Türk Teknik`;
      return `${appName} | İzmir Teknik Servis`;
    },
    resolve: async (name) => {
      // Modül tipi: { default: DefineComponent }
      const pages = import.meta.glob<{ default: DefineComponent }>('./pages/**/*.vue');
      const pagePath = `./pages/${name}.vue`;

      if (name === 'services.camera') {
        return resolvePageComponent('./pages/CameraService.vue', pages);
      } else if (name === 'services.internet') {
        return resolvePageComponent('./pages/InternetService.vue', pages);
      } else if (name === 'services.satellite') {
        return resolvePageComponent('./pages/SatelliteService.vue', pages);
      }

      return resolvePageComponent(pagePath, pages);
    },
    setup({ App, props, plugin }) {
      const head = createHead();
      const app = createSSRApp({ render: () => h(App, props) });

      const ziggy = (page.props as any).ziggy ?? {};
      const ziggyConfig = {
        ...ziggy,
        location: new URL(ziggy.location),
      } as any;

      const route: typeof ziggyRoute = (name?: any, params?: any, absolute?: any) =>
        ziggyRoute(name as any, params, absolute, ziggyConfig) as any;

      // Vue componentlarında this.route erişimi için
      app.config.globalProperties.route = route;

      // SSR ortamında global erişim
      (globalThis as any).route = route;

      app.use(plugin).use(head).use(MotionPlugin);

      return app;
    },
  }),
);