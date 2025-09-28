<template>
  <AppLayout :services="services">
    <Head title="Kamera Sistemleri" />

    <div class="container mx-auto px-4 py-8 relative">
      <!-- SVG Blob Background -->
      <div class="absolute inset-0 opacity-3 dark:opacity-5">
        <svg viewBox="0 0 800 600" preserveAspectRatio="none" class="w-full h-full">
          <path d="M0,100 C200,50 400,150 600,80 C700,30 800,120 800,250 L800,600 L0,600 Z" fill="url(#cameraGradient)" class="animate-pulse"></path>
          <defs>
            <linearGradient id="cameraGradient" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.15" />
              <stop offset="100%" style="stop-color:#1E40AF;stop-opacity:0.08" />
            </linearGradient>
          </defs>
        </svg>
      </div>

      <h1 class="text-3xl font-bold mb-8 text-center relative z-10">Kamera Sistemleri Hizmetleri</h1>

      <!-- Kamera Kurulumu Section -->
      <section class="mb-12 relative z-10">
        <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Kamera Kurulumu</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">IP Kamera Kurulumu</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Ev veya iş yeriniz için modern ve yüksek çözünürlüklü IP kamera sistemleri kurulumu. Uzman ekibimizle güvenliğinizi en üst düzeye çıkarın.
            </p>
            <p class="text-blue-600 dark:text-blue-400 font-semibold group-hover:scale-105 transition-transform duration-300">Esnek fiyat tarifeleri için bizimle iletişime geçin.</p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">IP Kamera Kurulumu Görseli</span>
            </div>
          </div>
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Analog Kamera Kurulumu</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Mevcut altyapınıza uygun, ekonomik ve güvenilir analog kamera sistemleri kurulumu. İhtiyaçlarınıza özel çözümler sunuyoruz.
            </p>
            <p class="text-blue-600 dark:text-blue-400 font-semibold group-hover:scale-105 transition-transform duration-300">Esnek fiyat tarifeleri için bizimle iletişime geçin.</p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">Analog Kamera Kurulumu Görseli</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Kamera Arızası Section -->
      <section class="relative z-10">
        <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Kamera Arızası ve Bakım</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Arıza Tespiti ve Tamiri</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Çalışmayan kameraların tespiti, onarımı veya değişimi. Görüntü alamama, kayıt sorunları gibi tüm arızalara profesyonel çözümler.
            </p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">Kamera Arıza Görseli</span>
            </div>
          </div>
          <div class="group">
            <h3 class="text-xl font-semibold mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Sistem Güncelleme ve Ayarlar</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 group-hover:translate-x-1 transition-transform duration-300">
              Kamera açısı ayarları, hard disk hatalarının giderilmesi, kamera sayısı artırımı ve sistem yapılandırması hizmetleri.
            </p>
            <!-- Placeholder Image -->
            <div class="mt-4 bg-gray-200 dark:bg-gray-700 h-48 flex items-center justify-center rounded-md group-hover:shadow-lg transition-all duration-300">
              <span class="text-gray-500 dark:text-gray-400">Sistem Ayarları Görseli</span>
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