<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16">
    <TopBar />
    <SEO
      title="Türk Teknik | İzmir'in Güvenilir Teknik Servis Çözümleri"
      description="Türk Teknik, İzmir'de profesyonel teknik servis hizmetleri sunmaktadır. Kamera sistemleri, internet altyapısı, uydu sistemleri ve daha fazlası için güvenilir servis çözümleri."
      keywords="teknik servis, izmir teknik servis, kamera sistemleri, internet servisi, uydu sistemleri"
      url="https://fastteknik.com"
    />

    <!-- Hero Section -->
    <div class="relative overflow-hidden min-h-[500px] sm:min-h-[600px]">
      <!-- Simplified Background - No SVG for better LCP -->
      <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent dark:from-blue-950/20"></div>
      
      <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
          <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
            <div class="sm:text-center lg:text-left">
              <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl" style="content-visibility: auto;">
                <span class="block">Hızlı ve Güvenilir</span>
                <span class="block text-blue-600 dark:text-blue-400">Teknik Servis Hizmeti</span>
              </h1>
              <p class="mt-3 text-base text-gray-500 dark:text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0" style="content-visibility: auto;">
                İzmir'de profesyonel teknik servis hizmetleri. İnternet , Kamera , Uydu ve daha birçok hizmet için güvenilir servis çözümleri.
              </p>
              <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                <div class="rounded-md shadow">
                  <Link :href="route('services.index')" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 md:py-4 md:text-lg md:px-10">
                    Hizmetlerimiz
                  </Link>
                </div>
                <div class="mt-3 sm:mt-0 sm:ml-3">
                  <Link :href="route('service-request')" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 dark:text-blue-100 bg-blue-100 dark:bg-blue-900/30 hover:bg-blue-200 dark:hover:bg-blue-800/40 md:py-4 md:text-lg md:px-10">
                    Servis Talebi Oluştur
                  </Link>
                </div>
              </div>
              <div class="mt-6 sm:mt-8 flex items-center justify-center lg:justify-start">
        <a href="tel:+905469118061" class="flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold text-lg">
          <i class="fas fa-phone text-xl"></i>
          <span>0546 911 80 61</span>
        </a>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>

    <!-- Services Section -->
    <div class="py-12 bg-white dark:bg-gray-800 relative overflow-hidden">
      <!-- SVG Blob Background -->
      <div class="absolute inset-0 opacity-10 dark:opacity-5">
        <svg viewBox="0 0 800 500" preserveAspectRatio="none" class="w-full h-full">
          <path d="M0,100 C150,200 350,0 500,100 C650,200 800,100 800,300 L800,500 L0,500 Z" fill="url(#gradient1)"></path>
          <defs>
            <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
              <stop offset="100%" style="stop-color:#1E40AF;stop-opacity:1" />
            </linearGradient>
          </defs>
        </svg>
      </div>
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
          <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
            Hizmetlerimiz
          </h2>
          <p class="mt-4 text-lg text-gray-500 dark:text-gray-300">
            Tüm teknik servis ihtiyaçlarınız için profesyonel çözümler
          </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
          <Link
            v-for="(service, index) in services"
            :key="service.slug"
            :href="
              service.slug === 'kamera-sistemleri' ? route('services.camera') :
              service.slug === 'internet-hizmetleri' ? route('services.internet') :
              service.slug === 'uydu-sistemleri' ? route('services.satellite') :
              route('services.show', service.slug)
            "
            :data-aos="index === 0 ? 'fade-right' : index === 1 ? 'fade-up' : 'fade-left'"
            :data-aos-delay="index * 200"
            class="
              bg-white dark:bg-gray-700 
              overflow-hidden 
              shadow-md hover:shadow-2xl 
              hover:-translate-y-2
              transition-all duration-500 ease-in-out 
              rounded-lg block 
              focus:outline-none focus:ring-2 focus:ring-blue-500
              group
              dark:hover:bg-gray-600
            "
          >
            <div class="p-6">
              <div class="text-center">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                  {{ service.title }}
                </h3>
                <div class="flex justify-center mb-2">
                  <i :class="service.icon" class="h-12 w-12 text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300"></i>
                </div>
                <p class="text-base text-gray-500 dark:text-gray-300">
                  {{ service.description }}
                </p>
              </div>
            </div>
          </Link>
        </div>
      </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-gray-50 dark:bg-gray-900 relative overflow-hidden">
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="lg:text-center">
          <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
            Neden Bizi Seçmelisiniz?
          </h2>
          <p class="mt-4 text-lg text-gray-500 dark:text-gray-300">
            Profesyonel ve güvenilir hizmet anlayışımızla fark yaratıyoruz
          </p>
        </div>

        <div class="mt-10">
          <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
            <div class="relative group" data-aos="zoom-in" data-aos-delay="100">
              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white group-hover:bg-blue-600 group-hover:scale-110 transition-all duration-300">
                <i class="fas fa-clock text-xl"></i>
              </div>
              <div class="ml-16 group-hover:translate-x-2 transition-transform duration-300">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Hızlı Servis</h3>
                <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                  En kısa sürede servis hizmeti sağlıyoruz. Müşteri memnuniyeti bizim için önceliktir.
                </p>
              </div>
            </div>

            <div class="relative group" data-aos="zoom-in" data-aos-delay="200">
              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white group-hover:bg-blue-600 group-hover:scale-110 transition-all duration-300">
                <i class="fas fa-tools text-xl"></i>
              </div>
              <div class="ml-16 group-hover:translate-x-2 transition-transform duration-300">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Uzman Ekip</h3>
                <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                  Alanında uzman ve deneyimli teknik ekibimizle kaliteli hizmet sunuyoruz.
                </p>
              </div>
            </div>

            <div class="relative group" data-aos="zoom-in" data-aos-delay="300">
              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white group-hover:bg-blue-600 group-hover:scale-110 transition-all duration-300">
                <i class="fas fa-shield-alt text-xl"></i>
              </div>
              <div class="ml-16 group-hover:translate-x-2 transition-transform duration-300">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Garantili Hizmet</h3>
                <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                  Tüm servis hizmetlerimiz garantilidir. Müşterilerimizin güvenini kazanmak için çalışıyoruz.
                </p>
              </div>
            </div>

            <div class="relative group" data-aos="zoom-in" data-aos-delay="400">
              <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white group-hover:bg-blue-600 group-hover:scale-110 transition-all duration-300">
                <i class="fas fa-hand-holding-usd text-xl"></i>
              </div>
              <div class="ml-16 group-hover:translate-x-2 transition-transform duration-300">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">Uygun Fiyat</h3>
                <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                  Rekabetçi fiyatlarımızla kaliteli hizmeti uygun maliyetle sunuyoruz.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-blue-600 relative overflow-hidden">
      <!-- SVG Blob Background for CTA -->
      <div class="absolute inset-0 opacity-20">
        <svg viewBox="0 0 1200 400" preserveAspectRatio="none" class="w-full h-full">
          <path d="M0,100 C200,50 400,150 600,80 C800,10 1000,120 1200,60 L1200,400 L0,400 Z" fill="url(#ctaGradient)" class="animate-pulse"></path>
          <path d="M0,200 C300,150 500,250 700,180 C900,110 1100,220 1200,160 L1200,400 L0,400 Z" fill="url(#ctaGradient2)" class="animate-pulse" style="animation-delay: 0.5s;"></path>
          <defs>
            <linearGradient id="ctaGradient" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:#FFFFFF;stop-opacity:0.1" />
              <stop offset="100%" style="stop-color:#FFFFFF;stop-opacity:0.05" />
            </linearGradient>
            <linearGradient id="ctaGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:#FFFFFF;stop-opacity:0.08" />
              <stop offset="100%" style="stop-color:#FFFFFF;stop-opacity:0.03" />
            </linearGradient>
          </defs>
        </svg>
      </div>
      
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between relative z-10">
        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
          <span class="block">Hemen Servis Talebi Oluşturun</span>
          <span class="block text-blue-200">7/24 Hizmetinizdeyiz</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
          <div class="inline-flex rounded-md shadow">
            <Link :href="route('service-request')" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 transition-all duration-300 hover:scale-105">
              Servis Talebi Oluştur
            </Link>
          </div>
          <div class="ml-3 inline-flex rounded-md shadow">
            <Link :href="route('services.index')" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-700 hover:bg-blue-800 transition-all duration-300 hover:scale-105">
              Hizmetlerimizi İncele
            </Link>
          </div>
          <div class="ml-3 inline-flex rounded-md shadow">
            <Link :href="route('internet-speed-test')" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 transition-all duration-300 hover:scale-105">
              İnternet Hız Testi
            </Link>
          </div>
        </div>
      </div>
    </div>

    <!-- Notification -->
    <NotificationCard />
    

    <!-- Fixed Contact Buttons -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col space-y-3" style="will-change: transform;">
      <!-- WhatsApp Button -->
      <a
        href="https://wa.me/905469118061?text=Merhaba! Türk Teknik hizmetleri hakkında bilgi almak istiyorum."
        target="_blank"
        rel="noopener noreferrer"
        class="
          bg-green-500 hover:bg-green-600 
          text-white 
          w-14 h-14 
          rounded-full 
          flex items-center justify-center 
          shadow-lg hover:shadow-xl 
          transition-all duration-300 
          hover:scale-110 
          group
        "
        style="will-change: transform;"
        title="WhatsApp ile İletişim"
      >
        <i class="fab fa-whatsapp text-2xl group-hover:scale-110 transition-transform duration-300"></i>
      </a>

      <!-- Phone Button -->
      <a
        href="tel:+905469118061"
        class="
          bg-blue-600 hover:bg-blue-700 
          text-white 
          w-14 h-14 
          rounded-full 
          flex items-center justify-center 
          shadow-lg hover:shadow-xl 
          transition-all duration-300 
          hover:scale-110 
          group
        "
        style="will-change: transform;"
        title="Telefon ile Ara"
      >
        <i class="fas fa-phone text-xl group-hover:scale-110 transition-transform duration-300"></i>
      </a>
    </div>
    <!-- Footer -->
    <Footer />
  </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';
import Footer from '@/components/Footer.vue';
import SpeedTest from './SpeedTest.vue';
import { ref, watch } from 'vue';
import TopBar from '@/components/TopBar.vue';
import NotificationCard from '@/components/NotificationCard.vue';

const services = [
    {
        title: 'Kamera Sistemleri',
        description: 'Güvenlik kamera sistemleri kurulumu ve bakım hizmetleri',
        icon: 'camera',
        slug: 'kamera-sistemleri'
    },
    {
        title: 'İnternet Hizmetleri',
        description: 'İnternet bağlantısı kurulumu ve sorun giderme hizmetleri',
        icon: 'wifi',
        slug: 'internet-hizmetleri'
    },
    {
        title: 'Uydu Sistemleri',
        description: 'Uydu anten sistemleri kurulum ve bakım hizmetleri',
        icon: 'satellite-dish',
        slug: 'uydu-sistemleri'
    }
];

const speedTest = ref({
  loading: false,
  done: false,
  ping: null,
  download: null,
  upload: null,
});

function startSpeedTest() {
  speedTest.value.loading = true;
  speedTest.value.done = false;
  // Simüle edilen hız testi
  setTimeout(() => {
    speedTest.value.ping = Math.floor(Math.random() * 20) + 5;
    speedTest.value.download = (Math.random() * 80 + 20).toFixed(2);
    speedTest.value.upload = (Math.random() * 20 + 5).toFixed(2);
    speedTest.value.loading = false;
    speedTest.value.done = true;
  }, 1800);
}

const page = usePage();

const successMessage = ref(null);

watch(() => page.props.flash?.success, (newVal) => {
  if (newVal) {
    successMessage.value = newVal;
    // Mesajı belirli bir süre sonra gizle
    setTimeout(() => {
      successMessage.value = null;
    }, 5000);
  }
}, { immediate: true });

</script>

<style scoped>
/* Mevcut stiller */

/* Bildirim stilleri */
.notification {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 1000;
  max-width: 350px;
}

/* SVG Blob Animation */
@keyframes blob {
  0% {
    transform: translate(0px, 0px) scale(1);
  }
  33% {
    transform: translate(30px, -50px) scale(1.1);
  }
  66% {
    transform: translate(-20px, 20px) scale(0.9);
  }
  100% {
    transform: translate(0px, 0px) scale(1);
  }
}

.flip-card-container:hover svg {
  animation: blob 7s infinite;
}
</style> 