<template>
    <div class="flex items-center justify-center h-screen bg-gray-800">
      <div class="text-center bg-gray-800">
        <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>
        <p class="text-xl text-gray-600 mb-8">Page not found</p>
        <button @click="goHome" class="px-4 py-2 bg-blue-500 text-white rounded">Go Home</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      goHome() {
        // You can customize this method to redirect to the home page or another page
        this.$router.push('/');
      },
    },
  };
  </script>
  
  <style scoped>
  /* Add any additional styling here if needed */
  </style>
  