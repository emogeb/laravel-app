<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16">
    <TopBar />
    <SEO
      title="Fast Teknik | Hizmetlerimiz"
      description="Fast Teknik'in sunduğu tüm teknik servis hizmetleri. Kamera sistemleri, internet hizmetleri ve uydu sistemleri için profesyonel çözümler."
      keywords="teknik servis, kamera kurulumu, internet hizmetleri, uydu sistemleri, çanak anten"
      url="https://fastteknik.com/services"
    />

    <div class="max-w-7xl mx-auto py-6 sm:py-12 px-4 sm:px-6 lg:px-8 relative">
      <!-- SVG Blob Background -->
      <div class="absolute inset-0 opacity-5 dark:opacity-10">
        <svg viewBox="0 0 1200 800" preserveAspectRatio="none" class="w-full h-full">
          <path d="M0,200 C300,100 600,300 900,150 C1100,50 1200,200 1200,400 L1200,800 L0,800 Z" fill="url(#servicesGradient)" class="animate-pulse"></path>
          <path d="M0,300 C400,200 700,400 1000,250 C1150,150 1200,300 1200,500 L1200,800 L0,800 Z" fill="url(#servicesGradient2)" class="animate-pulse" style="animation-delay: 1s;"></path>
          <defs>
            <linearGradient id="servicesGradient" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.3" />
              <stop offset="100%" style="stop-color:#1E40AF;stop-opacity:0.1" />
            </linearGradient>
            <linearGradient id="servicesGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:#60A5FA;stop-opacity:0.2" />
              <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:0.05" />
            </linearGradient>
          </defs>
        </svg>
      </div>

      <!-- Breadcrumb Navigation -->
      <nav class="flex mb-4 sm:mb-6 relative z-10" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2">
          <li>
            <Link :href="route('home')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors duration-300">
              Anasayfa
            </Link>
          </li>
          <li>
            <span class="text-gray-400 mx-2">/</span>
          </li>
          <li>
            <span class="text-gray-700 dark:text-gray-300">Hizmetlerimiz</span>
          </li>
        </ol>
      </nav>

      <div class="text-center relative z-10">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
          Hizmetlerimiz
        </h1>
        <p class="mt-2 sm:mt-4 text-base sm:text-lg text-gray-500 dark:text-gray-300">
          Tüm teknik servis ihtiyaçlarınız için profesyonel çözümler
        </p>
      </div>

      <div class="mt-8 sm:mt-12 space-y-8 sm:space-y-12 relative z-10">
        <div v-for="(service, index) in services" :key="service.slug" 
             class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 ease-in-out w-[88%] mx-auto group">
          <div class="p-4 sm:p-6">
            <div class="text-center">
              <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                {{ service.title }}
              </h3>
              <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-gray-500 dark:text-gray-300">
                {{ service.description }}
              </p>
            </div>

            <div class="mt-4 sm:mt-6">
              <div
                class="grid grid-cols-1 w-full gap-y-3 sm:gap-x-6 sm:gap-y-4 sm:grid-cols-12">
                <div v-for="(subService, subIdx) in service.subServices" :key="subService.slug"
                     :class="[
                       'group bg-gray-50 dark:bg-gray-700 p-3 sm:p-4 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer relative overflow-hidden',
                       subIdx === 0 ? 'sm:col-start-3 sm:col-span-4' : '',
                       subIdx === 1 ? 'sm:col-start-7 sm:col-span-4' : ''
                     ]">
                  <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                  <div class="relative flex items-center">
                    <div class="flex-shrink-0">
                      <i :class="service.icon" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600 dark:text-blue-400 group-hover:rotate-6 group-hover:scale-110 transition-all duration-300"></i>
                    </div>
                    <div class="ml-3 sm:ml-4 group-hover:translate-x-2 transition-transform duration-300">
                      <h4 class="text-sm sm:text-base font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                        {{ subService.title }}
                      </h4>
                      <p class="mt-0.5 sm:mt-1 text-xs sm:text-sm text-gray-500 dark:text-gray-300 line-clamp-2">
                        {{ subService.description }}
                      </p>
                    </div>
                  </div>
                  <div class="mt-3 sm:mt-4 text-right">
                    <Link :href="
                        service.slug === 'kamera-sistemleri' ? route('services.camera') :
                        service.slug === 'internet-hizmetleri' ? route('services.internet') :
                        service.slug === 'uydu-sistemleri' ? route('services.satellite') :
                        route('services.show', service.slug) // Fallback for other service types
                      " 
                          class="text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 group-hover:underline transition-all duration-300">
                      Detaylı Bilgi 
                      <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Call to Action Section -->
      <div class="mt-12 sm:mt-16 text-center relative z-10">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">
          Hizmetlerimizden Yararlanmak İster Misiniz?
        </h2>
        <p class="mt-2 sm:mt-4 text-base sm:text-lg text-gray-500 dark:text-gray-300">
          Hemen servis talebi oluşturun, uzman ekibimiz size yardımcı olsun.
        </p>
        <div class="mt-4 sm:mt-8">
          <Link :href="route('service-request')" 
                class="inline-flex items-center px-6 sm:px-8 py-2 sm:py-3 border border-transparent text-sm sm:text-base font-medium rounded-xl shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
            Servis Talebi Oluştur
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';
import TopBar from '@/components/TopBar.vue';

const services = [
    {
        title: 'Kamera Sistemleri',
        description: 'Güvenlik kamera sistemleri kurulumu ve bakım hizmetleri',
        icon: 'camera',
        slug: 'kamera-sistemleri',
        subServices: [
            {
                title: 'Kamera Kurulumu',
                description: 'IP ve analog kamera sistemleri kurulumu',
                slug: 'kamera-kurulumu'
            },
            {
                title: 'Kamera Arıza',
                description: 'Kamera sistemleri arıza tespit ve onarım',
                slug: 'kamera-ariza'
            }
        ]
    },
    {
        title: 'İnternet Hizmetleri',
        description: 'İnternet bağlantısı kurulumu ve sorun giderme hizmetleri',
        icon: 'wifi',
        slug: 'internet-hizmetleri',
        subServices: [
            {
                title: 'DSL Kurulum',
                description: 'İnternet bağlantısı kurulumu ve ayarları',
                slug: 'dsl-kurulum'
            },
            {
                title: 'Ağ Altyapısı',
                description: 'Wi-Fi ve ağ sistemleri kurulumu',
                slug: 'ag-altyapisi'
            }
        ]
    },
    {
        title: 'Uydu Sistemleri',
        description: 'Uydu anten sistemleri kurulum ve bakım hizmetleri',
        icon: 'satellite-dish',
        slug: 'uydu-sistemleri',
        subServices: [
            {
                title: 'Çanak Anten Arıza',
                description: 'Uydu anten sistemleri arıza tespit ve onarım',
                slug: 'canak-anten-ariza'
            },
            {
                title: 'Uydu Ayarlama',
                description: 'Uydu anten kurulumu ve kanal ayarları',
                slug: 'uydu-ayarlama'
            }
        ]
    }
];
</script> 