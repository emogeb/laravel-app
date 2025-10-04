<template>
  <Head>
    <title>{{ title }}</title>
    <meta name="description" :content="description">
    <meta v-if="keywords" name="keywords" :content="keywords">
    <meta property="og:title" :content="title">
    <meta property="og:description" :content="description">
    <meta property="og:type" content="website">
    <meta property="og:url" :content="canonicalUrl">
    <meta property="og:image" :content="ogImage">
    <meta property="og:locale" content="tr_TR">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" :content="title">
    <meta name="twitter:description" :content="description">
    <meta name="twitter:image" :content="ogImage">
    <link rel="canonical" :href="canonicalUrl">
  </Head>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';

import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  },
  keywords: {
    type: String,
    required: false,
    default: ''
  },
  url: {
    type: String,
    required: false,
    default: ''
  },
  image: {
    type: String,
    default: '/images/og-image.jpg'
  }
});

const page = usePage();
const baseUrl = computed(() => page.props.appUrl || window.location.origin);
const canonicalUrl = computed(() => props.url || `${baseUrl.value}${window.location.pathname}`);
const ogImage = computed(() => props.image.startsWith('http') ? props.image : `${baseUrl.value}${props.image}`);
</script> 