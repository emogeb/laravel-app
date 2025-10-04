<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16 relative">
    <!-- Radial Gradient Background -->
    <div class="absolute inset-0 bg-[radial-gradient(1200px_600px_at_50%_-100px,rgba(56,189,248,.15),transparent)] pointer-events-none"></div>
    
    <TopBar />
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16 space-y-10 md:space-y-14 relative">
      <!-- Hero Section -->
      <div class="text-center space-y-4">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white tracking-tight">
          Servis Talebi Oluştur
        </h1>
        <button
          @click="handleMainButton"
          class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors duration-300 hover:underline"
        >
          Hemen Başla
          <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
      </div>

      <!-- Services Grid -->
      <div ref="cardsSection" class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-6">
        <div
          v-for="service in services"
          :key="service.key"
          @click="selectService(service.key)"
          :data-checked="selected === service.key"
          :class="[
            'group cursor-pointer rounded-2xl p-6 md:p-7 flex flex-col transition-all duration-300',
            'bg-white/80 dark:bg-white/9 backdrop-blur-sm shadow-lg',
            'ring-1 ring-gray-200 dark:ring-white/10 hover:ring-blue-300 dark:hover:ring-white/20',
            selected === service.key 
              ? 'ring-2 ring-blue-500' 
              : '',
            'relative overflow-hidden'
          ]"
          :style="selected === service.key ? 'background: linear-gradient(180deg, rgba(59,130,246,.15), transparent), rgba(255,255,255,.9);' : ''"
        >
          <!-- Check Icon (only when selected) -->
          <div v-if="selected === service.key" class="absolute right-3 top-3 size-5 rounded-full bg-blue-500 text-white flex items-center justify-center">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
          </div>

          <!-- Icon -->
          <div class="flex items-center justify-center mb-4">
            <component :is="service.icon" class="w-12 h-12 text-blue-600 dark:text-blue-400 transition-transform duration-300 group-hover:rotate-6 group-hover:scale-110" />
          </div>

          <!-- Content -->
          <div class="flex flex-col items-center text-center flex-grow">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ service.title }}</h2>
            <p class="text-sm text-gray-600 dark:text-slate-300/90 mb-3">{{ service.desc }}</p>
            
            <!-- Mini Benefits -->
            <p class="text-xs text-slate-400 dark:text-slate-400">{{ service.benefits }}</p>
          </div>

          <!-- Service Options (Chips) -->
          <div v-if="selected === service.key" class="w-full mt-4">
            <div class="flex flex-wrap gap-2.5 justify-center">
              <button
                v-for="option in service.options"
                :key="option.id"
                @click.stop="selectOption(option.id)"
                :class="[
                  'text-sm px-3.5 py-1.5 rounded-xl font-semibold transition-all duration-200',
                  selectedOption === option.id
                    ? 'bg-blue-600 text-white ring-2 ring-blue-500 shadow-lg scale-105'
                    : 'bg-gray-200 dark:bg-white/10 text-gray-900 dark:text-slate-200 ring-1 ring-gray-300 dark:ring-white/15 hover:bg-gray-300 dark:hover:bg-white/20 hover:scale-105'
                ]"
              >
                {{ option.label }}
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Continue Button (Desktop only) -->
      <Transition
        enter-active-class="transition-opacity duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-300"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div v-if="selected && selectedOption" class="hidden md:flex justify-center">
          <button
            @click="handleContinue"
            class="inline-flex items-center justify-center px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold shadow-xl transition-all duration-300 hover:scale-105"
          >
            Devam Et
          </button>
        </div>
      </Transition>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { CameraIcon, WifiIcon, GlobeAltIcon } from '@heroicons/vue/24/outline';
import TopBar from '@/components/TopBar.vue';
import { Link, router } from '@inertiajs/vue3';

const services = [
  {
    key: 'camera',
    title: 'Kamera Sistemleri',
    desc: 'Güvenlik kamera kurulumu, arıza ve bakım hizmetleri',
    benefits: 'PoE & NVR · Mobil erişim',
    icon: CameraIcon,
    options: [
      { id: 'camera_ariza', label: 'Arıza' },
      { id: 'camera_kurulum', label: 'Kurulum' }
    ]
  },
  {
    key: 'internet',
    title: 'İnternet Hizmetleri',
    desc: 'İnternet bağlantısı, ağ altyapısı ve sorun giderme',
    benefits: 'Modem/ONT · LAN yapılandırma',
    icon: WifiIcon,
    options: [
      { id: 'internet_ariza', label: 'Arıza' },
      { id: 'internet_kurulum', label: 'Kurulum ve Altyapı' }
    ]
  },
  {
    key: 'satellite',
    title: 'Uydu Sistemleri',
    desc: 'Çanak anten kurulumu, uydu ayarı ve arıza hizmetleri',
    benefits: 'LNB/Çanak ayar · Sinyal ölçümü',
    icon: GlobeAltIcon,
    options: [
      { id: 'satellite_ariza', label: 'Arıza' },
      { id: 'satellite_ayar', label: 'Kurulum' }
    ]
  },
];

const selected = ref(null);
const selectedOption = ref(null);
const cardsSection = ref(null);

function selectService(key) {
  selected.value = key;
  selectedOption.value = null;
}

function selectOption(optionId) {
  selectedOption.value = optionId;
  
  // Mobil cihazlarda (768px altı) direkt forma yönlendir
  if (window.innerWidth < 768) {
    handleContinue();
  }
}

function handleMainButton() {
  selected.value = services[0].key;
  selectedOption.value = null;
  if (cardsSection.value) {
    cardsSection.value.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
}

function handleContinue() {
  if (selected.value && selectedOption.value) {
    router.visit(route('service-requests.create', {
      service: selected.value,
      option: selectedOption.value
    }));
  }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style> 