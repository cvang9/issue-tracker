<script setup >
import HeaderArea from '@/components/Header/HeaderArea.vue'
import SidebarArea from '@/components/Sidebar/SidebarArea.vue'
// import { ref } from 'vue';
// import { getCookie } from '../helper/CookieHelper';
import  { useDarkModeStore } from '@/store/darkMode.js';

const darkModeStore = useDarkModeStore()
// const dark = ref(getCookie('dark'));

</script>

<template>

  <div class="flex h-screen overflow-hidden">

    <SidebarArea />

    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <HeaderArea />
      <main :class=" (darkModeStore.darkMode) ? 'my-bg' : '' ">
       <!-- <main> -->
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
          <slot></slot>
        </div>
      </main>
    </div>
  </div>

</template>

<style scoped>

.my-bg {
    background-color:#1C2434;
    height: 200vh;
}
</style>
