<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16 pb-24 relative">
    <!-- Radial Gradient Background -->
    <div class="absolute inset-0 bg-[radial-gradient(1200px_600px_at_50%_-100px,rgba(56,189,248,.12),transparent)] pointer-events-none"></div>
    
    <TopBar />
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 relative">
      <!-- Hero Section -->
      <div class="mb-8 md:mb-12 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 ring-1 ring-white/10 shadow-[inset_0_-1px_0_rgba(255,255,255,.08)] p-6 md:p-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-2xl md:text-3xl font-bold text-white tracking-tight">
              Hizmet Talebi Oluştur
            </h1>
            <p class="mt-2 text-blue-100 text-sm md:text-base">
              {{ selectedService?.title }} • {{ selectedOption?.label }}
            </p>
          </div>
          <component :is="selectedService?.icon" class="w-12 h-12 md:w-16 md:h-16 text-white/80" />
        </div>
      </div>

      <!-- Stepper -->
      <div class="mb-8 md:mb-12">
        <div class="flex items-center justify-between relative">
          <div v-for="(step, index) in steps" :key="index" 
               class="flex flex-col items-center flex-1 relative">
            <!-- Line connector -->
            <div v-if="index < steps.length - 1" 
                 class="absolute top-5 left-1/2 w-full h-0.5 bg-gray-300 dark:bg-white/10 -z-10"
                 :class="currentStep > index ? 'bg-blue-500' : ''"></div>
            
            <!-- Step circle -->
            <div class="flex items-center justify-center w-10 h-10 rounded-full transition-all duration-300 relative z-10"
                 :class="[
                   currentStep === index ? 'bg-blue-500 text-white ring-4 ring-blue-100 dark:ring-blue-900/50' :
                   currentStep > index ? 'bg-blue-500 text-white' :
                   'bg-white dark:bg-white/10 text-gray-400 dark:text-gray-500 ring-1 ring-gray-300 dark:ring-white/20'
                 ]">
              <svg v-if="currentStep > index" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
              <span v-else class="text-sm font-semibold">{{ index + 1 }}</span>
            </div>
            
            <!-- Step label -->
            <span class="mt-2 text-xs md:text-sm font-medium text-center"
                  :class="currentStep >= index ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400'">
              {{ step.label }}
            </span>
          </div>
        </div>
      </div>

      <!-- Main Content: Form + Summary -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
        <!-- Form Column -->
        <div class="lg:col-span-8">
          <div class="rounded-2xl bg-white/6 dark:bg-white/6 ring-1 ring-white/10 backdrop-blur p-6 md:p-8">
            <form @submit.prevent="handleSubmit" :aria-busy="form.processing">
              <!-- Step 1: İletişim Bilgileri -->
              <div v-show="currentStep === 0" class="space-y-6">
                <div>
                  <h3 class="mb-2 text-sm font-semibold text-slate-200">İletişim Bilgileri</h3>
                  <div class="h-px bg-white/10 mb-6"></div>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                      <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Ad Soyad <span class="text-red-500">*</span>
                      </label>
                      <input 
                        id="name"
                        type="text" 
                        v-model="form.name"
                        autocomplete="name"
                        :aria-invalid="!!form.errors.name"
                        :aria-describedby="form.errors.name ? 'name-error' : undefined"
                        @blur="validateField('name')"
                        class="form-input"
                        :class="{ 'ring-red-500/60': form.errors.name }"
                        required
                      >
                      <p v-if="form.errors.name" id="name-error" class="mt-2 text-sm text-red-500/80">
                        {{ form.errors.name }}
                      </p>
                    </div>

                    <div>
                      <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Email <span class="text-red-500">*</span>
                      </label>
                      <input 
                        id="email"
                        type="email" 
                        v-model="form.email"
                        autocomplete="email"
                        :aria-invalid="!!form.errors.email"
                        :aria-describedby="form.errors.email ? 'email-error' : undefined"
                        @blur="validateField('email')"
                        class="form-input"
                        :class="{ 'ring-red-500/60': form.errors.email }"
                        required
                      >
                      <p v-if="form.errors.email" id="email-error" class="mt-2 text-sm text-red-500/80">
                        {{ form.errors.email }}
                      </p>
                    </div>

                    <div class="md:col-span-2">
                      <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Telefon <span class="text-red-500">*</span>
                      </label>
                      <input 
                        id="phone"
                        type="tel" 
                        v-model="form.phone"
                        autocomplete="tel"
                        placeholder="+90 (5XX) XXX XX XX"
                        :aria-invalid="!!form.errors.phone"
                        :aria-describedby="form.errors.phone ? 'phone-error' : undefined"
                        @blur="validateField('phone')"
                        class="form-input"
                        :class="{ 'ring-red-500/60': form.errors.phone }"
                        required
                      >
                      <p v-if="form.errors.phone" id="phone-error" class="mt-2 text-sm text-red-500/80">
                        {{ form.errors.phone }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Step 2: Adres Bilgileri -->
              <div v-show="currentStep === 1" class="space-y-6">
                <div>
                  <h3 class="mb-2 text-sm font-semibold text-slate-200">Adres Bilgileri</h3>
                  <div class="h-px bg-white/10 mb-6"></div>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                      <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Adres <span class="text-red-500">*</span>
                      </label>
                      <input 
                        id="address"
                        type="text" 
                        v-model="form.address"
                        autocomplete="address-line1"
                        :aria-invalid="!!form.errors.address"
                        :aria-describedby="form.errors.address ? 'address-error' : undefined"
                        @blur="validateField('address')"
                        class="form-input"
                        :class="{ 'ring-red-500/60': form.errors.address }"
                        required
                      >
                      <p v-if="form.errors.address" id="address-error" class="mt-2 text-sm text-red-500/80">
                        {{ form.errors.address }}
                      </p>
                    </div>

                    <div>
                      <label for="district" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        İlçe <span class="text-red-500">*</span>
                      </label>
                      <input 
                        id="district"
                        type="text" 
                        v-model="form.district"
                        autocomplete="address-level2"
                        :aria-invalid="!!form.errors.district"
                        :aria-describedby="form.errors.district ? 'district-error' : undefined"
                        @blur="validateField('district')"
                        class="form-input"
                        :class="{ 'ring-red-500/60': form.errors.district }"
                        required
                      >
                      <p v-if="form.errors.district" id="district-error" class="mt-2 text-sm text-red-500/80">
                        {{ form.errors.district }}
                      </p>
                    </div>

                    <div>
                      <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        İl <span class="text-red-500">*</span>
                      </label>
                      <input 
                        id="city"
                        type="text" 
                        value="İzmir"
                        autocomplete="address-level1"
                        class="form-input bg-gray-100 dark:bg-white/5"
                        disabled
                      >
                    </div>
                  </div>
                </div>
              </div>

              <!-- Step 3: Hizmet Detayı -->
              <div v-show="currentStep === 2" class="space-y-6">
                <div>
                  <h3 class="mb-2 text-sm font-semibold text-slate-200">Talep Detayları</h3>
                  <div class="h-px bg-white/10 mb-6"></div>

                  <div class="space-y-6">
                    <div>
                      <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Açıklama <span class="text-red-500">*</span>
                      </label>
                      <textarea 
                        id="description"
                        v-model="form.description"
                        rows="5"
                        :aria-invalid="!!form.errors.description"
                        :aria-describedby="form.errors.description ? 'description-error' : undefined"
                        @blur="validateField('description')"
                        placeholder="Lütfen sorunun detaylarını veya kurulum için gerekli bilgileri yazınız..."
                        class="form-input resize-none"
                        :class="{ 'ring-red-500/60': form.errors.description }"
                        required
                      ></textarea>
                      <p v-if="form.errors.description" id="description-error" class="mt-2 text-sm text-red-500/80">
                        {{ form.errors.description }}
                      </p>
                    </div>

                    <div v-if="products.length > 0">
                      <label for="product" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Ürün Seç (Opsiyonel)
                      </label>
                      <select id="product" v-model="form.product_id" class="form-input">
                        <option value="">Ürün seçiniz</option>
                        <option v-for="product in products" :key="product.id" :value="product.id">
                          {{ product.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Step 4: Onay -->
              <div v-show="currentStep === 3" class="space-y-6">
                <div>
                  <h3 class="mb-2 text-sm font-semibold text-slate-200">Bilgileri Onaylayın</h3>
                  <div class="h-px bg-white/10 mb-6"></div>

                  <div class="space-y-4 text-sm">
                    <div class="bg-white/5 rounded-xl p-4 space-y-3">
                      <div class="flex justify-between">
                        <span class="text-gray-400">Ad Soyad:</span>
                        <span class="text-white font-medium">{{ form.name }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-gray-400">Email:</span>
                        <span class="text-white font-medium">{{ form.email }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-gray-400">Telefon:</span>
                        <span class="text-white font-medium">{{ form.phone }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-gray-400">Adres:</span>
                        <span class="text-white font-medium text-right">{{ form.address }}, {{ form.district }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-gray-400">Hizmet:</span>
                        <span class="text-white font-medium">{{ selectedService?.title }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-gray-400">Seçenek:</span>
                        <span class="text-white font-medium">{{ selectedOption?.label }}</span>
                      </div>
                      <div v-if="selectedProduct" class="flex justify-between">
                        <span class="text-gray-400">Ürün:</span>
                        <span class="text-white font-medium text-right">{{ selectedProduct?.name }}</span>
                      </div>
                    </div>

                    <!-- Trust Badges -->
                    <div class="flex flex-wrap gap-2 pt-4">
                      <span class="rounded-full text-xs px-2.5 py-1 bg-emerald-400/10 text-emerald-300 ring-1 ring-emerald-300/20">
                        Aynı Gün Keşif
                      </span>
                      <span class="rounded-full text-xs px-2.5 py-1 bg-emerald-400/10 text-emerald-300 ring-1 ring-emerald-300/20">
                        2 Yıl İşçilik Garantisi
                      </span>
                      <span class="rounded-full text-xs px-2.5 py-1 bg-emerald-400/10 text-emerald-300 ring-1 ring-emerald-300/20">
                        Profesyonel Hizmet
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Navigation Buttons (Desktop) -->
              <div class="hidden md:flex items-center justify-between mt-8 pt-6 border-t border-white/10">
                <button
                  v-if="currentStep > 0"
                  type="button"
                  @click="prevStep"
                  class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-300 hover:text-white transition-colors"
                >
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                  </svg>
                  Geri
                </button>
                <Link 
                  v-else
                  :href="route('service-request')"
                  rel="prev"
                  class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-300 hover:text-white transition-colors"
                >
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                  </svg>
                  İptal
                </Link>

                <button
                  v-if="currentStep < 3"
                  type="button"
                  @click="nextStep"
                  :disabled="!canProceed"
                  class="inline-flex items-center px-6 py-2.5 rounded-xl bg-blue-500 hover:bg-blue-400 text-white font-semibold transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                  Devam
                  <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </button>
                <button
                  v-else
                  type="submit"
                  :disabled="form.processing"
                  :data-busy="form.processing"
                  class="inline-flex items-center px-6 py-2.5 rounded-xl bg-blue-500 hover:bg-blue-400 text-white font-semibold shadow-lg transition-all duration-300 disabled:opacity-60 data-[busy=true]:cursor-wait"
                >
                  <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  <span v-if="form.processing">Gönderiliyor...</span>
                  <span v-else>Talebi Gönder</span>
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Summary Column (Desktop only) -->
        <div class="hidden lg:block lg:col-span-4">
          <div class="sticky top-20 rounded-2xl bg-white/6 dark:bg-white/6 ring-1 ring-white/10 backdrop-blur p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Seçiminiz</h3>
            
            <div class="space-y-4">
              <div class="flex items-start gap-3">
                <component :is="selectedService?.icon" class="w-8 h-8 text-blue-400 flex-shrink-0" />
                <div class="flex-1">
                  <p class="text-sm font-medium text-white">{{ selectedService?.title }}</p>
                  <p class="text-xs text-gray-400 mt-1">{{ selectedOption?.label }}</p>
                </div>
              </div>

              <div class="h-px bg-white/10"></div>

              <div class="space-y-2 text-sm">
                <div class="flex items-center gap-2 text-gray-300">
                  <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Tahmini Süre: 2-3 saat
                </div>
                <div class="flex items-center gap-2 text-gray-300">
                  <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  Randevu: 24 saat içinde
                </div>
                <div class="flex items-center gap-2 text-gray-300">
                  <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Ücretsiz Keşif
                </div>
              </div>

              <div class="h-px bg-white/10"></div>

              <div class="bg-blue-500/10 rounded-lg p-3">
                <p class="text-xs text-blue-300">
                  ℹ️ Talebiniz alındıktan sonra aynı gün içerisinde size dönüş yapılacaktır.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Selection Summary (Mobile only) -->
      <div class="lg:hidden mt-8 rounded-2xl bg-white/6 dark:bg-white/6 ring-1 ring-white/10 backdrop-blur p-5">
        <h3 class="text-base font-semibold text-white mb-3">Seçiminiz</h3>
        
        <div class="space-y-3">
          <div class="flex items-start gap-3">
            <component :is="selectedService?.icon" class="w-8 h-8 text-blue-400 flex-shrink-0" />
            <div class="flex-1">
              <p class="text-sm font-medium text-white">{{ selectedService?.title }}</p>
              <p class="text-xs text-gray-400 mt-1">{{ selectedOption?.label }}</p>
            </div>
          </div>

          <div class="h-px bg-white/10"></div>

          <div class="space-y-2 text-xs">
            <div class="flex items-center gap-2 text-gray-300">
              <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Tahmini Süre: 2-3 saat
            </div>
            <div class="flex items-center gap-2 text-gray-300">
              <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              Randevu: 24 saat içinde
            </div>
            <div class="flex items-center gap-2 text-gray-300">
              <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Ücretsiz Keşif
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Sticky Mobile CTA -->
    <div class="md:hidden fixed bottom-3 inset-x-0 mx-3 rounded-2xl bg-white/10 backdrop-blur p-2 ring-1 ring-white/15 z-50">
      <div class="flex items-center gap-2">
        <button
          v-if="currentStep > 0"
          type="button"
          @click="prevStep"
          class="flex-shrink-0 px-4 py-2 text-sm font-medium text-white"
        >
          ← Geri
        </button>
        <button
          v-if="currentStep < 3"
          type="button"
          @click="nextStep"
          :disabled="!canProceed"
          class="flex-1 px-4 py-2.5 rounded-xl bg-blue-500 text-white font-semibold disabled:opacity-50 disabled:cursor-not-allowed"
        >
          Devam
        </button>
        <button
          v-else
          @click="handleSubmit"
          :disabled="form.processing"
          class="flex-1 px-4 py-2.5 rounded-xl bg-blue-500 text-white font-semibold disabled:opacity-60"
        >
          <span v-if="form.processing">Gönderiliyor...</span>
          <span v-else>Talebi Gönder</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { CameraIcon, WifiIcon, GlobeAltIcon } from '@heroicons/vue/24/outline';
import { computed, ref } from 'vue';
import TopBar from '@/components/TopBar.vue';

const props = defineProps({
  serviceKey: {
    type: String,
    required: true
  },
  optionId: {
    type: String,
    required: true
  },
  userData: {
    type: Object,
    default: () => ({})
  },
  products: {
    type: Array,
    default: () => []
  }
});

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

const steps = [
  { label: 'İletişim' },
  { label: 'Adres' },
  { label: 'Detay' },
  { label: 'Onay' }
];

const currentStep = ref(0);

const selectedService = computed(() => {
  return services.find(service => service.key === props.serviceKey);
});

const selectedOption = computed(() => {
  return selectedService.value?.options.find(opt => opt.id === props.optionId);
});

const selectedProduct = computed(() => {
  if (!form.product_id) return null;
  return props.products.find(product => product.id === parseInt(form.product_id));
});

const form = useForm({
  name: props.userData.name || '',
  email: props.userData.email || '',
  phone: props.userData.phone || '',
  address: props.userData.address || '',
  district: '',
  description: '',
  service_key: props.serviceKey,
  option_id: props.optionId,
  product_id: '',
});

const canProceed = computed(() => {
  if (currentStep.value === 0) {
    return form.name && form.email && form.phone;
  }
  if (currentStep.value === 1) {
    return form.address && form.district;
  }
  if (currentStep.value === 2) {
    return form.description;
  }
  return true;
});

const validateField = (field) => {
  // Simple client-side validation
  if (!form[field]) {
    form.errors[field] = 'Bu alan zorunludur';
  } else {
    delete form.errors[field];
  }
};

const nextStep = () => {
  if (canProceed.value && currentStep.value < 3) {
    currentStep.value++;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
};

const prevStep = () => {
  if (currentStep.value > 0) {
    currentStep.value--;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
};

const handleSubmit = () => {
  form.post(route('service-requests.store'), {
    onSuccess: () => {
      form.reset();
    },
    onError: (errors) => {
      console.error('Form submission error:', errors);
      // Focus on first error field
      const firstErrorField = Object.keys(errors)[0];
      document.getElementById(firstErrorField)?.focus();
    },
  });
};
</script>

<style scoped>
.form-input {
  display: block;
  width: 100%;
  border-radius: 0.5rem;
  border: 0;
  background-color: rgba(255, 255, 255, 0.05);
  padding: 0.625rem 1rem;
  color: white;
  outline: none;
  box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
  transition: all 0.2s;
}

.form-input::placeholder {
  color: rgb(156, 163, 175);
}

.form-input:focus {
  box-shadow: 0 0 0 2px rgb(59, 130, 246) inset;
}

.form-input:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>
