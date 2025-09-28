<script setup lang="ts">
import type { BreadcrumbItemType } from '@/types';
import { Link } from '@inertiajs/vue3';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
    services: any[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
    services: () => [],
});
</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <!-- Header -->
    <header class="bg-white shadow dark:bg-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
          <Link :href="route('home')" class="text-2xl font-bold text-gray-900 dark:text-white">
            Fast Teknik
          </Link>
          <nav class="space-x-4">
            <Link :href="route('services.index')" class="text-gray-600 hover:text-orange-600 dark:text-gray-300 dark:hover:text-orange-400">
              Hizmetlerimiz
            </Link>
            <Link :href="route('contact')" class="text-gray-600 hover:text-orange-600 dark:text-gray-300 dark:hover:text-orange-400">
              İletişim
            </Link>
          </nav>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div>
            <h3 class="text-lg font-semibold mb-4">Fast Teknik</h3>
            <p class="text-gray-300">
              İzmir'in güvenilir teknik servis çözümleri.
            </p>
          </div>
          <div>
            <h3 class="text-lg font-semibold mb-4">Hizmetlerimiz</h3>
            <ul class="space-y-2">
              <li v-for="service in services" :key="service.id">
                <Link :href="route('services.show', service.slug)" class="text-gray-300 hover:text-orange-400">
                  {{ service.name }}
                </Link>
              </li>
            </ul>
          </div>
          <div>
            <h3 class="text-lg font-semibold mb-4">İletişim</h3>
            <ul class="space-y-2 text-gray-300">
              <li>Adres: İzmir, Türkiye</li>
              <li>Telefon: +90 555 123 4567</li>
              <li>Email: info@fastteknik.com</li>
            </ul>
          </div>
        </div>
        <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
          <p>&copy; {{ new Date().getFullYear() }} Fast Teknik. Tüm hakları saklıdır.</p>
        </div>
      </div>
    </footer>
  </div>
</template>
