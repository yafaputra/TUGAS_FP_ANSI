<template>
  <div>
    <Header />
    <router-view />
    <Footer />
  </div>
</template>

<script setup>
import Header from '@/components/layouts/TheHeader.vue'
import Footer from '@/components/layouts/TheFooter.vue'
</script>
