<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16">
    <TopBar />
    <SEO
      title="İnternet Hız Testi | Anında Bağlantı Hızınızı Öğrenin - Fast Teknik İzmir"
      description="İzmir'de internetiniz yavaş mı? Fast Teknik ile anında hız testi yapın. Bağlantı hızınızı ölçün, sonuçları görün ve profesyonel destek alın."
      keywords="internet hız testi, hız testi, izmir internet, internet bağlantı ölçme, online hız testi, speedtest, speed test"
      url="http://fast-teknik.test.test/internet-hiz-testi"
    />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-6 text-center">İnternet Hız Testi – Bağlantınızı Şimdi Ölçün</h1>
      
      <SpeedTest @test-complete="handleTestComplete" />
      
      <!-- Düşük Hız Uyarısı -->
      <div v-if="showSlowWarning" class="mt-8 p-6 bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 border border-orange-200 dark:border-orange-800 rounded-xl">
        <div class="flex items-start gap-4">
          <div class="flex-shrink-0">
            <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
          <div class="flex-1">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">İnternet Hızınız Normalin Altında</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4">
              İndirme hızınız <strong>{{ testResults.download }} Mbps</strong> olarak ölçüldü. Bu değer ideal internet kullanımı için yeterli olmayabilir. 
              Sorunun kaynağını tespit etmek ve hızınızı artırmak için uzman desteği alabilirsiniz.
            </p>
            <Link 
              :href="route('service-request')" 
              class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 transition-all duration-200 shadow-lg hover:shadow-xl"
            >
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
              Teknik Destek Talebi Oluştur
            </Link>
          </div>
        </div>
      </div>

      <!-- İyi Hız Bilgilendirmesi -->
      <div v-else-if="testResults.download !== null && !showSlowWarning" class="mt-8 p-6 bg-gradient-to-r from-green-50 to-blue-50 dark:from-green-900/20 dark:to-blue-900/20 border border-green-200 dark:border-green-800 rounded-xl">
        <div class="flex items-start gap-4">
          <div class="flex-shrink-0">
            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div class="flex-1">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">İnternet Bağlantınız İyi Durumda!</h3>
            <p class="text-gray-700 dark:text-gray-300">
              İndirme hızınız <strong>{{ testResults.download }} Mbps</strong> olarak ölçüldü. Bu, çoğu kullanım için yeterli bir hızdır.
              Ancak hala sorun yaşıyorsanız, ağ altyapınızı kontrol etmek için bizimle iletişime geçebilirsiniz.
            </p>
          </div>
        </div>
      </div>

      <!-- Bilgilendirme Bölümü -->
      <div class="mt-12 space-y-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">İnternet Hız Testi Nasıl Çalışır?</h2>
          <p class="text-gray-600 dark:text-gray-300 mb-4">
            Hız testimiz dört aşamadan oluşur:
          </p>
          <ul class="space-y-3 text-gray-600 dark:text-gray-300">
            <li class="flex items-start gap-3">
              <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
              <span><strong>Ping (Gecikme):</strong> Sunucuya veri gönderip yanıt almanın ne kadar sürdüğünü ölçer. Düşük ping değeri daha iyidir (oyun ve video konferans için önemli).</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
              </svg>
              <span><strong>Jitter:</strong> Ping değerindeki değişkenliği gösterir. Düşük jitter daha kararlı bir bağlantı anlamına gelir.</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
              </svg>
              <span><strong>İndirme Hızı:</strong> İnternetten veri indirme hızınızı ölçer. Yüksek değer, daha hızlı sayfa yükleme ve indirme anlamına gelir.</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-6 h-6 text-orange-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
              </svg>
              <span><strong>Yükleme Hızı:</strong> İnternete veri gönderme hızınızı ölçer. Dosya paylaşımı ve video yayını için önemlidir.</span>
            </li>
          </ul>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Hız Testi Ne Kadar Güvenilir?</h2>
          <p class="text-gray-600 dark:text-gray-300 mb-4">
            Hız testimiz, Cloudflare'in global CDN altyapısını kullanarak güvenilir sonuçlar sunar. Ancak, test sonuçları çeşitli faktörlerden etkilenebilir:
          </p>
          <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300 ml-4">
            <li>Ağ trafiği ve yoğunluk durumu</li>
            <li>WiFi sinyal gücü ve kalitesi</li>
            <li>Arka planda çalışan uygulamalar</li>
            <li>VPN veya proxy kullanımı</li>
            <li>Cihazınızın işlemci ve ağ kartı performansı</li>
          </ul>
          <p class="text-gray-600 dark:text-gray-300 mt-4">
            <strong>Öneri:</strong> Daha doğru sonuçlar için testi farklı zamanlarda birkaç kez tekrarlayın ve diğer uygulamaları kapatın.
          </p>
        </div>

        <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-xl shadow-sm p-6">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">İdeal İnternet Hızları</h2>
          <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
              <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Temel Kullanım</h3>
              <p class="text-sm text-gray-600 dark:text-gray-300">Web gezintisi, e-posta, sosyal medya</p>
              <p class="text-lg font-bold text-blue-600 dark:text-blue-400 mt-2">5-10 Mbps</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
              <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Video İzleme</h3>
              <p class="text-sm text-gray-600 dark:text-gray-300">HD video akışı (YouTube, Netflix)</p>
              <p class="text-lg font-bold text-blue-600 dark:text-blue-400 mt-2">10-25 Mbps</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
              <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Online Oyun</h3>
              <p class="text-sm text-gray-600 dark:text-gray-300">Düşük ping ve kararlı bağlantı</p>
              <p class="text-lg font-bold text-blue-600 dark:text-blue-400 mt-2">25-50 Mbps</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
              <h3 class="font-semibold text-gray-900 dark:text-white mb-2">4K Video & İş</h3>
              <p class="text-sm text-gray-600 dark:text-gray-300">4K streaming, video konferans, çoklu cihaz</p>
              <p class="text-lg font-bold text-blue-600 dark:text-blue-400 mt-2">50+ Mbps</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';
import SpeedTest from './SpeedTest.vue';
import { ref, computed } from 'vue';
import TopBar from '@/components/TopBar.vue';

interface SpeedTestResults {
  ping: string | null;
  jitter: string | null;
  download: string | null;
  upload: string | null;
}

const testResults = ref<SpeedTestResults>({
  ping: null,
  jitter: null,
  download: null,
  upload: null
});

const showSlowWarning = computed(() => {
  return testResults.value.download !== null && parseFloat(testResults.value.download) < 10;
});

function handleTestComplete(results: SpeedTestResults) {
  testResults.value = results;
}
</script> 