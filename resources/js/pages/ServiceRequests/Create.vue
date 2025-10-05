<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16 pb-24 relative">
    <!-- Radial Gradient Background -->
    <div class="absolute inset-0 bg-[radial-gradient(1200px_600px_at_50%_-100px,rgba(56,189,248,.12),transparent)] pointer-events-none"></div>
    
    <TopBar />
    <SEO
      title="Hizmet Talebi Formu | Fast Teknik"
      description="Fast Teknik hizmet talebi oluşturma formu. Bilgilerinizi girin ve hizmet talebinizi kolayca oluşturun."
    />
    
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
          <div class="rounded-2xl bg-white/80 dark:bg-white/6 ring-1 ring-gray-200 dark:ring-white/10 backdrop-blur p-6 md:p-8">
            <form @submit.prevent="handleSubmit" :aria-busy="form.processing">
              <!-- Step 1: İletişim Bilgileri -->
              <div v-show="currentStep === 0" class="space-y-6">
                <div>
                  <h3 class="mb-2 text-sm font-semibold text-gray-900 dark:text-slate-200">İletişim Bilgileri</h3>
                  <div class="h-px bg-gray-200 dark:bg-white/10 mb-6"></div>

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
                      <div class="flex gap-3">
                        <select 
                          v-model="countryCode"
                          @change="updateFullPhone"
                          class="form-input form-select"
                          style="width: 35%;"
                          :class="{ 'ring-red-500/60': form.errors.phone }"
                        >
                          <option value="+90">🇹🇷 +90</option>
                          <option value="+1">🇺🇸 +1</option>
                          <option value="+44">🇬🇧 +44</option>
                          <option value="+49">🇩🇪 +49</option>
                          <option value="+33">🇫🇷 +33</option>
                          <option value="+7">🇷🇺 +7</option>
                          <option value="+86">🇨🇳 +86</option>
                          <option value="+81">🇯🇵 +81</option>
                          <option value="+82">🇰🇷 +82</option>
                          <option value="+91">🇮🇳 +91</option>
                          <option value="+966">🇸🇦 +966</option>
                          <option value="+971">🇦🇪 +971</option>
                        </select>
                        <input 
                          id="phone"
                          type="tel" 
                          v-model="phoneNumber"
                          @input="updateFullPhone"
                          autocomplete="tel"
                          placeholder="(545) 123 45 67"
                          :aria-invalid="!!form.errors.phone"
                          :aria-describedby="form.errors.phone ? 'phone-error' : undefined"
                          @blur="validateField('phone')"
                          class="form-input"
                          style="width: calc(65% - 0.75rem);"
                          :class="{ 'ring-red-500/60': form.errors.phone }"
                          required
                        >
                      </div>
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
                  <h3 class="mb-2 text-sm font-semibold text-gray-900 dark:text-slate-200">Adres Bilgileri</h3>
                  <div class="h-px bg-gray-200 dark:bg-white/10 mb-6"></div>

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
                        class="form-input bg-gray-100 dark:bg-white/5 text-gray-900 dark:text-white"
                        disabled
                      >
                    </div>
                  </div>
                </div>
              </div>

              <!-- Step 3: Hizmet Detayı -->
              <div v-show="currentStep === 2" class="space-y-6">
                <div>
                  <h3 class="mb-2 text-sm font-semibold text-gray-900 dark:text-slate-200">Talep Detayları</h3>
                  <div class="h-px bg-gray-200 dark:bg-white/10 mb-6"></div>

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
                      <select id="product" v-model="form.product_id" class="form-input form-select">
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
                  <h3 class="mb-2 text-sm font-semibold text-gray-900 dark:text-slate-200">Bilgileri Onaylayın</h3>
                  <div class="h-px bg-gray-200 dark:bg-white/10 mb-6"></div>

                  <!-- Important Warning for Request Number -->
                  <div class="mb-6 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 border-2 border-amber-400 dark:border-amber-600/50 rounded-xl p-4 shadow-md">
                    <div class="flex items-start gap-3">
                      <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-amber-600 dark:text-amber-400 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                      </div>
                      <div class="flex-1">
                        <p class="text-base font-bold text-amber-900 dark:text-amber-200 mb-1">
                          ⚠️ Önemli Uyarı!
                        </p>
                        <p class="text-sm text-amber-800 dark:text-amber-300 font-semibold leading-relaxed">
                          Talebiniz oluşturulduktan sonra size bir <span class="font-bold underline decoration-amber-600 dark:decoration-amber-400">hizmet talep numarası</span> verilecektir. Lütfen bu numarayı kaydedin! Servis talebinizin durumunu sorgulamak için bu numaraya ihtiyacınız olacak.
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="space-y-4 text-sm">
                    <div class="bg-gray-100 dark:bg-white/5 rounded-xl p-4 space-y-3">
                      <div class="flex gap-2">
                        <span class="text-gray-600 dark:text-gray-400">Ad Soyad:</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ form.name }}</span>
                      </div>
                      <div class="flex gap-2">
                        <span class="text-gray-600 dark:text-gray-400">Email:</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ form.email }}</span>
                      </div>
                      <div class="flex gap-2">
                        <span class="text-gray-600 dark:text-gray-400">Telefon:</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ form.phone }}</span>
                      </div>
                      <div class="flex gap-2">
                        <span class="text-gray-600 dark:text-gray-400">Hizmet:</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ selectedService?.title }}</span>
                      </div>
                      <div class="flex gap-2">
                        <span class="text-gray-600 dark:text-gray-400">Seçenek:</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ selectedOption?.label }}</span>
                      </div>
                      <div v-if="selectedProduct" class="flex gap-2">
                        <span class="text-gray-600 dark:text-gray-400">Ürün:</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ selectedProduct?.name }}</span>
                      </div>
                      <div class="flex gap-2">
                        <span class="text-gray-600 dark:text-gray-400">Adres:</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ form.address }}, {{ form.district }}</span>
                      </div>
                    </div>

                    <!-- Trust Badges -->
                    <div class="flex flex-wrap gap-2 pt-4">
                      <span class="rounded-full text-xs px-2.5 py-1 bg-emerald-100 dark:bg-emerald-400/10 text-emerald-700 dark:text-emerald-300 ring-1 ring-emerald-300/40 dark:ring-emerald-300/20">
                        Aynı Gün Keşif
                      </span>
                      <span class="rounded-full text-xs px-2.5 py-1 bg-emerald-100 dark:bg-emerald-400/10 text-emerald-700 dark:text-emerald-300 ring-1 ring-emerald-300/40 dark:ring-emerald-300/20">
                        2 Yıl İşçilik Garantisi
                      </span>
                      <span class="rounded-full text-xs px-2.5 py-1 bg-emerald-100 dark:bg-emerald-400/10 text-emerald-700 dark:text-emerald-300 ring-1 ring-emerald-300/40 dark:ring-emerald-300/20">
                        Profesyonel Hizmet
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Navigation Buttons (Desktop) -->
              <div class="hidden md:flex items-center justify-between mt-8 pt-6 border-t border-gray-200 dark:border-white/10">
                <button
                  v-if="currentStep > 0"
                  type="button"
                  @click="prevStep"
                  class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors"
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
                  class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors"
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
          <div class="sticky top-20 rounded-2xl bg-white/80 dark:bg-white/6 ring-1 ring-gray-200 dark:ring-white/10 backdrop-blur p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Seçiminiz</h3>
            
            <div class="space-y-4">
              <div class="flex items-start gap-3">
                <component :is="selectedService?.icon" class="w-8 h-8 text-blue-600 dark:text-blue-400 flex-shrink-0" />
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900 dark:text-white">{{ selectedService?.title }}</p>
                  <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ selectedOption?.label }}</p>
                </div>
              </div>

              <div class="h-px bg-gray-200 dark:bg-white/10"></div>

              <div class="space-y-2 text-sm">
                <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                  <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Tahmini Süre: 2-3 saat
                </div>
                <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                  <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  Randevu: 24 saat içinde
                </div>
                <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                  <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Ücretsiz Keşif
                </div>
              </div>

              <div class="h-px bg-gray-200 dark:bg-white/10"></div>

              <div class="bg-blue-100 dark:bg-blue-500/10 rounded-lg p-3">
                <p class="text-xs text-blue-700 dark:text-blue-300">
                  ℹ️ Talebiniz alındıktan sonra aynı gün içerisinde size dönüş yapılacaktır.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Selection Summary (Mobile only) -->
      <div class="lg:hidden mt-8 rounded-2xl bg-white/80 dark:bg-white/6 ring-1 ring-gray-200 dark:ring-white/10 backdrop-blur p-5">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-3">Seçiminiz</h3>
        
        <div class="space-y-3">
          <div class="flex items-start gap-3">
            <component :is="selectedService?.icon" class="w-8 h-8 text-blue-600 dark:text-blue-400 flex-shrink-0" />
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-900 dark:text-white">{{ selectedService?.title }}</p>
              <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ selectedOption?.label }}</p>
            </div>
          </div>

          <div class="h-px bg-gray-200 dark:bg-white/10"></div>

          <div class="space-y-2 text-xs">
            <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
              <svg class="w-4 h-4 text-blue-600 dark:text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Tahmini Süre: 2-3 saat
            </div>
            <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
              <svg class="w-4 h-4 text-blue-600 dark:text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              Randevu: 24 saat içinde
            </div>
            <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
              <svg class="w-4 h-4 text-blue-600 dark:text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Ücretsiz Keşif
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Sticky Mobile CTA -->
    <div class="md:hidden fixed bottom-3 inset-x-0 mx-3 rounded-2xl bg-white/90 dark:bg-white/10 backdrop-blur p-2 ring-1 ring-gray-300 dark:ring-white/15 z-50">
      <div class="flex items-center gap-2">
        <button
          v-if="currentStep > 0"
          type="button"
          @click="prevStep"
          class="flex-shrink-0 px-4 py-2 text-sm font-medium text-gray-700 dark:text-white"
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

    <!-- Success Modal for Guest Users -->
    <div v-if="showSuccessModal && !$page.props.auth.user" class="fixed inset-0 z-50 overflow-y-auto" @click.self="closeSuccessModal">
      <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-900/80 backdrop-blur-sm" @click="closeSuccessModal"></div>

        <!-- Modal content -->
        <div class="relative w-full max-w-md transform transition-all animate-fadeIn">
          <div class="relative bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-gray-900 rounded-3xl shadow-2xl ring-2 ring-blue-500/20 dark:ring-blue-400/30 overflow-hidden">
            <!-- Success Icon Header -->
            <div class="relative bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 px-6 py-8 text-center">
              <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full mb-4 ring-4 ring-white/30">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-white mb-2">
                Talebiniz Oluşturuldu!
              </h3>
              <p class="text-blue-100 text-sm">
                En kısa sürede sizinle iletişime geçeceğiz
              </p>
            </div>

            <!-- Request Number Section -->
            <div class="px-6 py-8">
              <div class="bg-gradient-to-br from-blue-500/10 to-blue-600/10 dark:from-blue-400/10 dark:to-blue-500/10 rounded-2xl p-6 border-2 border-blue-500/30 dark:border-blue-400/30 mb-6">
                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 text-center mb-3 uppercase tracking-wide">
                  Talep Numaranız
                </p>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-lg">
                  <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 text-center font-mono tracking-wider">
                    {{ successData?.request_number }}
                  </p>
                </div>
              </div>

              <!-- Important Message -->
              <div class="bg-amber-50 dark:bg-amber-900/20 border-2 border-amber-200 dark:border-amber-700/50 rounded-xl p-4 mb-6">
                <div class="flex items-start gap-3">
                  <svg class="w-6 h-6 text-amber-600 dark:text-amber-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                  </svg>
                  <div class="flex-1">
                    <p class="text-sm font-semibold text-amber-900 dark:text-amber-200 mb-1">
                      Önemli!
                    </p>
                    <p class="text-sm text-amber-800 dark:text-amber-300 leading-relaxed">
                      Lütfen bu talep numarasını kaydedin. Servis talebinizin durumunu sorgulamak için bu numaraya ihtiyacınız olacak.
                    </p>
                  </div>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="flex flex-col gap-3">
                <button
                  @click="copyRequestNumber"
                  class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl"
                >
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                  </svg>
                  {{ copyButtonText }}
                </button>
                <button
                  @click="closeSuccessModal"
                  class="w-full px-6 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-xl transition-all duration-300"
                >
                  Anladım
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { CameraIcon, WifiIcon, GlobeAltIcon } from '@heroicons/vue/24/outline';
import { computed, ref, watch } from 'vue';
import TopBar from '@/components/TopBar.vue';
import SEO from '@/components/SEO.vue';

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
const countryCode = ref('+90');
const phoneNumber = ref('');

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

// Initialize phone number from userData if exists
if (props.userData.phone) {
  // Extract country code and number
  const phoneMatch = props.userData.phone.match(/^(\+\d+)\s*(.*)$/);
  if (phoneMatch) {
    countryCode.value = phoneMatch[1];
    phoneNumber.value = phoneMatch[2];
  } else {
    phoneNumber.value = props.userData.phone;
  }
}

const updateFullPhone = () => {
  form.phone = `${countryCode.value} ${phoneNumber.value}`.trim();
};

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

// Success modal state
const page = usePage();
const showSuccessModal = ref(false);
const successData = ref(null);
const copyButtonText = ref('Numarayı Kopyala');

// Watch for flash success message
watch(() => page.props.flash?.success, (value) => {
  if (value && !page.props.auth.user) {
    successData.value = value;
    showSuccessModal.value = true;
  }
}, { immediate: true });

const closeSuccessModal = () => {
  showSuccessModal.value = false;
  successData.value = null;
};

const copyRequestNumber = async () => {
  if (!successData.value?.request_number) return;
  
  try {
    await navigator.clipboard.writeText(successData.value.request_number);
    copyButtonText.value = '✓ Kopyalandı!';
    setTimeout(() => {
      copyButtonText.value = 'Numarayı Kopyala';
    }, 2000);
  } catch (err) {
    console.error('Kopyalama hatası:', err);
    // Fallback for older browsers
    const textarea = document.createElement('textarea');
    textarea.value = successData.value.request_number;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
    copyButtonText.value = '✓ Kopyalandı!';
    setTimeout(() => {
      copyButtonText.value = 'Numarayı Kopyala';
    }, 2000);
  }
};

const handleSubmit = () => {
  form.post(route('service-requests.store'), {
    onSuccess: () => {
      form.reset();
      // Modal will be shown by the watcher when flash message is received
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
  padding: 0.625rem 1rem;
  outline: none;
  transition: all 0.2s;
}

/* Light mode styles */
.form-input {
  background-color: rgba(0, 0, 0, 0.05);
  color: rgb(17, 24, 39); /* gray-900 */
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1) inset;
}

.form-input::placeholder {
  color: rgb(156, 163, 175); /* gray-400 */
}

.form-input:focus {
  box-shadow: 0 0 0 2px rgb(59, 130, 246) inset;
}

/* Dark mode styles */
:global(.dark) .form-input {
  background-color: rgba(255, 255, 255, 0.05);
  color: rgb(255, 255, 255) !important;
  box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
  -webkit-text-fill-color: rgb(255, 255, 255) !important;
}

:global(.dark) .form-input::placeholder {
  color: rgb(209, 213, 219); /* gray-300 - daha açık */
  -webkit-text-fill-color: rgb(209, 213, 219);
}

/* Light mode autofill override - sarı arka planı kaldır */
.form-input:-webkit-autofill,
.form-input:-webkit-autofill:hover,
.form-input:-webkit-autofill:focus {
  -webkit-text-fill-color: rgb(17, 24, 39) !important; /* Koyu yazı */
  -webkit-box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.05) inset !important; /* Light mode arka plan */
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1) inset !important;
  transition: background-color 5000s ease-in-out 0s; /* Sarı rengi geciktir */
}

/* Dark mode autofill override */
:global(.dark) .form-input:-webkit-autofill,
:global(.dark) .form-input:-webkit-autofill:hover,
:global(.dark) .form-input:-webkit-autofill:focus {
  -webkit-text-fill-color: rgb(255, 255, 255) !important;
  -webkit-box-shadow: 0 0 0 1000px rgba(255, 255, 255, 0.05) inset !important;
  box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.1) inset !important;
  transition: background-color 5000s ease-in-out 0s;
}

.form-input:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Validation error durumunda da yazı rengini koru */
.form-input:invalid {
  color: rgb(17, 24, 39) !important; /* Light mode için */
}

:global(.dark) .form-input:invalid {
  color: rgb(255, 255, 255) !important; /* Dark mode için */
  -webkit-text-fill-color: rgb(255, 255, 255) !important;
}

/* Browser'ın native validation stillerini override et */
.form-input:user-invalid {
  color: rgb(17, 24, 39) !important;
}

:global(.dark) .form-input:user-invalid {
  color: rgb(255, 255, 255) !important;
  -webkit-text-fill-color: rgb(255, 255, 255) !important;
}

/* Select element specific styles */
.form-select {
  appearance: none;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
  background-position: right 0.5rem center;
  background-repeat: no-repeat;
  background-size: 1.5em 1.5em;
  padding-right: 2.5rem;
}

:global(.dark) .form-select {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
}

/* Option elements */
.form-select option {
  background-color: white;
  color: rgb(17, 24, 39);
}

:global(.dark) .form-select option {
  background-color: rgb(17, 24, 39);
  color: white;
}

/* Fade-in animation for success modal */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: scale(0.9);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.animate-fadeIn {
  animation: fadeIn 0.3s ease-out;
}
</style>
