<template>
  <nav class="fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-md z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <!-- Logo veya Site Adı -->
          <Link :href="route('home')" class="flex-shrink-0 text-xl font-bold text-gray-900 dark:text-white">
            Fast Teknik
          </Link>
          <!-- Ana Navigasyon Linkleri - Desktop -->
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

        <!-- Desktop - Üyelik Girişi/Kayıt Ol -->
        <div class="hidden md:flex items-center space-x-4">
          <div v-if="$page.props.auth.user" class="flex items-center space-x-4">
            <!-- Kullanıcı Adı/Bilgisi -->
            <Link :href="route('profile')" class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 transition-colors duration-200">
              <div class="relative">
                <img v-if="$page.props.auth.user.profile_picture" :src="$page.props.auth.user.profile_picture" alt="Profile" class="h-8 w-8 rounded-full object-cover border-2 border-blue-500 dark:border-blue-400">
                <div v-else class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold text-sm">
                  {{ $page.props.auth.user.name.charAt(0) }}
                </div>
              </div>
              <span class="hidden lg:inline">{{ $page.props.auth.user.name }}</span>
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

        <!-- Mobile Menu Button -->
        <div class="md:hidden flex items-center">
          <button @click="toggleMobileMenu" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
            <span class="sr-only">Ana menüyü aç</span>
            <!-- Hamburger Icon -->
            <svg v-if="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <!-- Close Icon -->
            <svg v-else class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div v-show="mobileMenuOpen" class="md:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white dark:bg-gray-800 shadow-lg">
        <!-- Navigation Links -->
        <Link :href="route('home')" @click="closeMobileMenu" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 block px-3 py-2 rounded-md text-base font-medium">
          Ana Sayfa
        </Link>
        <Link :href="route('services.index')" @click="closeMobileMenu" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 block px-3 py-2 rounded-md text-base font-medium">
          Hizmetler
        </Link>
        <Link :href="route('service-request')" @click="closeMobileMenu" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 block px-3 py-2 rounded-md text-base font-medium">
          Servis Talebi
        </Link>
        <Link :href="route('internet-speed-test')" @click="closeMobileMenu" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 block px-3 py-2 rounded-md text-base font-medium">
          Hız Testi
        </Link>
        
        <!-- Mobile Auth Section -->
        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
          <div v-if="$page.props.auth.user" class="space-y-1">
            <!-- User Profile -->
            <Link :href="route('profile')" @click="closeMobileMenu" class="flex items-center px-3 py-2 rounded-md text-base font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
              <div class="flex-shrink-0 mr-3">
                <img v-if="$page.props.auth.user.profile_picture" :src="$page.props.auth.user.profile_picture" alt="Profile" class="h-8 w-8 rounded-full object-cover border-2 border-blue-500 dark:border-blue-400">
                <div v-else class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold text-sm">
                  {{ $page.props.auth.user.name.charAt(0) }}
                </div>
              </div>
              <div>
                <div class="text-base font-medium">{{ $page.props.auth.user.name }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Profili Görüntüle</div>
              </div>
            </Link>
            <!-- Logout -->
            <Link :href="route('logout')" method="post" as="button" @click="closeMobileMenu" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300">
              Çıkış Yap
            </Link>
          </div>
          <div v-else class="space-y-1">
            <!-- Login -->
            <Link :href="route('login')" @click="closeMobileMenu" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">
              Giriş Yap
            </Link>
            <!-- Register -->
            <Link :href="route('register')" @click="closeMobileMenu" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-blue-600 hover:bg-blue-700">
              Kayıt Ol
            </Link>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

// Mobile menu state
const mobileMenuOpen = ref(false);

// Toggle mobile menu
const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value;
};

// Close mobile menu
const closeMobileMenu = () => {
  mobileMenuOpen.value = false;
};
</script> 