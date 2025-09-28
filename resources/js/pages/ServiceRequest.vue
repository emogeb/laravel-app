<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16 py-10 px-4 sm:px-6 lg:px-8">
    <TopBar />
    <div class="max-w-3xl mx-auto mt-10">
      <h1 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-4">Servis Talebi Oluştur</h1>
      <div class="flex justify-center mb-6">
        <button
          @click="handleMainButton"
          class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-xl shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300"
        >
          Servis Talebi Oluştur
        </button>
      </div>
      <div ref="cardsSection" class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div
          v-for="service in services"
          :key="service.key"
          @click="selectService(service.key)"
          :class="[
            'group cursor-pointer rounded-2xl p-8 flex flex-col items-center justify-center transition-all duration-300',
            'bg-white dark:bg-gray-800 shadow-lg',
            selected === service.key ? 'ring-2 ring-blue-500' : '',
            'hover:scale-105 hover:shadow-xl hover:bg-gradient-to-br hover:from-blue-100 hover:to-blue-200 dark:hover:from-blue-900/40 dark:hover:to-blue-800/40',
            'relative overflow-hidden h-full'
          ]"
        >
          <div class="flex items-center justify-center mb-4">
            <span
              :class="[
                'inline-flex items-center justify-center rounded-full transition-transform duration-300',
                'text-6xl',
                'group-hover:rotate-6'
              ]"
            >
              <component :is="service.icon" class="text-blue-600 dark:text-blue-400" />
            </span>
          </div>
          <div class="flex flex-col items-center text-center flex-grow">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 leading-tight">{{ service.title }}</h2>
            <p class="text-gray-500 dark:text-gray-300 text-center flex-grow">{{ service.desc }}</p>
          </div>

          <!-- Glow effect -->
          <div class="absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div class="absolute -inset-4 rounded-2xl bg-blue-400/10 blur-2xl"></div>
          </div>

          <!-- Service Options -->
          <div v-if="selected === service.key" class="w-full mt-6 space-y-4">
            <div class="flex gap-4 justify-center">
              <button
                v-for="option in service.options"
                :key="option.id"
                @click.stop="selectOption(option.id)"
                :class="[
                  'px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200',
                  selectedOption === option.id
                    ? 'bg-blue-600 text-white'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'
                ]"
              >
                {{ option.label }}
              </button>
            </div>
            
            <!-- Mobile Continue Button (sadece telefon görünümünde) -->
            <div v-if="selectedOption" class="sm:hidden mt-4 flex justify-center">
              <button
                @click="handleContinue"
                class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300"
              >
                Devam Et
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Desktop Continue Button (sadece büyük ekranlarda) -->
      <div v-if="selected && selectedOption" class="hidden sm:flex mt-8 justify-center">
        <button
          @click="handleContinue"
          class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-xl shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300"
        >
          Devam Et
        </button>
      </div>
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
    icon: GlobeAltIcon,
    options: [
      { id: 'satellite_ariza', label: 'Anten Arıza' },
      { id: 'satellite_ayar', label: 'Uydu Ayarı' }
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