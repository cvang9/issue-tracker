import { ref } from 'vue'
import { defineStore } from 'pinia'
import { useStorage } from '@vueuse/core'
import { getCookie, setCookie } from '../helper/CookieHelper.js';

export const useDarkModeStore = defineStore('darkMode', () => {
  const darkMode = useStorage('darkMode', ref(false));
//   const darkMode = useStorage('darkMode', ref( ( getCookie('dark') ? true : false )));

  document.documentElement.classList.toggle('dark', darkMode.value)

  function toggleDarkMode() {
    darkMode.value = !darkMode.value
    setCookie('dark', darkMode.value );
    document.documentElement.classList.toggle('dark', darkMode.value)
  }

  return { darkMode, toggleDarkMode }
})
