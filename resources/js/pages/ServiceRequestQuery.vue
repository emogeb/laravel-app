<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16 relative">
    <!-- Radial Gradient Background -->
    <div class="absolute inset-0 bg-[radial-gradient(1200px_600px_at_50%_-100px,rgba(56,189,248,.15),transparent)] pointer-events-none"></div>
    
    <TopBar />
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 relative">
      <!-- Hero Section -->
      <div class="text-center mb-10 md:mb-14">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-black dark:text-white tracking-tight mb-4">
          Hizmet Talebi Sorgulama
        </h1>
        <p class="text-base md:text-lg text-gray-600 dark:text-gray-300">
          Talep numaranızı girerek servis durumunuzu takip edin
        </p>
      </div>

      <!-- Query Form Box -->
      <form @submit.prevent="queryServiceRequest" class="mb-10 md:mb-14">
        <div class="query-box bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-2xl transition-all duration-300 hover:shadow-neon focus-within:shadow-neon-active">
          <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
              <input 
                type="text" 
                v-model="requestNumber"
                placeholder="Talep numaranızı girin (örn: FT-2024-001)"
                class="query-input w-full px-6 py-4 text-lg rounded-xl border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/30 transition-all duration-300"
                :class="{ 'error-input': searched && !serviceRequest }"
                required
              >
            </div>
            <button 
              type="submit"
              class="px-8 py-4 text-lg font-semibold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl whitespace-nowrap"
            >
              Sorgula
            </button>
          </div>
        </div>
      </form>

      <!-- Sonuçlar -->
      <div v-if="serviceRequest" class="animate-fadeIn">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-2xl ring-1 ring-gray-200 dark:ring-gray-700">
          <h2 class="text-2xl md:text-3xl font-bold text-black dark:text-white mb-6">
            Talep Detayları
          </h2>
          <div class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
              <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Talep Numarası:</span>
              <span class="text-lg font-medium text-gray-900 dark:text-white">{{ serviceRequest.request_number }}</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
              <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Durum:</span>
              <span class="px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200">
                {{ serviceRequest.status_text }}
              </span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
              <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Hizmet Tipi:</span>
              <span class="text-lg text-gray-900 dark:text-white">{{ serviceRequest.service_type }}</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
              <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Seçenek:</span>
              <span class="text-lg text-gray-900 dark:text-white">{{ serviceRequest.service_option }}</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
              <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Oluşturulma Tarihi:</span>
              <span class="text-lg text-gray-900 dark:text-white">{{ new Date(serviceRequest.created_at).toLocaleDateString('tr-TR') }}</span>
            </div>
            <div class="flex flex-col gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
              <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Açıklama:</span>
              <p class="text-base text-gray-900 dark:text-white leading-relaxed">{{ serviceRequest.description }}</p>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row gap-4">
            <!-- WhatsApp Bilgi Al Button -->
            <a
              :href="getWhatsAppLink()"
              target="_blank"
              rel="noopener noreferrer"
              class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl"
            >
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
              </svg>
              Bilgi Al
            </a>

            <!-- Düzenle Button -->
            <button
              @click="showEditModal = true"
              class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              Düzenle
            </button>
          </div>
        </div>
      </div>

      <!-- Edit Modal -->
      <div v-if="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" @click.self="showEditModal = false">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
          <!-- Background overlay -->
          <div class="fixed inset-0 transition-opacity bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75" @click="showEditModal = false"></div>

          <!-- Modal content -->
          <div class="relative inline-block w-full max-w-2xl overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-gray-800 rounded-2xl shadow-2xl">
            <div class="p-6 md:p-8">
              <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-black dark:text-white">
                  Servis Talebini Düzenle
                </h3>
                <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>

              <form @submit.prevent="updateServiceRequest" class="space-y-6">
                <!-- Açıklama -->
                <div>
                  <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Açıklama <span class="text-red-500">*</span>
                  </label>
                  <textarea
                    v-model="editForm.description"
                    rows="4"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/30 transition-all duration-300"
                    placeholder="Sorunun detaylarını açıklayın..."
                    required
                  ></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3">
                  <button
                    type="submit"
                    class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-md"
                  >
                    Güncelle
                  </button>
                  <button
                    type="button"
                    @click="deleteServiceRequest"
                    class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-md"
                  >
                    Sil
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Hata Mesajı -->
      <div v-else-if="searched && !serviceRequest" class="animate-fadeIn">
        <div class="bg-red-50 dark:bg-red-900/20 rounded-2xl p-6 md:p-8 ring-2 ring-red-200 dark:ring-red-800/50">
          <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-red-600 dark:text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-base md:text-lg font-medium text-red-600 dark:text-red-400">
              Belirtilen talep numarasına ait bir kayıt bulunamadı.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import TopBar from '@/components/TopBar.vue';

const props = defineProps({
  serviceRequest: {
    type: Object,
    default: null,
  },
});

const requestNumber = ref(props.serviceRequest?.request_number ?? '');
const serviceRequest = ref(props.serviceRequest);
const searched = ref(!!props.serviceRequest);
const showEditModal = ref(false);
const editForm = ref({
  description: ''
});

watch(
  () => props.serviceRequest,
  (value) => {
    serviceRequest.value = value;

    if (value?.request_number) {
      requestNumber.value = value.request_number;
    }
    
    // Edit form'u güncelle
    if (value) {
      editForm.value.description = value.description || '';
    }
  }
);

// WhatsApp link oluştur
const getWhatsAppLink = () => {
  const phone = '905411191089'; // Türkiye için 90 eklendi
  const message = `Merhabalar Fast Teknik, ${serviceRequest.value?.request_number} numaralı servis talebim ile ilgili bilgi almak istiyorum.`;
  return `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
};

// Servis talebini güncelle
const updateServiceRequest = () => {
  if (!serviceRequest.value?.id) return;
  
  router.put(
    route('service-requests.update', serviceRequest.value.id),
    {
      description: editForm.value.description
    },
    {
      onSuccess: () => {
        showEditModal.value = false;
        // Sayfayı yenile
        router.reload();
      },
      onError: (errors) => {
        console.error('Güncelleme hatası:', errors);
        alert('Güncelleme sırasında bir hata oluştu.');
      }
    }
  );
};

// Servis talebini sil
const deleteServiceRequest = () => {
  if (!serviceRequest.value?.id) return;
  
  if (!confirm('Bu servis talebini silmek istediğinizden emin misiniz?')) {
    return;
  }
  
  router.delete(
    route('service-requests.destroy', serviceRequest.value.id),
    {
      onSuccess: () => {
        showEditModal.value = false;
        // Ana sayfaya yönlendir
        router.visit(route('home'));
      },
      onError: (errors) => {
        console.error('Silme hatası:', errors);
        alert('Silme sırasında bir hata oluştu.');
      }
    }
  );
};

const queryServiceRequest = () => {
  const trimmedNumber = requestNumber.value.trim();

  if (!trimmedNumber) {
    searched.value = false;
    serviceRequest.value = null;
    return;
  }

  searched.value = false;
  serviceRequest.value = null;

  router.get(
    route('service-request.query'),
    { request_number: trimmedNumber },
    {
      preserveState: true,
      preserveScroll: true,
      replace: true,
      onFinish: () => {
        searched.value = true;
      },
      onError: (errors) => {
        console.error('Sorgu hatası:', errors);
      },
    }
  );
};
</script>

<style scoped>
/* Neon Shadow Effects */
.shadow-neon {
  box-shadow: 
    0 10px 30px rgba(59, 130, 246, 0.2),
    0 0 20px rgba(59, 130, 246, 0.1);
}

.shadow-neon-active {
  box-shadow: 
    0 15px 40px rgba(59, 130, 246, 0.3),
    0 0 30px rgba(59, 130, 246, 0.2),
    inset 0 0 20px rgba(59, 130, 246, 0.05);
}

:global(.dark) .shadow-neon {
  box-shadow: 
    0 10px 30px rgba(96, 165, 250, 0.3),
    0 0 25px rgba(96, 165, 250, 0.15);
}

:global(.dark) .shadow-neon-active {
  box-shadow: 
    0 15px 40px rgba(96, 165, 250, 0.4),
    0 0 35px rgba(96, 165, 250, 0.25),
    inset 0 0 25px rgba(96, 165, 250, 0.08);
}

/* Query Box Hover Effect */
.query-box {
  transform: translateY(0);
}

.query-box:hover {
  transform: translateY(-4px);
}

.query-box:focus-within {
  transform: translateY(-6px);
}

/* Error Input - Dark mode'da yazı rengini korur, sadece border ve underline kırmızı */
.error-input {
  border-color: rgb(239, 68, 68) !important;
  box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
  text-decoration: underline;
  text-decoration-color: rgb(239, 68, 68);
  text-decoration-thickness: 2px;
  text-underline-offset: 4px;
}

:global(.dark) .error-input {
  border-color: rgb(248, 113, 113) !important;
  box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.15) !important;
  text-decoration-color: rgb(248, 113, 113);
  /* Yazı rengi korunur, siyah yapılmaz */
  color: white !important;
}

/* Fade-in animation */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fadeIn {
  animation: fadeIn 0.5s ease-out;
}
</style> 
