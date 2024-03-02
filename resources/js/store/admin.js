import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useAdminStore = defineStore( 'admin', function(){

    // state
    const name = ref(null);
    const img = ref(null);
    // const adminData = ref(null);

    // getters
    const getName = computed( function() {
        return name.value;
    });

    // actions
    function setData( adminData ){
        // console.log(adminData);adminData; 
        name.value = adminData.name
        img.value = adminData.img
    }


    return { name, img, getName, setData }
} );

