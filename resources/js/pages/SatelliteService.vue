<template>
  <AppLayout :services="services">
    <Head title="Uydu Sistemleri" />

    <div class="container mx-auto px-4 py-8 relative">
      <!-- SVG Blob Background -->
      <div class="absolute inset-0 opacity-3 dark:opacity-5">
        <svg viewBox="0 0 800 600" preserveAspectRatio="none" class="w-full h-full">
          <path d="M0,120 C200,80 400,160 600,100 C700,60 800,140 800,280 L800,600 L0,600 Z" fill="url(#satelliteGradient)" class="animate-pulse"></path>
          <defs>
            <linearGradient id="satelliteGradient" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.15" />
              <stop offset="100%" style="stop-color:#1E40AF;stop-opacity:0.08" />
            </linearGradient>
          </defs>
        </svg>
      </div>

      <h1 class="text-3xl font-bold mb-8 text-center relative z-10">Uydu Sistemleri Hizmetleri</h1>

      <!-- Çanak Anten Arıza Section -->
      <section class="mb-12 relative z-10">
        <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Çanak Anten Arıza ve Bakım</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Arıza Tespiti ve Onarım</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Çekmeyen çanak sorunları, bazı kanalları göstermeme gibi uydu anten sistemi arızalarına hızlı ve etkili çözümler.
            </p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">Çanak Anten Arıza Görseli</span>
            </div>
          </div>
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Hat Çekimi ve TV Kurulumu</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Yeni hat çekimi, LNB çoklama ve farklı odalara TV kurulumu ve yapılandırması hizmetleri.
            </p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">Hat Çekimi Görseli</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Uydu Kurulumu Section -->
      <section class="relative z-10">
        <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Uydu Kurulumu ve Ayarlama</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Sıfırdan Çanak Kurulumu</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Yeni çanak antenin yer tespiti, montajı ve hassas ayarlarının yapılması.
            </p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">Çanak Kurulumu Görseli</span>
            </div>
          </div>
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Kanal Ayarlama ve Receiver Yapılandırma</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Uydu alıcınızda kanal arama, sıralama ve gerekli tüm yapılandırmaların yapılması.
            </p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">Receiver Ayarlama Görseli</span>
            </div>
          </div>
        </div>
      </section>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

// Assuming services are needed for AppLayout, provide an empty array for now
const services = ref([]);

</script> 