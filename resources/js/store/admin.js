import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useAdminStore = defineStore( 'admin', function(){

    // state
    const name = ref(null);

    // getters
    const getName = computed( function() {
        return name.value;
    });

    // actions
    function setName( adminName ){
        name.value = adminName;
    }

    return { name, getName, setName }
} )