<template>
  <div class="min-h-screen bg-[#F3F6FC] dark:bg-gray-900 pt-16 pb-24 relative">
    <!-- Radial Gradient Background -->
    <div class="absolute inset-0 bg-[radial-gradient(1200px_600px_at_50%_-100px,rgba(59,130,246,.05),transparent)] dark:bg-[radial-gradient(1200px_600px_at_50%_-100px,rgba(56,189,248,.15),transparent)] pointer-events-none"></div>
    
    <TopBar />
    <SEO
      title="Fast Teknik | Hizmetlerimiz"
      description="Fast Teknik'in sunduğu tüm teknik servis hizmetleri. Kamera sistemleri, internet hizmetleri ve uydu sistemleri için profesyonel çözümler."
      keywords="teknik servis, kamera kurulumu, internet hizmetleri, uydu sistemleri, çanak anten"
      url="https://fastteknik.com/services"
    />

    <div class="max-w-7xl mx-auto py-6 sm:py-12 px-4 sm:px-6 lg:px-8 relative">
      <!-- SVG Blob Background -->
      <div class="absolute inset-0 opacity-5 dark:opacity-10 pointer-events-none">
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
        <ol class="flex items-center space-x-2 text-xs sm:text-sm">
          <li>
            <Link :href="route('home')" class="text-[#1F2937]/60 hover:text-[#2563EB] dark:text-gray-400 dark:hover:text-gray-300 transition-colors duration-300">
              Anasayfa
            </Link>
          </li>
          <li>
            <span class="text-[#1F2937]/40 dark:text-gray-400 mx-2">/</span>
          </li>
          <li>
            <span class="text-[#1F2937] dark:text-gray-300 font-medium" aria-current="page">Hizmetlerimiz</span>
          </li>
        </ol>
      </nav>

      <!-- Page Header -->
      <div class="text-center relative z-10 mb-10 md:mb-14">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#1E3A8A] dark:text-white">
          Hizmetlerimiz
        </h1>
        <p class="mt-3 sm:mt-4 text-base sm:text-lg md:text-xl text-[#1F2937]/80 dark:text-slate-300 max-w-3xl mx-auto">
          Tüm teknik servis ihtiyaçlarınız için profesyonel çözümler
        </p>
      </div>

      <!-- Services Grid -->
      <div class="space-y-10 md:space-y-14 relative z-10">
        <div v-for="(service, index) in services" :key="service.slug" 
             class="bg-[#F9FAFB] dark:bg-white/9 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl ring-1 ring-[#E5E7EB] dark:ring-white/10 hover:ring-[#3B82F6]/30 dark:hover:ring-white/20 hover:shadow-2xl transition-all duration-500 ease-in-out w-[90%] mx-auto">
          <div class="p-6 md:p-7">
            <!-- Category Header with Icon -->
            <div class="flex flex-col items-center text-center gap-4 mb-6">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-500 dark:to-blue-700 flex items-center justify-center shadow-lg">
                  <component :is="service.iconComponent" class="w-6 h-6 md:w-7 md:h-7 text-white" />
                </div>
              </div>
              <div class="flex-1">
                <h2 class="text-4xl md:text-5xl font-bold text-[#1E3A8A] dark:text-slate-50 mb-3 tracking-tight">
                  {{ service.title }}
                </h2>
                <p class="text-sm sm:text-base text-[#1F2937]/90 dark:text-slate-300/90 mb-4 font-medium">
                  {{ service.description }}
                </p>
                
                <!-- Badges -->
                <div class="flex flex-wrap items-center justify-center gap-2">
                  <span v-for="badge in service.badges" :key="badge" 
                        class="rounded-full text-xs px-2.5 py-1 font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/50 dark:bg-emerald-400/10 dark:text-emerald-300 dark:ring-emerald-300/20">
                    {{ badge }}
                  </span>
                </div>
              </div>
            </div>

            <!-- Sub-Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8">
              <Link v-for="(subService, subIdx) in service.subServices" :key="subService.slug"
                   :href="
                      service.slug === 'kamera-sistemleri' ? route('services.camera') :
                      service.slug === 'internet-hizmetleri' ? route('services.internet') :
                      service.slug === 'uydu-sistemleri' ? route('services.satellite') :
                      route('services.show', service.slug)
                    "
                   :class="[
                     'group relative bg-white dark:bg-white/5 hover:bg-[#F9FAFB] dark:hover:bg-white/7 p-6 rounded-xl ring-1 ring-[#E5E7EB] dark:ring-white/10 hover:ring-[#3B82F6]/50 dark:hover:ring-blue-400/30 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer overflow-hidden',
                     subIdx === 0 ? 'md:col-start-2 md:col-span-5' : '',
                     subIdx === 1 ? 'md:col-start-7 md:col-span-5' : ''
                   ]">
                <!-- Gradient Overlay on Hover -->
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <!-- Content -->
                <div class="relative text-center">
                  <div class="flex flex-col items-center gap-3 mb-3">
                    <div class="flex-shrink-0">
                      <component :is="service.iconComponent" class="w-5 h-5 text-blue-600 dark:text-blue-400 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300" />
                    </div>
                    <div class="flex-1">
                      <h3 class="text-lg font-semibold text-[#1E3A8A] dark:text-slate-50 group-hover:text-[#3B82F6] dark:group-hover:text-blue-400 transition-colors duration-300 mb-2">
                        {{ subService.title }}
                      </h3>
                      <p class="text-sm/6 text-[#1F2937] dark:text-slate-300/90 font-medium">
                        {{ subService.description }}
                      </p>
                      
                      <!-- Feature List -->
                      <ul v-if="subService.features" class="mt-3 space-y-1 text-sm/6 text-center">
                        <li v-for="(feature, idx) in subService.features" :key="idx" class="text-gray-700 dark:text-slate-300 font-medium">
                          {{ feature }}
                        </li>
                      </ul>
                    </div>
                  </div>
                  
                  <!-- CTA Buttons -->
                  <div class="mt-5 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <!-- Primary CTA -->
                    <button 
                      @click.prevent="$inertia.visit(route('service-request'))"
                      class="text-sm/6 font-semibold text-[#2563EB] dark:text-[#3B82F6] hover:text-[#1E40AF] dark:hover:text-[#60A5FA] hover:underline transition-all duration-300 cursor-pointer">
                      Teklif Al
                      <span class="inline-block transition-transform duration-300 hover:translate-x-1 ml-1">&rarr;</span>
                    </button>
                    
                    <!-- Secondary CTA -->
                    <span class="text-sm/6 font-semibold text-[#2563EB] dark:text-[#3B82F6] group-hover:text-[#1E40AF] dark:group-hover:text-[#60A5FA] group-hover:underline transition-all duration-300 cursor-pointer">
                      Detayları Gör
                    </span>
                  </div>
                </div>
              </Link>
            </div>

            <!-- Category CTA Button -->
            <div class="mt-6 md:mt-8 pt-6 border-t border-[#E5E7EB] dark:border-white/10 text-center">
              <Link :href="route('service-request')"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-[#3B82F6] hover:bg-[#2563EB] rounded-xl transition-all duration-300 hover:scale-105 shadow-md hover:shadow-lg">
                {{ service.title }} için Servis Talebi
              </Link>
            </div>
          </div>
        </div>
      </div>

      <!-- Main CTA Section (Non-sticky for larger screens) -->
      <div class="mt-12 sm:mt-16 text-center relative z-10 hidden sm:block">
        <h2 class="text-2xl sm:text-3xl font-bold text-[#1E3A8A] dark:text-white mb-3">
          Hizmetlerimizden Yararlanmak İster Misiniz?
        </h2>
        <p class="text-base sm:text-lg text-[#1F2937]/80 dark:text-slate-300 mb-6">
          Hemen servis talebi oluşturun, uzman ekibimiz size yardımcı olsun.
        </p>
        <Link :href="route('service-request')" 
              class="inline-flex items-center justify-center gap-3 px-8 py-4 text-base sm:text-lg font-semibold rounded-xl shadow-lg text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3B82F6] transition-all duration-300 hover:scale-105 hover:shadow-xl">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
          </svg>
          Servis Talebi Oluştur
        </Link>
      </div>
    </div>

    <!-- Sticky CTA Button (Mobile only) -->
    <div class="sm:hidden fixed bottom-4 left-4 right-4 z-50">
      <Link :href="route('service-request')" 
            class="flex items-center justify-center gap-3 w-full px-6 py-4 text-base font-bold rounded-xl shadow-2xl text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3B82F6] transition-all duration-300 hover:scale-105 active:scale-95">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
          <line x1="16" y1="13" x2="8" y2="13"></line>
          <line x1="16" y1="17" x2="8" y2="17"></line>
          <polyline points="10 9 9 9 8 9"></polyline>
        </svg>
        Servis Talebi Oluştur
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';
import TopBar from '@/components/TopBar.vue';
import { Camera, Wifi, Satellite } from 'lucide-vue-next';

const services = [
    {
        title: 'Kamera Sistemleri',
        description: 'Güvenlik kamera sistemleri kurulumu ve bakım hizmetleri',
        icon: 'camera',
        iconComponent: Camera,
        slug: 'kamera-sistemleri',
        badges: ['Aynı Gün Keşif', '2 Yıl İşçilik Garantisi', 'Uzman Ekip'],
        subServices: [
            {
                title: 'Kamera Kurulumu',
                description: 'IP ve analog kamera sistemleri kurulumu',
                slug: 'kamera-kurulumu',
                features: ['DVR kurulum• NVR konfigürasyon • Mobil erişim']
            },
            {
                title: 'Kamera Arıza',
                description: 'Kamera sistemleri arıza tespit ve onarım',
                slug: 'kamera-ariza',
                features: ['Hızlı arıza tespit • Hard disk kontrolü • Sistem bakımı']
            }
        ]
    },
    {
        title: 'İnternet Hizmetleri',
        description: 'İnternet bağlantısı kurulumu ve sorun giderme hizmetleri',
        icon: 'wifi',
        iconComponent: Wifi,
        slug: 'internet-hizmetleri',
        badges: ['7/24 Destek', 'Hızlı Çözüm', 'Ücretsiz Keşif'],
        subServices: [
            {
                title: 'DSL Kurulum',
                description: 'İnternet bağlantısı kurulumu ve ayarları',
                slug: 'dsl-kurulum',
                features: ['Modem kurulum (adsl, dsl, fiber) • PPP ayarları • Hız optimizasyonu']
            },
            {
                title: 'Ağ Altyapısı',
                description: 'Wi-Fi ve ağ sistemleri kurulumu',
                slug: 'ag-altyapisi',
                features: ['Access Point • Mesh sistem • Kablo çekimi']
            }
        ]
    },
    {
        title: 'Uydu Sistemleri',
        description: 'Uydu anten sistemleri kurulum ve bakım hizmetleri',
        icon: 'satellite-dish',
        iconComponent: Satellite,
        slug: 'uydu-sistemleri',
        badges: ['Profesyonel Montaj', '2 Yıl Garanti', 'Kaliteli Malzeme'],
        subServices: [
            {
                title: 'Çanak Anten Arıza ve Kurulum',
                description: 'Uydu anten sistemleri arıza tespit ve onarım',
                slug: 'canak-anten-ariza',
                features: ['Sinyal kontrolü • LNB değişimi • Çanak montaj']
            },
            {
                title: 'Merkezi sistem arıza ve kurulum',
                description: 'Uydu anten kurulumu ve kanal ayarları',
                slug: 'uydu-ayarlama',
                features: ['Merkezi sistem arıza • Merkezi sistem kurulumu • Santral bakım onarım']
            }
        ]
    }
];
</script> 