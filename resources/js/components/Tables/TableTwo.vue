<script setup>
import { ref, onMounted } from 'vue'
import apiClient from '../../services/api.js';

const resolverData = ref([])

onMounted( function() {

    apiClient.get('/api/admin/resolvers')
    .then(function(response) {
        console.log(response.data);
        resolverData.value = response.data.data;
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
    <h4 class="mb-6 text-xl font-semibold text-black dark:text-white">Resolvers List</h4>

    <div class="flex flex-col">
      <div class="grid grid-cols-3 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-5">
        <div class="p-2.5 xl:p-5">
          <h5 class="text-sm font-medium uppercase xsm:text-base">Resolver Name</h5>
        </div>
        <div class="p-2.5 text-center xl:p-5">
          <h5 class="text-sm font-medium uppercase xsm:text-base"> Department Name </h5>
        </div>
        <div class="p-2.5 text-center xl:p-5">
          <h5 class="text-sm font-medium uppercase xsm:text-base"> Issues Resolved </h5>
        </div>
        <div class="hidden p-2.5 text-center sm:block xl:p-5">
          <h5 class="text-sm font-medium uppercase xsm:text-base">Issues Rejected </h5>
        </div>
        <div class="hidden p-2.5 text-center sm:block xl:p-5">
          <h5 class="text-sm font-medium uppercase xsm:text-base">Issue Processing</h5>
        </div>
      </div>

      <div
        v-for="resolver in resolverData"
        :key="resolver.data.resolver_id"
        :class="`grid grid-cols-3 sm:grid-cols-5 border-b border-stroke dark:border-strokedark`"
      >
        <div class="flex items-center gap-3 p-2.5 xl:p-5">
          <p class="hidden text-black dark:text-white sm:block">{{ resolver.data.attributes.user }}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
          <p class="text-black dark:text-white">{{ resolver.data.attributes.department }}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
          <p class="text-meta-3">{{ resolver.data.attributes.counts.resolved_tickets }}</p>
        </div>

        <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
          <p class="text-meta-7">{{ resolver.data.attributes.counts.rejected_tickets }}</p>
        </div>

        <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
          <p class="text-meta-5">{{ resolver.data.attributes.counts.processing_tickets }}</p>
        </div>
      </div>
    </div>
  </div>
  
</template>
