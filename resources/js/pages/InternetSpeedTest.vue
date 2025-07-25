<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16">
    <TopBar />
    <SEO
      title="İnternet Hız Testi | Anında Bağlantı Hızınızı Öğrenin - Fast Teknik İzmir"
      description="İzmir'de internetiniz yavaş mı? Fast Teknik ile anında hız testi yapın. Bağlantı hızınızı ölçün, sonuçları görün ve profesyonel destek alın."
      keywords="internet hız testi, hız testi, izmir internet, internet bağlantı ölçme, online hız testi, speedtest, speed test, "
      url="http://fast-teknik.test.test/internet-hiz-testi"
    />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-6">İnternet Hız Testi – Bağlantınızı Şimdi Ölçün</h1>
      <SpeedTest />
      <div v-if="speedTest.done && speedTest.download < 10" class="mt-6 p-4 bg-red-100 dark:bg-red-900 rounded-lg">
        <p class="text-red-700 dark:text-red-200">Hızınız düşük görünüyor. Teknik destek almak için hemen servis talebi oluşturun.</p>
        <Link :href="route('service-request')" class="mt-2 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
          Teknik Destek Talebi Oluştur
        </Link>
      </div>
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4">İnternet Hız Testi Nasıl Çalışır?</h2>
      <p class="text-gray-600 dark:text-gray-300 mb-4">
        İnternet hız testi, bağlantınızın indirme hızını ölçer. Test sırasında, belirli bir boyuttaki dosya (örneğin 30MB) indirilir ve bu işlemin süresi ölçülür. Sonuç, Mbps (Megabit per second) cinsinden gösterilir. Bu, internet bağlantınızın ne kadar hızlı olduğunu anlamanıza yardımcı olur.
      </p>
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4">Hız Testi Ne Kadar Güvenilir?</h2>
      <p class="text-gray-600 dark:text-gray-300 mb-4">
        Hız testi, internet bağlantınızın genel performansını değerlendirmek için güvenilir bir yöntemdir. Ancak, test sonuçları ağ yükü, sunucu durumu ve diğer faktörlerden etkilenebilir. Bu nedenle, testi farklı zamanlarda tekrarlamak daha doğru bir değerlendirme sağlar.
      </p>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';
import SpeedTest from './SpeedTest.vue';
import { ref } from 'vue';
import TopBar from '@/components/TopBar.vue';

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
</script> 