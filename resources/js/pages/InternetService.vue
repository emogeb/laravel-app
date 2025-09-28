<template>
  <AppLayout :services="services">
    <Head title="İnternet Hizmetleri" />

    <div class="container mx-auto px-4 py-8 relative">
      <!-- SVG Blob Background -->
      <div class="absolute inset-0 opacity-3 dark:opacity-5">
        <svg viewBox="0 0 800 600" preserveAspectRatio="none" class="w-full h-full">
          <path d="M0,150 C200,100 400,200 600,120 C700,80 800,180 800,300 L800,600 L0,600 Z" fill="url(#internetGradient)" class="animate-pulse"></path>
          <defs>
            <linearGradient id="internetGradient" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.15" />
              <stop offset="100%" style="stop-color:#1E40AF;stop-opacity:0.08" />
            </linearGradient>
          </defs>
        </svg>
      </div>

      <h1 class="text-3xl font-bold mb-8 text-center relative z-10">İnternet Hizmetleri</h1>

      <!-- DSL Kurulum Section -->
      <section class="mb-12 relative z-10">
        <h2 class="text-2xl font-semibold mb-6 border-b pb-2">DSL Kurulum</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">İnternet Bağlantısı Kurulumu</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Yeni internet aboneliğinizin baştan sona kurulumu, modem yapılandırması ve PPP ayarlarının yapılması.
            </p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">İnternet Bağlantısı Görseli</span>
            </div>
          </div>
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Kablo Çekimi ve Yapılandırma</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Mevcut veya yeni kablo çekimi, modem ve router cihazlarının profesyonelce yapılandırılması.
            </p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">Kablo Çekimi Görseli</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Ağ Altyapısı Section -->
      <section class="relative z-10">
        <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Ağ Altyapısı</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Access Point ve Deco Kurulumu</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Geniş alanlarda kesintisiz WiFi erişimi için Access Point ve Deco Mesh sistemlerinin kurulumu ve optimizasyonu.
            </p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">Access Point Görseli</span>
            </div>
          </div>
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Geniş Alan Network Kablolama Projeleri</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Ev veya iş yeriniz için profesyonel network kablolama çözümleri. Güvenli ve hızlı bir ağ altyapısı kuruyoruz.
            </p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">Network Kablolama Görseli</span>
            </div>
          </div>
        </div>
      </section>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

// Assuming services are needed for AppLayout, provide an empty array for now
const services = ref([]);

</script> 