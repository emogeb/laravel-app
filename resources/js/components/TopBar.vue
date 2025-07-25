<template>
  <nav class="fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-md z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <!-- Logo veya Site Adı -->
          <Link :href="route('home')" class="flex-shrink-0 text-xl font-bold text-gray-900 dark:text-white">
            Fast Teknik
          </Link>
          <!-- Ana Navigasyon Linkleri -->
          <div class="hidden md:block ml-10 space-x-4">
            <Link :href="route('home')" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-md text-sm font-medium">
              Ana Sayfa
            </Link>
            <Link :href="route('services.index')" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-md text-sm font-medium">
              Hizmetler
            </Link>
            <Link :href="route('service-request')" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-md text-sm font-medium">
              Servis Talebi
            </Link>
            <Link :href="route('internet-speed-test')" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-md text-sm font-medium">
              Hız Testi
            </Link>
          </div>
        </div>

        <!-- Üyelik Girişi/Kayıt Ol (Sağ Üst) -->
        <div class="hidden md:block">
          <div v-if="$page.props.auth.user" class="flex items-center space-x-4">
            <!-- Kullanıcı Adı/Bilgisi -->
            <Link :href="route('profile')" class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 transition-colors duration-200">
              <div class="relative">
                <img v-if="$page.props.auth.user.profile_picture" :src="$page.props.auth.user.profile_picture" alt="Profile" class="h-8 w-8 rounded-full object-cover border-2 border-blue-500 dark:border-blue-400">
                <div v-else class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold text-sm">
                  {{ $page.props.auth.user.name.charAt(0) }}
                </div>
              </div>
              <span class="hidden md:inline">{{ $page.props.auth.user.name }}</span>
            </Link>
            <!-- Çıkış Yap -->
            <Link :href="route('logout')" method="post" as="button" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300 px-3 py-2 rounded-md text-sm font-medium">
              Çıkış Yap
            </Link>
          </div>
          <div v-else class="flex items-center space-x-4">
            <!-- Giriş Yap -->
            <Link :href="route('login')" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 px-3 py-2 rounded-md text-sm font-medium">
              Giriş Yap
            </Link>
            <!-- Kayıt Ol -->
            <Link :href="route('register')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 shadow-sm">
              Kayıt Ol
            </Link>
          </div>
        </div>

        <!-- Mobil Menü Butonu (İsteğe bağlı olarak eklenebilir) -->
        <!-- Şu an için sadece desktop görünümü odaklı -->
      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
// Mobile menu toggle logic can be added here if needed
</script> 