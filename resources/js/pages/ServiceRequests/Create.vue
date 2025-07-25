<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-100 to-blue-200 dark:from-gray-800 dark:to-gray-900 py-10 px-4 sm:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="max-w-7xl mx-auto mb-10">
      <div class="bg-blue-600 text-white py-8 px-6 rounded-lg shadow-2xl dark:bg-blue-800 flex items-center justify-between">
        <div>
          <h1 class="text-3xl font-bold">Hizmet Talebi Oluştur</h1>
          <p class="mt-1 text-blue-100 dark:text-blue-300 text-lg">{{ selectedService.title }}</p>
        </div>
        <div class="text-blue-200 dark:text-blue-400">
          <component :is="selectedService.icon" class="text-5xl"></component>
        </div>
      </div>
    </div>

    <!-- Service Request Form -->
    <div class="max-w-3xl mx-auto">
      <div class="bg-white rounded-lg shadow-2xl p-8 dark:bg-gray-700 dark:bg-opacity-90 transition-all duration-300">
        <form @submit.prevent="submit">
          <div class="space-y-7">
            <div>
              <label class="block text-base font-semibold text-gray-700 dark:text-gray-200 mb-1">Ad Soyad</label>
              <input 
                type="text" 
                v-model="form.name"
                class="modern-input"
                required
              >
              <p v-if="form.errors.name" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ form.errors.name }}</p>
            </div>

            <div>
              <label class="block text-base font-semibold text-gray-700 dark:text-gray-200 mb-1">Email</label>
              <input 
                type="email" 
                v-model="form.email"
                class="modern-input"
                required
              >
              <p v-if="form.errors.email" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ form.errors.email }}</p>
            </div>

            <div>
              <label class="block text-base font-semibold text-gray-700 dark:text-gray-200 mb-1">Telefon</label>
              <input 
                type="tel" 
                v-model="form.phone"
                class="modern-input"
                required
              >
              <p v-if="form.errors.phone" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ form.errors.phone }}</p>
            </div>

            <div>
              <label class="block text-base font-semibold text-gray-700 dark:text-gray-200 mb-1">Adres</label>
              <input 
                type="text" 
                v-model="form.address"
                class="modern-input"
                required
              >
              <p v-if="form.errors.address" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ form.errors.address }}</p>
            </div>

            <div>
              <label class="block text-base font-semibold text-gray-700 dark:text-gray-200 mb-1">İlçe</label>
              <input 
                type="text" 
                v-model="form.district"
                class="modern-input"
                required
              >
              <p v-if="form.errors.district" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ form.errors.district }}</p>
            </div>

            <div>
              <label class="block text-base font-semibold text-gray-700 dark:text-gray-200 mb-1">Açıklama</label>
              <textarea 
                v-model="form.description"
                rows="4"
                class="modern-input resize-none"
                required
              ></textarea>
              <p v-if="form.errors.description" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ form.errors.description }}</p>
            </div>

            <div v-if="products.length > 0">
              <label class="block text-base font-semibold text-gray-700 dark:text-gray-200 mb-1">Ürün Seç (Opsiyonel)</label>
              <select v-model="form.product_id" class="modern-input">
                <option value="">Ürün seçiniz</option>
                <option v-for="product in products" :key="product.id" :value="product.id">
                  {{ product.name }} ({{ product.category }})
                </option>
              </select>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-2">
              <Link 
                :href="route('service-request')"
                class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 font-medium px-4 py-2 rounded-lg transition"
              >
                Geri Dön
              </Link>
              <button 
                type="submit"
                class="bg-blue-600 text-white px-7 py-3 rounded-lg font-semibold text-lg shadow-md hover:bg-blue-700 transition dark:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-800"
                :disabled="form.processing"
              >
                <span v-if="form.processing">Gönderiliyor...</span>
                <span v-else>Hizmet Talebi Oluştur</span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { CameraIcon, WifiIcon, GlobeAltIcon } from '@heroicons/vue/24/outline';
import { computed, onMounted } from 'vue';

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

// ServiceRequest.vue dosyasından kopyalanan servis tanımları
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

// serviceKey prop'una göre ilgili servis objesini bulma
const selectedService = computed(() => {
  return services.find(service => service.key === props.serviceKey);
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

const submit = () => {
  form.post(route('service-requests.store'), {
    onSuccess: () => {
      form.reset();
    },
    onError: (errors) => {
      console.error('Form submission error:', errors);
    },
  });
};

// Geri Dön Linkini Güncelleme
// Linkin nereye gideceği ServiceRequest.vue sayfasına bağlı.
// Bu link şimdilik anasayfaya veya hizmetler listesine dönebilir.
// ServiceRequest.vue sayfasına dönmesi daha mantıklı ama oraya seçilen servis/opsiyon bilgisi taşımak gerekir.
// Şimdilik ServiceRequest sayfasına yönlendirelim.

</script> 

<style scoped>
.modern-input {
  /* Tailwind utility'leri yerine doğrudan CSS ile modern görünüm */
  display: block;
  width: 100%;
  border-radius: 0.5rem; /* rounded-lg */
  border: 1px solid #d1d5db; /* border-gray-300 */
  background-color: #f3f4f6; /* gray-100 */
  color: #111827; /* gray-900 */
  padding: 0.75rem 1.25rem;
  font-size: 1rem;
  transition: all 0.2s;
  outline: none;
  box-shadow: 0 2px 12px 0 rgba(30, 64, 175, 0.07);
}

.dark .modern-input {
  background-color: #374151; /* dark:bg-gray-600 */
  color: #fff;
  border-color: #6b7280; /* dark:border-gray-500 */
}

.modern-input:focus {
  border-color: #2563eb; /* blue-600 */
  box-shadow: 0 4px 24px 0 rgba(59, 130, 246, 0.15);
}

.modern-input::placeholder {
  color: #9ca3af; /* placeholder-gray-400 */
  opacity: 1;
}

.dark .modern-input::placeholder {
  color: #6b7280; /* dark:placeholder-gray-500 */
}

/* Form kutusu için ekstra gölge ve yumuşaklık */
.bg-white.rounded-lg.shadow-2xl {
  border-radius: 0.5rem;
  box-shadow: 0 8px 32px 0 rgba(30, 64, 175, 0.10), 0 1.5px 6px 0 rgba(59, 130, 246, 0.08);
}
</style> 