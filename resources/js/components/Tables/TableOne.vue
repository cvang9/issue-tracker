<script setup>
import { ref, onMounted } from 'vue'
import apiClient from '../../services/api.js';

const deptData = ref([]);
const isLoading = ref(true);

onMounted( function() {

    apiClient.get('/api/departments')
    .then(function(response) {
        console.log(response.data.data);
        deptData.value = response.data.data;

        setTimeout(function() {
            isLoading.value = false;
        }, 100 )

    })
    .catch(function(error) {
        console.log(error);
    });


})



</script>

<template>



  <div  
    class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"
  >
    <h4 class="mb-6 text-xl font-semibold text-black dark:text-white">Department List</h4>

    <div v-if="isLoading" class="absolute right-1/2 bottom-70  transform translate-x-1/2 translate-y-1/2 ">
         <div class="border-t-transparent border-solid animate-spin  rounded-full border-blue-400 border-6 h-14 w-14"></div>
     </div>

    <div class="flex flex-col" v-if="!isLoading" >
      <div class="grid grid-cols-3 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-5">
        <div class="p-2.5 xl:p-5">
          <h5 class="text-sm font-medium uppercase xsm:text-base">Department Name</h5>
        </div>
        <div class="p-2.5 text-center xl:p-5">
          <h5 class="text-sm font-medium uppercase xsm:text-base"> Total Issues</h5>
        </div>
        <div class="p-2.5 text-center xl:p-5">
          <h5 class="text-sm font-medium uppercase xsm:text-base">Total Resolvers</h5>
        </div>
        <div class="hidden p-2.5 text-center sm:block xl:p-5">
          <h5 class="text-sm font-medium uppercase xsm:text-base">Issues Resolved</h5>
        </div>
        <div class="hidden p-2.5 text-center sm:block xl:p-5">
          <h5 class="text-sm font-medium uppercase xsm:text-base">Issues Unresolved</h5>
        </div>
      </div>



     <div>
      <div 
        v-for="dept in deptData"
        :key="dept.data.department_id"
        :class="`grid grid-cols-3 sm:grid-cols-5 ${
          key === deptData.length - 1 ? '' : 'border-b border-stroke dark:border-strokedark'
        }`"
      >
        <div class="flex items-center gap-3 p-2.5 xl:p-5">
          <p class="hidden text-black dark:text-white sm:block">{{ dept.data.attributes.name }}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
          <p class="text-black dark:text-white">{{ dept.data.attributes.counts.issue }}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
          <p class="text-black dark:text-white">{{ dept.data.attributes.counts.resolver }}</p>
        </div>

        <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
          <p class="text-meta-3">{{ dept.data.attributes.counts.resolved_tickets }}</p>
        </div>

        <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
          <p class="text-meta-7">{{ dept.data.attributes.counts.unresolved_tickets }}</p>
        </div>
      </div>
    </div>
    </div>
  </div>
  
</template>
