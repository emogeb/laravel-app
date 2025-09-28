<template>
  <div class="container mx-auto py-10 max-w-2xl">
    <h1 class="text-2xl font-bold mb-6 text-blue-700 dark:text-blue-400">Yeni Ürün Ekle</h1>
    <form @submit.prevent="submitForm" enctype="multipart/form-data" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
      <div>
        <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Ürün Fotoğrafı</label>
        <input type="file" @change="onFileChange" accept="image/*" class="block w-full border border-gray-300 rounded-lg p-3 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
        <div v-if="errors.photo" class="text-red-500 text-sm mt-1">{{ errors.photo }}</div>
        <div v-if="fileError" class="text-red-500 text-sm mt-1">{{ fileError }}</div>
      </div>
      <div>
        <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Kategori</label>
        <select v-model="form.category" class="block w-full border border-gray-300 rounded-lg p-3 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
          <option value="">Kategori Seçiniz</option>
          <option value="kamera">Kamera</option>
          <option value="internet">İnternet</option>
          <option value="çanak anten">Çanak Anten</option>
        </select>
        <div v-if="errors.category" class="text-red-500 text-sm mt-1">{{ errors.category }}</div>
      </div>
      <div>
        <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Ürün İsmi</label>
        <input v-model="form.name" type="text" class="block w-full border border-gray-300 rounded-lg p-3 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required />
        <div v-if="errors.name" class="text-red-500 text-sm mt-1">{{ errors.name }}</div>
      </div>
      <div>
        <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Açıklama</label>
        <textarea v-model="form.description" class="block w-full border border-gray-300 rounded-lg p-3 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none" rows="4" required></textarea>
        <div v-if="errors.description" class="text-red-500 text-sm mt-1">{{ errors.description }}</div>
      </div>
      <div class="flex gap-4">
        <div class="flex-1">
          <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Fiyat (₺)</label>
          <input v-model="form.price" type="number" step="0.01" class="block w-full border border-gray-300 rounded-lg p-3 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required />
          <div v-if="errors.price" class="text-red-500 text-sm mt-1">{{ errors.price }}</div>
        </div>
        <div class="flex-1">
          <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Stok Adedi</label>
          <input v-model="form.stock" type="number" class="block w-full border border-gray-300 rounded-lg p-3 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required />
          <div v-if="errors.stock" class="text-red-500 text-sm mt-1">{{ errors.stock }}</div>
        </div>
      </div>
      <div>
        <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Ürün Özellikleri</label>
        <div class="space-y-3">
          <div v-for="(feature, idx) in form.features" :key="idx" class="flex gap-3 items-center">
            <input v-model="feature.name" type="text" placeholder="Özellik" class="flex-1 border border-gray-300 rounded-lg p-3 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
            <input v-model="feature.value" type="text" placeholder="Var/Yok veya Değer" class="flex-1 border border-gray-300 rounded-lg p-3 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
            <button type="button" @click="addFeatureRow" v-if="idx === form.features.length - 1" class="px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">Satır Ekle</button>
            <button type="button" @click="removeFeatureRow(idx)" v-if="form.features.length > 1" class="px-3 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">Sil</button>
          </div>
        </div>
        <div v-if="errors.features" class="text-red-500 text-sm mt-1">{{ errors.features }}</div>
      </div>
      <button type="submit" :disabled="isLoading" class="w-full py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors text-lg shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
        <span v-if="isLoading">Kaydediliyor...</span>
        <span v-else>Ürünü Kaydet</span>
      </button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const form = ref({
  photo: null,
  category: '',
  name: '',
  description: '',
  price: '',
  stock: '',
  features: [ { name: '', value: '' } ]
});

const isLoading = ref(false);
const errors = ref({});
const fileError = ref('');

function onFileChange(e) {
  const file = e.target.files[0];
  fileError.value = '';
  
  if (!file) {
    form.value.photo = null;
    return;
  }
  
  // Dosya türü kontrolü
  const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
  if (!allowedTypes.includes(file.type)) {
    fileError.value = 'Sadece JPEG, PNG, JPG ve GIF dosyaları kabul edilir.';
    form.value.photo = null;
    return;
  }
  
  // Dosya boyutu kontrolü (2MB)
  if (file.size > 2 * 1024 * 1024) {
    fileError.value = 'Dosya boyutu 2MB\'dan küçük olmalıdır.';
    form.value.photo = null;
    return;
  }
  
  form.value.photo = file;
}

function addFeatureRow() {
  form.value.features.push({ name: '', value: '' });
}

function removeFeatureRow(idx) {
  if (form.value.features.length > 1) {
    form.value.features.splice(idx, 1);
  }
}

function validateForm() {
  errors.value = {};
  
  if (!form.value.photo) {
    errors.value.photo = 'Ürün fotoğrafı gereklidir.';
  }
  
  if (!form.value.category) {
    errors.value.category = 'Kategori seçimi gereklidir.';
  }
  
  if (!form.value.name || form.value.name.length < 2) {
    errors.value.name = 'Ürün ismi en az 2 karakter olmalıdır.';
  }
  
  if (!form.value.description || form.value.description.length < 10) {
    errors.value.description = 'Açıklama en az 10 karakter olmalıdır.';
  }
  
  if (!form.value.price || form.value.price <= 0) {
    errors.value.price = 'Geçerli bir fiyat giriniz.';
  }
  
  if (!form.value.stock || form.value.stock < 0) {
    errors.value.stock = 'Geçerli bir stok adedi giriniz.';
  }
  
  // Features validation
  const hasValidFeatures = form.value.features.some(feature => 
    feature.name.trim() && feature.value.trim()
  );
  
  if (!hasValidFeatures) {
    errors.value.features = 'En az bir ürün özelliği eklemelisiniz.';
  }
  
  return Object.keys(errors.value).length === 0;
}

function submitForm() {
  if (!validateForm()) {
    return;
  }
  
  isLoading.value = true;
  errors.value = {};
  
  const data = new FormData();
  data.append('photo', form.value.photo);
  data.append('category', form.value.category);
  data.append('name', form.value.name);
  data.append('description', form.value.description);
  data.append('price', form.value.price);
  data.append('stock', form.value.stock);
  data.append('features', JSON.stringify(form.value.features));
  
  router.post(route('admin.products.store'), data, {
    onSuccess: () => {
      isLoading.value = false;
    },
    onError: (errs) => {
      errors.value = errs;
      isLoading.value = false;
    },
    onFinish: () => {
      isLoading.value = false;
    }
  });
}
</script> 