<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16">
    <SEO
      title="Blog | Türk Teknik İzmir"
      description="Türk Teknik blog sayfası. Teknik servis, kamera sistemleri, internet altyapısı ve uydu sistemleri hakkında güncel bilgiler."
      keywords="blog, teknik servis, kamera sistemleri, internet altyapısı, uydu sistemleri, teknoloji"
      url="http://fast-teknik.test/hakkimizda/blog"
    />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="max-w-6xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-12">
          <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
            Blog
          </h1>
          <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
            Teknik servis dünyasından güncel haberler, ipuçları ve uzman görüşleri
          </p>
        </div>

        <!-- Featured Article -->
        <div class="mb-12">
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="md:flex">
              <div class="md:w-1/2">
                <div class="w-full h-64 md:h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                  <div class="text-center text-white">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <h3 class="text-xl font-bold">Teknik Servis Blog</h3>
                  </div>
                </div>
              </div>
              <div class="md:w-1/2 p-8">
                <div class="flex items-center mb-4">
                  <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm font-semibold px-3 py-1 rounded-full">
                    Öne Çıkan
                  </span>
                  <span class="ml-4 text-gray-500 dark:text-gray-400 text-sm">15 Aralık 2024</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                  2024'te Kamera Güvenlik Sistemlerinde Yeni Trendler
                </h2>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                  Yapay zeka destekli kamera sistemleri, 4K çözünürlük ve bulut tabanlı izleme çözümleri 
                  güvenlik sektöründe devrim yaratıyor. Bu yazımızda en son teknolojileri inceliyoruz.
                </p>
                <Link 
                  href="#"
                  class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold"
                >
                  Devamını Oku
                  <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                  </svg>
                </Link>
              </div>
            </div>
          </div>
        </div>

        <!-- Blog Categories -->
        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Kategoriler</h2>
          <div class="flex flex-wrap gap-3">
            <button 
              v-for="category in categories" 
              :key="category.id"
              @click="selectedCategory = category.id"
              :class="[
                'px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200',
                selectedCategory === category.id 
                  ? 'bg-blue-600 text-white' 
                  : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'
              ]"
            >
              {{ category.name }}
            </button>
          </div>
        </div>

        <!-- Blog Posts Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <article 
            v-for="post in filteredPosts" 
            :key="post.id"
            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
          >
            <div class="w-full h-48 bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center">
              <div class="text-center text-white">
                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <p class="text-sm font-medium">Blog Görseli</p>
              </div>
            </div>
            <div class="p-6">
              <div class="flex items-center mb-3">
                <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs font-semibold px-2 py-1 rounded">
                  {{ post.category }}
                </span>
                <span class="ml-3 text-gray-500 dark:text-gray-400 text-sm">{{ post.date }}</span>
              </div>
              <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 line-clamp-2">
                {{ post.title }}
              </h3>
              <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                {{ post.excerpt }}
              </p>
              <Link 
                href="#"
                class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-semibold"
              >
                Devamını Oku
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </Link>
            </div>
          </article>
        </div>

        <!-- Newsletter Subscription -->
        <div class="mt-16 bg-blue-600 dark:bg-blue-700 rounded-xl p-8 text-center">
          <h2 class="text-2xl font-bold text-white mb-4">Blog Güncellemelerini Kaçırmayın</h2>
          <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
            En son teknik servis haberleri, ipuçları ve uzman görüşlerini e-posta ile alın.
          </p>
          <div class="max-w-md mx-auto flex gap-3">
            <input 
              type="email" 
              v-model="newsletterEmail"
              placeholder="E-posta adresiniz"
              class="flex-1 px-4 py-3 rounded-lg border-0 focus:ring-2 focus:ring-blue-300"
            >
            <button 
              @click="subscribeNewsletter"
              class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200"
            >
              Abone Ol
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';

const selectedCategory = ref('all');
const newsletterEmail = ref('');

const categories = [
  { id: 'all', name: 'Tümü' },
  { id: 'camera', name: 'Kamera Sistemleri' },
  { id: 'internet', name: 'İnternet & Ağ' },
  { id: 'satellite', name: 'Uydu Sistemleri' },
  { id: 'tips', name: 'İpuçları' },
  { id: 'news', name: 'Haberler' }
];

const blogPosts = [
  {
    id: 1,
    title: 'Kamera Sistemlerinde Gece Görüş Teknolojileri',
    excerpt: 'Gece görüş kameralarının çalışma prensipleri ve en iyi uygulama örnekleri.',
    category: 'Kamera Sistemleri',
    date: '10 Aralık 2024'
  },
  {
    id: 2,
    title: 'WiFi 6 Teknolojisi ve Ev Ağları',
    excerpt: 'Yeni nesil WiFi 6 standardının ev ağlarında sağladığı avantajlar.',
    category: 'İnternet & Ağ',
    date: '8 Aralık 2024'
  },
  {
    id: 3,
    title: 'Uydu Anteni Kurulumunda Dikkat Edilecekler',
    excerpt: 'Profesyonel uydu anteni kurulumu için önemli noktalar ve ipuçları.',
    category: 'Uydu Sistemleri',
    date: '5 Aralık 2024'
  },
  {
    id: 4,
    title: 'Ağ Güvenliği İçin Temel Önlemler',
    excerpt: 'Ev ve işyeri ağlarınızı korumak için alabileceğiniz temel güvenlik önlemleri.',
    category: 'İpuçları',
    date: '3 Aralık 2024'
  },
  {
    id: 5,
    title: '5G Teknolojisi ve Gelecekteki Etkileri',
    excerpt: '5G teknolojisinin teknik servis sektörüne getireceği değişiklikler.',
    category: 'Haberler',
    date: '1 Aralık 2024'
  },
  {
    id: 6,
    title: 'Kamera Kayıt Cihazı Seçimi Rehberi',
    excerpt: 'İhtiyacınıza uygun kamera kayıt cihazı seçimi için detaylı rehber.',
    category: 'Kamera Sistemleri',
    date: '28 Kasım 2024'
  }
];

const filteredPosts = computed(() => {
  if (selectedCategory.value === 'all') {
    return blogPosts;
  }
  return blogPosts.filter(post => 
    post.category.toLowerCase().includes(selectedCategory.value.toLowerCase())
  );
});

const subscribeNewsletter = () => {
  if (newsletterEmail.value) {
    alert('Newsletter aboneliği başarıyla tamamlandı!');
    newsletterEmail.value = '';
  }
};
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
