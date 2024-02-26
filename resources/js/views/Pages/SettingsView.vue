<script setup>
import { ref } from 'vue'
import BreadcrumbDefault from '@/components/Breadcrumbs/BreadcrumbDefault.vue'
import SettingsCard from '@/components/SettingsCard.vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'

const pageTitle = ref('Create Resolver')
</script>

<template>
  <DefaultLayout>
    <div class="mx-auto max-w-270">
      
      <BreadcrumbDefault :pageTitle="pageTitle" />
      
      <SettingsCard />
    </div>
  </DefaultLayout>
</template>
