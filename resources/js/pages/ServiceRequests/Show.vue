<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-100 to-blue-200 dark:from-gray-800 dark:to-gray-900 py-10 px-4 sm:px-6 lg:px-8">
    <SEO
      :title="`Servis Talebi #${serviceRequest.request_number} | Türk Teknik`"
      description="Türk Teknik servis talebi detayları ve durum takibi."
    />
    <div class="max-w-3xl mx-auto">
      <div class="bg-white rounded-lg shadow-xl p-6 dark:bg-gray-700 dark:bg-opacity-80">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Servis Talebi Detayları</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Talep Numarası:</p>
            <p class="mt-1 text-gray-900 dark:text-white">{{ serviceRequest.request_number }}</p>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Durum:</p>
            <span 
              :class="{
                'px-2 py-1 rounded text-sm font-medium mt-1': true,
                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200': serviceRequest.status === 'pending',
                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200': serviceRequest.status === 'in_progress',
                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': serviceRequest.status === 'completed',
                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200': serviceRequest.status === 'cancelled'
              }"
            >
              {{ serviceRequest.status_text }}
            </span>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Hizmet Tipi:</p>
            <p class="mt-1 text-gray-900 dark:text-white">{{ serviceRequest.service_type }}</p>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Seçenek:</p>
            <p class="mt-1 text-gray-900 dark:text-white">{{ serviceRequest.service_option }}</p>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Oluşturulma Tarihi:</p>
            <p class="mt-1 text-gray-900 dark:text-white">{{ new Date(serviceRequest.created_at).toLocaleDateString('tr-TR') }}</p>
          </div>
           <div v-if="serviceRequest.user" >
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Kullanıcı:</p>
            <p class="mt-1 text-gray-900 dark:text-white">{{ serviceRequest.user.name }}</p>
          </div>
          <div v-if="serviceRequest.product">
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Ürün:</p>
            <p class="mt-1 text-gray-900 dark:text-white">{{ serviceRequest.product.name }} ({{ serviceRequest.product.category }})</p>
          </div>
        </div>

        <div class="mb-6">
          <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Açıklama:</p>
          <p class="mt-1 text-gray-900 dark:text-white">{{ serviceRequest.description }}</p>
        </div>

        <div class="mt-6 flex justify-end">
          <Link 
            :href="route('profile')"
            class="text-gray-600 hover:text-gray-900 mr-4 dark:text-gray-400 dark:hover:text-gray-100"
          >
            Geri Dön
          </Link>
          <!-- Diğer butonlar (düzenle, iptal gibi) buraya eklenebilir -->
          <button 
            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200"
            @click="cancelServiceRequest"
          >
            Servis Talebini İptal Et
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';

const props = defineProps({
  serviceRequest: {
    type: Object,
    required: true
  }
});

// Bu fonksiyon backend çağrısını yapacak
const cancelServiceRequest = () => {
  if (confirm('Bu servis talebini iptal etmek istediğinize emin misiniz?')) {
    router.delete(route('service-requests.destroy', props.serviceRequest.id), {
      onSuccess: () => {
        // Başarılı olursa profil sayfasına yönlendirme backendde yapılıyor.
      },
      onError: (errors) => {
        alert('Servis talebi iptal edilirken bir hata oluştu: ' + errors.message);
      },
    });
  }
};
</script> 