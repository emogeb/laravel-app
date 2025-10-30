<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16">
    <SEO
      title="Fast Teknik Deneyimi | Türk Teknik İzmir"
      description="Fast Teknik deneyimi hakkında bilgi. Müşteri deneyimlerimiz, başarı hikayeleri ve referanslarımız."
      keywords="fast teknik deneyimi, müşteri deneyimleri, başarı hikayeleri, referanslar, türk teknik"
      url="http://fast-teknik.test/hakkimizda/fast-teknik-deneyimi"
    />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="max-w-6xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-12">
          <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
            Fast Teknik Deneyimi
          </h1>
          <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
            Müşterilerimizin deneyimleri, başarı hikayeleri ve bizimle çalışmanın avantajları
          </p>
        </div>

        <!-- Experience Stats -->
        <div class="grid md:grid-cols-4 gap-6 mb-16">
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center">
            <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">500+</div>
            <div class="text-gray-600 dark:text-gray-300">Mutlu Müşteri</div>
          </div>
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center">
            <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-2">98%</div>
            <div class="text-gray-600 dark:text-gray-300">Memnuniyet Oranı</div>
          </div>
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center">
            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-2">5+</div>
            <div class="text-gray-600 dark:text-gray-300">Yıllık Deneyim</div>
          </div>
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center">
            <div class="text-3xl font-bold text-orange-600 dark:text-orange-400 mb-2">24/7</div>
            <div class="text-gray-600 dark:text-gray-300">Destek Hizmeti</div>
          </div>
        </div>

        <!-- Customer Testimonials -->
        <section class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Müşteri Deneyimleri</h2>
          <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div 
              v-for="testimonial in testimonials" 
              :key="testimonial.id"
              class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6"
            >
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                  <span class="text-blue-600 dark:text-blue-400 font-semibold text-lg">
                    {{ testimonial.name.charAt(0) }}
                  </span>
                </div>
                <div class="ml-4">
                  <h3 class="font-semibold text-gray-900 dark:text-white">{{ testimonial.name }}</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400">{{ testimonial.location }}</p>
                </div>
              </div>
              <div class="flex mb-3">
                <svg 
                  v-for="i in 5" 
                  :key="i"
                  class="w-5 h-5 text-yellow-400"
                  :class="{ 'text-gray-300 dark:text-gray-600': i > testimonial.rating }"
                  fill="currentColor" 
                  viewBox="0 0 20 20"
                >
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
              </div>
              <p class="text-gray-600 dark:text-gray-300 italic">"{{ testimonial.comment }}"</p>
            </div>
          </div>
        </section>

        <!-- Success Stories -->
        <section class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Başarı Hikayeleri</h2>
          <div class="space-y-8">
            <div 
              v-for="story in successStories" 
              :key="story.id"
              class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden"
            >
              <div class="md:flex">
                <div class="md:w-1/3">
                  <div class="w-full h-48 md:h-full bg-gradient-to-br from-green-500 to-blue-600 flex items-center justify-center">
                    <div class="text-center text-white">
                      <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                      </svg>
                      <p class="text-sm font-medium">Başarı Hikayesi</p>
                    </div>
                  </div>
                </div>
                <div class="md:w-2/3 p-8">
                  <div class="flex items-center mb-4">
                    <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-sm font-semibold px-3 py-1 rounded-full">
                      {{ story.category }}
                    </span>
                    <span class="ml-4 text-gray-500 dark:text-gray-400 text-sm">{{ story.date }}</span>
                  </div>
                  <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ story.title }}</h3>
                  <p class="text-gray-600 dark:text-gray-300 mb-4">{{ story.description }}</p>
                  <div class="grid md:grid-cols-2 gap-4 text-sm">
                    <div>
                      <span class="font-semibold text-gray-900 dark:text-white">Proje Süresi:</span>
                      <span class="text-gray-600 dark:text-gray-300 ml-2">{{ story.duration }}</span>
                    </div>
                    <div>
                      <span class="font-semibold text-gray-900 dark:text-white">Müşteri Memnuniyeti:</span>
                      <span class="text-gray-600 dark:text-gray-300 ml-2">{{ story.satisfaction }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Why Choose Us -->
        <section class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Neden Fast Teknik?</h2>
          <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div 
              v-for="advantage in advantages" 
              :key="advantage.id"
              class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center"
            >
              <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <component :is="advantage.icon" class="w-8 h-8 text-blue-600 dark:text-blue-400" />
              </div>
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ advantage.title }}</h3>
              <p class="text-gray-600 dark:text-gray-300">{{ advantage.description }}</p>
            </div>
          </div>
        </section>

        <!-- Process Steps -->
        <section class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Çalışma Sürecimiz</h2>
          <div class="grid md:grid-cols-4 gap-6">
            <div 
              v-for="(step, index) in processSteps" 
              :key="step.id"
              class="text-center"
            >
              <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">
                {{ index + 1 }}
              </div>
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ step.title }}</h3>
              <p class="text-gray-600 dark:text-gray-300 text-sm">{{ step.description }}</p>
            </div>
          </div>
        </section>

        <!-- CTA Section -->
        <div class="text-center bg-blue-600 dark:bg-blue-700 rounded-xl p-8">
          <h2 class="text-2xl font-bold text-white mb-4">Siz de Fast Teknik Deneyimini Yaşayın</h2>
          <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
            Profesyonel teknik servis hizmetlerimizden yararlanın ve farkı hissedin.
          </p>
          <Link 
            :href="route('contact')"
            class="inline-flex items-center px-8 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-lg font-semibold"
          >
            Hemen İletişime Geçin
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';
import { 
  Clock, 
  Shield, 
  Users, 
  Wrench, 
  CheckCircle, 
  Star 
} from 'lucide-vue-next';

const testimonials = [
  {
    id: 1,
    name: 'Ahmet Yılmaz',
    location: 'Konak, İzmir',
    rating: 5,
    comment: 'Kamera sistemimizi mükemmel şekilde kurdular. 2 yıldır hiç sorun yaşamadık. Çok profesyonel bir ekip.'
  },
  {
    id: 2,
    name: 'Fatma Demir',
    location: 'Karşıyaka, İzmir',
    rating: 5,
    comment: 'İnternet hızımız çok düşüktü. Fast Teknik ekibi gelip sorunu çözdü. Şimdi çok hızlı internet kullanıyoruz.'
  },
  {
    id: 3,
    name: 'Mehmet Kaya',
    location: 'Bornova, İzmir',
    rating: 5,
    comment: 'Uydu antenimiz çekmiyordu. Teknisyenleri gelip ayar yaptı, şimdi tüm kanallar net geliyor. Teşekkürler!'
  },
  {
    id: 4,
    name: 'Ayşe Özkan',
    location: 'Çiğli, İzmir',
    rating: 5,
    comment: 'Mesh sistem kurulumu yaptırdık. Evin her yerinde mükemmel WiFi var. Çok memnunuz.'
  },
  {
    id: 5,
    name: 'Ali Çelik',
    location: 'Bayraklı, İzmir',
    rating: 5,
    comment: '7/24 destek hizmeti gerçekten çok iyi. Gece yarısı arıza oldu, hemen geldiler ve çözdüler.'
  },
  {
    id: 6,
    name: 'Zeynep Arslan',
    location: 'Menemen, İzmir',
    rating: 5,
    comment: 'Kurulum sonrası takip hizmetleri de çok iyi. Her şeyi açıkladılar, hiç sorun yaşamadık.'
  }
];

const successStories = [
  {
    id: 1,
    title: 'Büyük İş Merkezi Kamera Sistemi',
    category: 'Kamera Sistemleri',
    date: 'Kasım 2024',
    duration: '3 gün',
    satisfaction: '100%',
    description: '5 katlı iş merkezine 64 kameralı güvenlik sistemi kurulumu. Merkezi izleme odası ve mobil erişim dahil.'
  },
  {
    id: 2,
    title: 'Fabrika Ağ Altyapısı Yenileme',
    category: 'İnternet & Ağ',
    date: 'Ekim 2024',
    duration: '1 hafta',
    satisfaction: '98%',
    description: 'Eski ağ altyapısını tamamen yeniledik. WiFi 6 teknolojisi ile tüm fabrika alanında kesintisiz internet.'
  },
  {
    id: 3,
    title: 'Site Uydu Sistemi Kurulumu',
    category: 'Uydu Sistemleri',
    date: 'Eylül 2024',
    duration: '2 gün',
    satisfaction: '100%',
    description: '200 dairelik sitede merkezi uydu sistemi kurulumu. Tüm dairelerde mükemmel sinyal kalitesi.'
  }
];

const advantages = [
  {
    id: 1,
    title: 'Hızlı Müdahale',
    description: 'Acil durumlarda 2 saat içinde müdahale garantisi',
    icon: Clock
  },
  {
    id: 2,
    title: 'Güvenilir Hizmet',
    description: '5+ yıllık deneyim ve %98 müşteri memnuniyeti',
    icon: Shield
  },
  {
    id: 3,
    title: 'Uzman Ekip',
    description: 'Sertifikalı ve deneyimli teknisyen kadromuz',
    icon: Users
  },
  {
    id: 4,
    title: 'Kaliteli Malzeme',
    description: 'Sadece kaliteli ve garantili ürünler kullanıyoruz',
    icon: Wrench
  },
  {
    id: 5,
    title: '7/24 Destek',
    description: 'Kurulum sonrası sürekli teknik destek hizmeti',
    icon: CheckCircle
  },
  {
    id: 6,
    title: 'Müşteri Memnuniyeti',
    description: 'Müşteri odaklı hizmet anlayışımız',
    icon: Star
  }
];

const processSteps = [
  {
    id: 1,
    title: 'İletişim',
    description: 'İhtiyaçlarınızı dinliyor ve analiz ediyoruz'
  },
  {
    id: 2,
    title: 'Planlama',
    description: 'En uygun çözümü planlıyor ve teklif hazırlıyoruz'
  },
  {
    id: 3,
    title: 'Uygulama',
    description: 'Profesyonel ekip ile kurulumu gerçekleştiriyoruz'
  },
  {
    id: 4,
    title: 'Takip',
    description: 'Kurulum sonrası destek ve takip hizmeti sunuyoruz'
  }
];
</script>
