<template>
  <footer class="bg-gray-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <!-- Main Footer Content -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
        <!-- Company Info -->
        <div class="lg:col-span-1">
          <h3 class="text-xl font-bold mb-4">Türk Teknik</h3>
          <p class="text-gray-300 mb-4">
            İzmir'in güvenilir teknik servis çözümleri. Kamera sistemleri, internet altyapısı ve uydu sistemleri konularında uzman hizmet.
          </p>
          <div class="flex space-x-4">
            <a href="tel:+905469118061" class="text-gray-400 hover:text-white transition-colors duration-200">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
            </a>
            <a href="mailto:info@turkteknik.com" class="text-gray-400 hover:text-white transition-colors duration-200">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </a>
          </div>
        </div>

        <!-- Hakkımızda -->
        <div>
          <h3 class="text-lg font-semibold mb-4">Hakkımızda</h3>
          <ul class="space-y-2 text-gray-300 text-sm">
            <li v-for="link in visibleAboutLinks" :key="link.href">
              <a :href="link.href" class="hover:text-white transition-colors duration-200">{{ link.label }}</a>
            </li>
          </ul>
          <button
            v-if="aboutLinks.length > maxVisible"
            class="mt-2 text-sm text-purple-300 hover:text-white transition-colors"
            @click="aboutExpanded = !aboutExpanded"
          >
            {{ aboutExpanded ? 'Daha Az' : 'Daha Fazla' }}
          </button>
        </div>

        <!-- Hizmetler -->
        <div>
          <h3 class="text-lg font-semibold mb-4">Hizmetler</h3>
          <ul class="space-y-2 text-gray-300 text-sm">
            <li v-for="link in visibleServiceLinks" :key="link.href">
              <a :href="link.href" class="hover:text-white transition-colors duration-200">{{ link.label }}</a>
            </li>
          </ul>
          <button
            v-if="serviceLinks.length > maxVisible"
            class="mt-2 text-sm text-purple-300 hover:text-white transition-colors"
            @click="serviceExpanded = !serviceExpanded"
          >
            {{ serviceExpanded ? 'Daha Az' : 'Daha Fazla' }}
          </button>
        </div>

        <!-- Bilgiler & Yardım -->
        <div>
          <h3 class="text-lg font-semibold mb-4">Bilgiler</h3>
          <ul class="space-y-2 text-gray-300 text-sm mb-2">
            <li v-for="link in visibleInfoLinks" :key="link.href">
              <a :href="link.href" class="hover:text-white transition-colors duration-200">{{ link.label }}</a>
            </li>
          </ul>
          <button
            v-if="infoLinks.length > maxVisible"
            class="mb-6 text-sm text-purple-300 hover:text-white transition-colors"
            @click="infoExpanded = !infoExpanded"
          >
            {{ infoExpanded ? 'Daha Az' : 'Daha Fazla' }}
          </button>
          
          <h3 class="text-lg font-semibold mb-4">Yardım</h3>
          <ul class="space-y-2 text-gray-300 text-sm">
            <li v-for="link in visibleHelpLinks" :key="link.href">
              <a :href="link.href" class="hover:text-white transition-colors duration-200">{{ link.label }}</a>
            </li>
          </ul>
          <button
            v-if="helpLinks.length > maxVisible"
            class="mt-2 text-sm text-purple-300 hover:text-white transition-colors"
            @click="helpExpanded = !helpExpanded"
          >
            {{ helpExpanded ? 'Daha Az' : 'Daha Fazla' }}
          </button>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="border-t border-gray-700 pt-8 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
            </div>
            <div>
              <p class="text-sm text-gray-400">Telefon</p>
              <p class="font-semibold">+90 546 911 80 61</p>
            </div>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </div>
            <div>
              <p class="text-sm text-gray-400">E-posta</p>
              <p class="font-semibold">info@turkteknik.com</p>
            </div>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
            <div>
              <p class="text-sm text-gray-400">Adres</p>
              <p class="font-semibold">İzmir, Türkiye</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom Footer -->
      <div class="border-t border-gray-700 pt-8">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
          <div class="text-gray-400 text-sm">
            <p>&copy; {{ new Date().getFullYear() }} Türk Teknik. Tüm hakları saklıdır.</p>
          </div>
          <div class="flex space-x-6 text-sm">
            <a href="/bilgiler/kvkk-aydinlatma-metni" class="text-gray-400 hover:text-white transition-colors duration-200">KVKK</a>
            <a href="/bilgiler/cerez-politikasi" class="text-gray-400 hover:text-white transition-colors duration-200">Çerez Politikası</a>
            <a href="/yardim/sikayet-ve-oneri" class="text-gray-400 hover:text-white transition-colors duration-200">Şikayet & Öneri</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { ref, computed } from 'vue';

const maxVisible = 6;

const aboutExpanded = ref(false);
const serviceExpanded = ref(false);
const infoExpanded = ref(false);
const helpExpanded = ref(false);

const aboutLinks = [
  { label: 'Bizi Tanıyın', href: '/hakkimizda/bizi-taniyin' },
  { label: 'Şeffaflık Raporu', href: '/hakkimizda/seffaflik-raporu' },
  { label: 'İletişim', href: '/hakkimizda/iletisim' },
  { label: 'Blog', href: '/hakkimizda/blog' },
  { label: 'Fast Teknik Deneyimi', href: '/hakkimizda/fast-teknik-deneyimi' },
];

const serviceLinks = [
  { label: 'Sıfırdan Kamera Kurulumu', href: '/hizmetler/sifirdan-kamera-kurulumu' },
  { label: 'Kayıt Cihazı Arızaları', href: '/hizmetler/kayit-cihazi-arizalari' },
  { label: 'Kamera Uzaktan İzleme', href: '/hizmetler/kamera-uzaktan-izleme' },
  { label: 'Kamera Ayarı', href: '/hizmetler/kamera-ayari' },
  { label: 'Hız Testi', href: '/hizmetler/hiz-testi' },
  { label: 'Modem Kurulumu', href: '/hizmetler/modem-kurulumu' },
  { label: 'İç Tesisat Sorunları', href: '/hizmetler/ic-tesisat' },
  { label: 'Sıfırdan Hat Çekimi', href: '/hizmetler/hat-cekimi' },
  { label: 'Router & Access Point', href: '/hizmetler/router-access-point' },
  { label: 'Mesh Sistemleri', href: '/hizmetler/mesh-deco' },
  { label: 'İnternet Hız Düşüklüğü', href: '/hizmetler/internet-arizalari' },
  { label: 'Çanak Anten Kurulumu', href: '/hizmetler/canak-anten-kurulumu' },
  { label: 'Çanak Anten Ayarı', href: '/hizmetler/canak-anten-ayari' },
  { label: 'TV Hasarlı Kablo Yenileme', href: '/hizmetler/tv-kablo-yenileme' },
  { label: 'Çekmeyen Kanallar Çözümü', href: '/hizmetler/cekneyen-kanallar' },
  { label: 'TKGS Yapılandırma', href: '/hizmetler/tkgs-yapilandirma' },
];

const infoLinks = [
  { label: 'KVKK Aydınlatma Metni', href: '/bilgiler/kvkk-aydinlatma-metni' },
  { label: 'Servis Talepleri', href: '/servis-talepleri' },
  { label: 'Çerez Politikası', href: '/bilgiler/cerez-politikasi' },
  { label: 'Yasal Bilgiler', href: '/bilgiler/yasal-bilgiler' },
  { label: 'Kalite Politikası', href: '/bilgiler/kalite-politikasi' },
  { label: 'ISG Politikası', href: '/bilgiler/isg-politikasi' },
];

const helpLinks = [
  { label: 'Şikayet ve Öneri', href: '/yardim/sikayet-ve-oneri' },
];

const visibleAboutLinks = computed(() => aboutExpanded.value ? aboutLinks : aboutLinks.slice(0, maxVisible));
const visibleServiceLinks = computed(() => serviceExpanded.value ? serviceLinks : serviceLinks.slice(0, maxVisible));
const visibleInfoLinks = computed(() => infoExpanded.value ? infoLinks : infoLinks.slice(0, maxVisible));
const visibleHelpLinks = computed(() => helpExpanded.value ? helpLinks : helpLinks.slice(0, maxVisible));
</script>
