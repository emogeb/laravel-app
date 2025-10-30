<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16">
    <SEO
      title="Sıfırdan Kamera Kurulumu | Türk Teknik İzmir"
      description="Profesyonel kamera kurulum hizmeti. IP kameralar, analog kameralar, DVR/NVR sistemleri ve uzaktan izleme çözümleri."
      keywords="kamera kurulumu, güvenlik kamerası, IP kamera, DVR, NVR, uzaktan izleme, İzmir"
      url="http://fast-teknik.test/hizmetler/sifirdan-kamera-kurulumu"
    />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="max-w-6xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-12">
          <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
            Sıfırdan Kamera Kurulumu
          </h1>
          <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
            Profesyonel kamera sistemleri kurulumu ile güvenliğinizi artırın. IP kameralar, analog sistemler ve uzaktan izleme çözümleri.
          </p>
        </div>

        <!-- Service Overview -->
        <div class="grid lg:grid-cols-2 gap-12 mb-16">
          <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Hizmet Kapsamımız</h2>
            <div class="space-y-4">
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white">IP Kamera Sistemleri</h3>
                  <p class="text-gray-600 dark:text-gray-300">4K çözünürlükte yüksek kaliteli IP kameralar</p>
                </div>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white">Analog Kamera Sistemleri</h3>
                  <p class="text-gray-600 dark:text-gray-300">Geleneksel analog kameralar ve DVR sistemleri</p>
                </div>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white">Uzaktan İzleme</h3>
                  <p class="text-gray-600 dark:text-gray-300">Mobil uygulama ile 7/24 uzaktan izleme</p>
                </div>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white">Gece Görüş</h3>
                  <p class="text-gray-600 dark:text-gray-300">IR LED teknolojisi ile gece görüş özelliği</p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Hızlı Teklif Alın</h3>
            <form @submit.prevent="submitQuote" class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kamera Sayısı</label>
                <select v-model="quoteForm.cameraCount" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                  <option value="">Seçiniz</option>
                  <option value="1-4">1-4 Kamera</option>
                  <option value="5-8">5-8 Kamera</option>
                  <option value="9-16">9-16 Kamera</option>
                  <option value="16+">16+ Kamera</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kamera Türü</label>
                <select v-model="quoteForm.cameraType" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                  <option value="">Seçiniz</option>
                  <option value="ip">IP Kamera</option>
                  <option value="analog">Analog Kamera</option>
                  <option value="wireless">Kablosuz Kamera</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kurulum Alanı</label>
                <select v-model="quoteForm.area" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                  <option value="">Seçiniz</option>
                  <option value="ev">Ev</option>
                  <option value="ofis">Ofis</option>
                  <option value="fabrika">Fabrika</option>
                  <option value="site">Site</option>
                </select>
              </div>
              <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold">
                Ücretsiz Teklif Al
              </button>
            </form>
          </div>
        </div>

        <!-- Camera Types -->
        <section class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Kamera Türleri</h2>
          <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center">
              <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">IP Kameralar</h3>
              <ul class="text-gray-600 dark:text-gray-300 space-y-2 text-sm">
                <li>• 4K çözünürlük</li>
                <li>• Uzaktan erişim</li>
                <li>• Gece görüş</li>
                <li>• Hareket algılama</li>
              </ul>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center">
              <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Analog Kameralar</h3>
              <ul class="text-gray-600 dark:text-gray-300 space-y-2 text-sm">
                <li>• Ekonomik çözüm</li>
                <li>• Kolay kurulum</li>
                <li>• Güvenilir sistem</li>
                <li>• DVR kayıt</li>
              </ul>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center">
              <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Kablosuz Kameralar</h3>
              <ul class="text-gray-600 dark:text-gray-300 space-y-2 text-sm">
                <li>• Kolay kurulum</li>
                <li>• WiFi bağlantı</li>
                <li>• Batarya güç</li>
                <li>• Mobil erişim</li>
              </ul>
            </div>
          </div>
        </section>

        <!-- Installation Process -->
        <section class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Kurulum Süreci</h2>
          <div class="grid md:grid-cols-4 gap-6">
            <div class="text-center">
              <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Keşif</h3>
              <p class="text-gray-600 dark:text-gray-300 text-sm">Alanı inceler ve en uygun kamera yerlerini belirleriz</p>
            </div>
            <div class="text-center">
              <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Planlama</h3>
              <p class="text-gray-600 dark:text-gray-300 text-sm">Kamera türleri ve kablolama planını hazırlarız</p>
            </div>
            <div class="text-center">
              <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Kurulum</h3>
              <p class="text-gray-600 dark:text-gray-300 text-sm">Profesyonel ekip ile kurulumu gerçekleştiririz</p>
            </div>
            <div class="text-center">
              <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Test</h3>
              <p class="text-gray-600 dark:text-gray-300 text-sm">Sistemi test eder ve kullanım eğitimi veririz</p>
            </div>
          </div>
        </section>

        <!-- Pricing -->
        <section class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Fiyatlandırma</h2>
          <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 text-center">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Temel Paket</h3>
              <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-6">₺2.500</div>
              <ul class="space-y-3 text-gray-600 dark:text-gray-300 mb-8">
                <li>• 4 IP Kamera</li>
                <li>• 1TB DVR</li>
                <li>• Mobil Uygulama</li>
                <li>• 1 Yıl Garanti</li>
              </ul>
              <Link href="#" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold block">
                Teklif Al
              </Link>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 text-center border-2 border-blue-500 relative">
              <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                Popüler
              </div>
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Profesyonel Paket</h3>
              <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-6">₺4.500</div>
              <ul class="space-y-3 text-gray-600 dark:text-gray-300 mb-8">
                <li>• 8 IP Kamera</li>
                <li>• 2TB NVR</li>
                <li>• Gece Görüş</li>
                <li>• Hareket Algılama</li>
                <li>• 2 Yıl Garanti</li>
              </ul>
              <Link href="#" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold block">
                Teklif Al
              </Link>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 text-center">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Kurumsal Paket</h3>
              <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-6">₺8.500</div>
              <ul class="space-y-3 text-gray-600 dark:text-gray-300 mb-8">
                <li>• 16 IP Kamera</li>
                <li>• 4TB NVR</li>
                <li>• Merkezi İzleme</li>
                <li>• Alarm Entegrasyonu</li>
                <li>• 3 Yıl Garanti</li>
              </ul>
              <Link href="#" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold block">
                Teklif Al
              </Link>
            </div>
          </div>
        </section>

        <!-- CTA Section -->
        <div class="text-center bg-blue-600 dark:bg-blue-700 rounded-xl p-8">
          <h2 class="text-2xl font-bold text-white mb-4">Kamera Kurulum Hizmeti İçin İletişime Geçin</h2>
          <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
            Ücretsiz keşif ve teklif için hemen arayın. Profesyonel ekibimiz size en uygun çözümü sunacak.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a 
              href="tel:+905469118061"
              class="inline-flex items-center px-8 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-lg font-semibold"
            >
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
              +90 546 911 80 61
            </a>
            <Link 
              :href="route('contact')"
              class="inline-flex items-center px-8 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-400 transition-colors duration-200 text-lg font-semibold"
            >
              Online Teklif Al
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';

const quoteForm = ref({
  cameraCount: '',
  cameraType: '',
  area: ''
});

const submitQuote = () => {
  // Handle quote form submission
  alert('Teklif talebiniz alındı! En kısa sürede sizinle iletişime geçeceğiz.');
};
</script>
