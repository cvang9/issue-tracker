import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import { getCookie } from '../helper/CookieHelper.js'; 

export const useAuthStore = defineStore('auth', function () {

    // state
    const isLogin = ref(false);

    // getters
    const authenticated = computed(function () {
        return isLogin.value;
    });
    if (getCookie('role')) {
        isLogin.value = true;
    }

    // actions
    function toggleState() {
        isLogin.value = !isLogin.value;
    }

    return { isLogin, authenticated, toggleState }
})