<script setup>
import DataStatsOne from '@/components/DataStats/DataStatsOne.vue'
import ChartOne from '@/components/Charts/ChartOne.vue'
import ChartTwo from '@/components/Charts/ChartTwo.vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import apiClient from '../../services/api.js';
import { ref } from 'vue';

const counts = ref(null);
const yearlyCount = ref(null); 
const weeklyCount = ref(null); 
const bool = ref(false);

apiClient.get('/api/admin/data')
.then(function(response) {
    counts.value = response.data.data.attributes.count;
    yearlyCount.value = response.data.data.attributes.stats.yearly;
    weeklyCount.value = response.data.data.attributes.stats.weekly;
    bool.value = true;
})
.catch(function(error) {
    console.log(error);
})


</script>

<template>
  <DefaultLayout>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5" v-if="bool">
      <DataStatsOne :counts="counts"/>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">
      <!-- ====== Chart One Start -->
      <ChartOne :counts="yearlyCount"/>
      <!-- ====== Chart One End -->

      <!-- ====== Chart Two Start -->
      <ChartTwo :counts="weeklyCount" />
    </div>
  </DefaultLayout>
</template>
