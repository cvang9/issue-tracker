<template>
  <div class="cont">
    <side-bar :id="4"></side-bar>
    
    <slot></slot>
  </div>
</template>

<script setup>
import SideBar from './SideBar.vue'
</script>

<style scoped>
.cont {
  display: flex;
  background: rgba(216, 216, 216, 0.53);
}
</style>
