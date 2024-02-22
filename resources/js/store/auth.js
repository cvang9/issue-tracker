import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useAuthStore = defineStore( 'auth', function(){

    // state
    const isLogin = ref(false);

    // getters
    const authenticated = computed( function() {
        return isLogin.value;
    });

    // actions
    function toggleState(){
        isLogin.value = !isLogin.value;
    }

    return { isLogin, authenticated, toggleState }
} )