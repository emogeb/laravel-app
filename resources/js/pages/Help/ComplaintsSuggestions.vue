<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16">
    <SEO
      title="Şikayet ve Öneri | Türk Teknik İzmir"
      description="Türk Teknik şikayet ve öneri formu. Hizmetlerimiz hakkında geri bildirimlerinizi bizimle paylaşın."
      keywords="şikayet, öneri, geri bildirim, müşteri hizmetleri, türk teknik"
      url="http://fast-teknik.test/yardim/sikayet-ve-oneri"
    />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="max-w-4xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-12">
          <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
            Şikayet ve Öneri
          </h1>
          <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
            Hizmetlerimiz hakkında görüşlerinizi bizimle paylaşın. Geri bildirimleriniz bizim için çok değerli.
          </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
          <!-- Contact Form -->
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Geri Bildirim Formu</h2>
            <form @submit.prevent="submitFeedback" class="space-y-6">
              <div>
                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tür</label>
                <select 
                  id="type" 
                  v-model="form.type"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                  required
                >
                  <option value="">Seçiniz</option>
                  <option value="complaint">Şikayet</option>
                  <option value="suggestion">Öneri</option>
                  <option value="compliment">Övgü</option>
                  <option value="other">Diğer</option>
                </select>
              </div>

              <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ad Soyad</label>
                <input 
                  type="text" 
                  id="name" 
                  v-model="form.name"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                  placeholder="Adınız ve soyadınız"
                  required
                >
              </div>

              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">E-posta</label>
                <input 
                  type="email" 
                  id="email" 
                  v-model="form.email"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                  placeholder="ornek@email.com"
                  required
                >
              </div>

              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Telefon</label>
                <input 
                  type="tel" 
                  id="phone" 
                  v-model="form.phone"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                  placeholder="+90 5XX XXX XX XX"
                >
              </div>

              <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Konu</label>
                <input 
                  type="text" 
                  id="subject" 
                  v-model="form.subject"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                  placeholder="Konu başlığı"
                  required
                >
              </div>

              <div>
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Mesaj</label>
                <textarea 
                  id="message" 
                  v-model="form.message"
                  rows="5"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                  placeholder="Detaylı açıklama yazın..."
                  required
                ></textarea>
              </div>

              <div class="flex items-start space-x-3">
                <input 
                  type="checkbox" 
                  id="privacy" 
                  v-model="form.privacyAccepted"
                  class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                  required
                >
                <label for="privacy" class="text-sm text-gray-600 dark:text-gray-300">
                  <Link :href="route('info.kvkk')" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                    KVKK Aydınlatma Metni
                  </Link>'ni okudum ve kişisel verilerimin işlenmesine onay veriyorum.
                </label>
              </div>

              <button 
                type="submit"
                :disabled="form.processing"
                class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 font-semibold disabled:opacity-50"
              >
                {{ form.processing ? 'Gönderiliyor...' : 'Gönder' }}
              </button>
            </form>
          </div>

          <!-- Information -->
          <div class="space-y-8">
            <!-- Contact Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">İletişim Bilgileri</h2>
              <div class="space-y-4">
                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Telefon</h3>
                    <p class="text-gray-600 dark:text-gray-300">+90 546 911 80 61</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">7/24 Hizmet</p>
                  </div>
                </div>

                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">E-posta</h3>
                    <p class="text-gray-600 dark:text-gray-300">info@turkteknik.com</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">24 saat içinde yanıt</p>
                  </div>
                </div>

                <div class="flex items-start space-x-4">
                  <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Adres</h3>
                    <p class="text-gray-600 dark:text-gray-300">İzmir, Türkiye</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tüm İzmir ve çevresine hizmet</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Response Times -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Yanıt Süreleri</h2>
              <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                  <span class="text-gray-600 dark:text-gray-300">Şikayetler</span>
                  <span class="font-semibold text-gray-900 dark:text-white">24 saat</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                  <span class="text-gray-600 dark:text-gray-300">Öneriler</span>
                  <span class="font-semibold text-gray-900 dark:text-white">48 saat</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                  <span class="text-gray-600 dark:text-gray-300">Genel Sorular</span>
                  <span class="font-semibold text-gray-900 dark:text-white">12 saat</span>
                </div>
                <div class="flex justify-between items-center py-2">
                  <span class="text-gray-600 dark:text-gray-300">Acil Durumlar</span>
                  <span class="font-semibold text-gray-900 dark:text-white">2 saat</span>
                </div>
              </div>
            </div>

            <!-- FAQ -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Sık Sorulan Sorular</h2>
              <div class="space-y-4">
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Şikayetim ne zaman yanıtlanır?</h3>
                  <p class="text-gray-600 dark:text-gray-300 text-sm">Şikayetleriniz 24 saat içinde yanıtlanır ve gerekli işlemler başlatılır.</p>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Anonim şikayet yapabilir miyim?</h3>
                  <p class="text-gray-600 dark:text-gray-300 text-sm">Evet, ancak anonim şikayetlerde takip yapamayız. İletişim bilgilerinizi paylaşmanızı öneririz.</p>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Önerilerim nasıl değerlendirilir?</h3>
                  <p class="text-gray-600 dark:text-gray-300 text-sm">Tüm öneriler değerlendirilir ve uygulanabilir olanlar hizmetlerimize yansıtılır.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import SEO from '@/components/SEO.vue';

const form = useForm({
  type: '',
  name: '',
  email: '',
  phone: '',
  subject: '',
  message: '',
  privacyAccepted: false
});

const submitFeedback = () => {
  form.post(route('help.feedback.submit'), {
    onSuccess: () => {
      form.reset();
      alert('Geri bildiriminiz başarıyla gönderildi! En kısa sürede size dönüş yapacağız.');
    },
    onError: () => {
      alert('Geri bildirim gönderilirken bir hata oluştu. Lütfen tekrar deneyin.');
    }
  });
};
</script>
