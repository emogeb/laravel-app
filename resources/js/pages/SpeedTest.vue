<template>
  <div class="min-h-[400px] flex flex-col items-center justify-center py-10 px-4">
    <div class="max-w-2xl w-full bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 text-center">İnternet Hız Testi</h2>
      <p class="text-gray-500 dark:text-gray-300 mb-6 text-center">Ping, indirme ve yükleme hızınızı ölçün.</p>

      <!-- Ana Hız Göstergesi -->
      <div class="relative w-64 h-64 mx-auto mb-6">
        <svg viewBox="0 0 100 100" class="w-full h-full transform -rotate-90">
          <circle cx="50" cy="50" r="45" fill="none" stroke-width="8" class="stroke-gray-200 dark:stroke-gray-700" />
          <circle
            cx="50"
            cy="50"
            r="45"
            fill="none"
            stroke-width="8"
            stroke="url(#speedGradient)"
            :stroke-dasharray="circumference"
            :stroke-dashoffset="circumference - (circumference * currentSpeedPercent)"
            stroke-linecap="round"
            class="transition-all duration-500 ease-out"
          />
          <defs>
            <linearGradient id="speedGradient" x1="0%" y1="0%" x2="100%" y2="0%">
              <stop offset="0%" style="stop-color:#3B82F6" />
              <stop offset="50%" style="stop-color:#8B5CF6" />
              <stop offset="100%" style="stop-color:#10B981" />
            </linearGradient>
          </defs>
        </svg>
        
        <div class="absolute inset-0 flex flex-col items-center justify-center">
          <div class="text-4xl font-bold text-blue-600 dark:text-blue-400">
            {{ displaySpeed }}
          </div>
          <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            {{ testStatus }}
          </div>
        </div>
      </div>

      <!-- Detaylı Sonuçlar -->
      <div v-if="results.ping !== null" class="grid grid-cols-3 gap-4 mb-6">
        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
          <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Ping</div>
          <div class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ results.ping }}<span class="text-sm ml-1">ms</span>
          </div>
          <div class="text-xs text-gray-400 mt-1">{{ results.jitter !== null ? `±${results.jitter}ms` : '' }}</div>
        </div>
        
        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
          <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">İndirme</div>
          <div class="text-2xl font-bold text-green-600 dark:text-green-400">
            {{ results.download }}<span class="text-sm ml-1">Mbps</span>
          </div>
        </div>
        
        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
          <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Yükleme</div>
          <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
            {{ results.upload }}<span class="text-sm ml-1">Mbps</span>
          </div>
        </div>
      </div>

      <!-- İlerleme Durumu -->
      <div v-if="testing" class="mb-6">
        <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400 mb-2">
          <span>{{ currentTestName }}</span>
          <span>{{ progressPercent }}%</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
          <div 
            class="bg-blue-600 h-2 rounded-full transition-all duration-300"
            :style="{ width: progressPercent + '%' }"
          ></div>
        </div>
      </div>

      <!-- Başlat/Tekrar Butonu -->
      <button
        @click="startTest"
        :disabled="testing"
        class="w-full px-8 py-4 rounded-xl font-semibold shadow-lg transition-all duration-300 disabled:opacity-60 disabled:cursor-not-allowed"
        :class="testing ? 'bg-gray-400 text-white' : 'bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white'"
      >
        {{ testing ? 'Test Yapılıyor...' : (results.download !== null ? 'Testi Tekrarla' : 'Hız Testini Başlat') }}
      </button>

      <!-- Hata Mesajı -->
      <div v-if="error" class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
        <p class="text-red-700 dark:text-red-400 text-sm text-center">{{ error }}</p>
      </div>

      <!-- Test Detayları -->
      <div class="mt-6 text-center text-xs text-gray-500 dark:text-gray-400">
        <p>Test, LibreSpeed kullanılarak gerçekleştirilmektedir.</p>
        <p class="mt-1">Daha doğru sonuçlar için diğer uygulamaları kapatın.</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const emit = defineEmits(['test-complete']);

const testing = ref(false);
const error = ref('');
const currentSpeed = ref(0);
const currentTestName = ref('');
const progressPercent = ref(0);

const results = ref({
  ping: null,
  jitter: null,
  download: null,
  upload: null
});

const maxSpeed = 200;
const circumference = 2 * Math.PI * 45;

const currentSpeedPercent = computed(() => {
  return Math.min(currentSpeed.value / maxSpeed, 1);
});

const displaySpeed = computed(() => {
  if (!testing.value && results.value.download === null) {
    return '-';
  }
  return currentSpeed.value > 0 ? currentSpeed.value.toFixed(1) : '0.0';
});

const testStatus = computed(() => {
  if (testing.value) {
    return currentTestName.value;
  }
  if (results.value.download !== null) {
    return 'Mbps';
  }
  return 'Hazır';
});

// LibreSpeed benzeri test implementasyonu
async function startTest() {
  testing.value = true;
  error.value = '';
  currentSpeed.value = 0;
  progressPercent.value = 0;
  
  results.value = {
    ping: null,
    jitter: null,
    download: null,
    upload: null
  };

  try {
    // 1. Ping Testi
    await testPing();
    progressPercent.value = 25;
    
    // 2. Jitter Testi
    await testJitter();
    progressPercent.value = 40;
    
    // 3. Download Testi
    await testDownload();
    progressPercent.value = 70;
    
    // 4. Upload Testi
    await testUpload();
    progressPercent.value = 100;

    emit('test-complete', results.value);
    
  } catch (e) {
    error.value = 'Test sırasında bir hata oluştu. Lütfen tekrar deneyin.';
    console.error('Speed test error:', e);
  } finally {
    testing.value = false;
    currentTestName.value = '';
  }
}

async function testPing() {
  currentTestName.value = 'Ping ölçülüyor...';
  const pingResults = [];
  
  for (let i = 0; i < 10; i++) {
    const start = performance.now();
    try {
      await fetch('https://www.cloudflare.com/cdn-cgi/trace', { 
        cache: 'no-store',
        method: 'GET'
      });
      const end = performance.now();
      pingResults.push(end - start);
    } catch (e) {
      console.warn('Ping test failed:', e);
    }
    await new Promise(resolve => setTimeout(resolve, 100));
  }
  
  if (pingResults.length > 0) {
    results.value.ping = (pingResults.reduce((a, b) => a + b, 0) / pingResults.length).toFixed(0);
  }
}

async function testJitter() {
  currentTestName.value = 'Jitter ölçülüyor...';
  const jitterResults = [];
  let lastPing = null;
  
  for (let i = 0; i < 5; i++) {
    const start = performance.now();
    try {
      await fetch('https://www.cloudflare.com/cdn-cgi/trace', { 
        cache: 'no-store',
        method: 'GET'
      });
      const end = performance.now();
      const currentPing = end - start;
      
      if (lastPing !== null) {
        jitterResults.push(Math.abs(currentPing - lastPing));
      }
      lastPing = currentPing;
    } catch (e) {
      console.warn('Jitter test failed:', e);
    }
    await new Promise(resolve => setTimeout(resolve, 100));
  }
  
  if (jitterResults.length > 0) {
    results.value.jitter = (jitterResults.reduce((a, b) => a + b, 0) / jitterResults.length).toFixed(1);
  }
}

async function testDownload() {
  currentTestName.value = 'İndirme hızı ölçülüyor...';
  currentSpeed.value = 0;
  
  const testSizes = [5000000, 10000000, 20000000]; // 5MB, 10MB, 20MB
  const speeds = [];
  
  for (const size of testSizes) {
    const startTime = performance.now();
    let received = 0;
    
    try {
      const response = await fetch(`https://speed.cloudflare.com/__down?bytes=${size}`, {
        method: 'GET',
        cache: 'no-store'
      });
      
      const reader = response.body.getReader();
      
      while (true) {
        const { done, value } = await reader.read();
        if (done) break;
        received += value.length;
        
        // Gerçek zamanlı hız güncellemesi
        const elapsed = (performance.now() - startTime) / 1000;
        if (elapsed > 0.1) {
          currentSpeed.value = ((received * 8) / elapsed) / (1024 * 1024);
        }
      }
      
      const endTime = performance.now();
      const totalTime = (endTime - startTime) / 1000;
      const speedMbps = ((received * 8) / totalTime) / (1024 * 1024);
      speeds.push(speedMbps);
      
    } catch (e) {
      console.warn('Download test failed for size', size, e);
    }
  }
  
  if (speeds.length > 0) {
    // En yüksek hızı kullan (optimal koşullar)
    const maxDownloadSpeed = Math.max(...speeds);
    results.value.download = maxDownloadSpeed.toFixed(2);
    currentSpeed.value = maxDownloadSpeed;
  }
}

async function testUpload() {
  currentTestName.value = 'Yükleme hızı ölçülüyor...';
  currentSpeed.value = 0;
  
  const testSizes = [1000000, 2000000]; // 1MB, 2MB
  const speeds = [];
  
  for (const size of testSizes) {
    const data = new Uint8Array(size);
    const startTime = performance.now();
    
    try {
      await fetch('https://speed.cloudflare.com/__up', {
        method: 'POST',
        cache: 'no-store',
        body: data,
      });
      
      const endTime = performance.now();
      const totalTime = (endTime - startTime) / 1000;
      const speedMbps = ((size * 8) / totalTime) / (1024 * 1024);
      speeds.push(speedMbps);
      currentSpeed.value = speedMbps;
      
    } catch (e) {
      console.warn('Upload test failed for size', size, e);
    }
  }
  
  if (speeds.length > 0) {
    const maxUploadSpeed = Math.max(...speeds);
    results.value.upload = maxUploadSpeed.toFixed(2);
    currentSpeed.value = maxUploadSpeed;
  }
}
</script>

<style scoped>
circle {
  transition: stroke-dashoffset 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>