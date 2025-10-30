<script setup lang="ts">
import type { BreadcrumbItemType } from '@/types';
import { Link } from '@inertiajs/vue3';
import Footer from '@/components/Footer.vue';

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
            Türk Teknik
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
  
  </div>
</template>
