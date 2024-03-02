<script setup>
import DataStatsOne from '@/components/DataStats/DataStatsOne.vue'
import ChartOne from '@/components/Charts/ChartOne.vue'
import ChartTwo from '@/components/Charts/ChartTwo.vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import apiClient from '../../services/api.js';
import { ref, onMounted } from 'vue';
import { useAdminStore } from '../../store/admin.js';


const counts = ref(null);
const yearlyCount = ref(null); 
const weeklyCount = ref(null); 
const bool = ref(false);
const isLoading = ref(true);
const name = ref(null);
const adminState = useAdminStore();
const { setData } = adminState;


apiClient.get('/api/admin')
.then(function(response) {
    console.log(response.data.data.attributes);
    setData(response.data.data.attributes);
})
.catch(function(error){
    console.log(error);
})


apiClient.get('/api/admin/data')
.then(function(response) {
    counts.value = response.data.data.attributes.count;
    yearlyCount.value = response.data.data.attributes.stats.yearly;
    weeklyCount.value = response.data.data.attributes.stats.weekly;
    bool.value = true;
    isLoading.value = false;
    
})
.catch(function(error) {
    console.log(error);
})



</script>

<template>


  <DefaultLayout>

    <div v-if="isLoading" class="absolute right-1/2 bottom-1/2  transform translate-x-1/2 translate-y-1/2 ">
         <div class="border-t-transparent border-solid animate-spin  rounded-full border-blue-400 border-6 h-34 w-34"></div>
     </div>

    <div v-if="!isLoading" >

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5" v-if="bool">
            <DataStatsOne :counts="counts"/>
        </div>
        
        <div class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">
            
            <ChartOne :counts="yearlyCount"/>
            
            <ChartTwo :counts="weeklyCount" />
        </div>

    </div>
  </DefaultLayout>
    
</template>
