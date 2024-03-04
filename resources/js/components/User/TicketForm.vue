<template>
    <div class=" bg-white  flex flex-col justify-center shadow rounded-3xl sm:py-12">
  <div class="relative  w-100 sm:max-w-xl sm:mx-auto">
    <div class="relative px-4 py-10 bg-white mx-8 md:mx-0  sm:p-10">
      <div class="max-w-md mx-auto">
        <div class="flex items-center space-x-5">
          <div class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">i</div>
          <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
            <h2 class="leading-relaxed">Create a Ticket </h2>
            <p class="text-sm text-gray-500 font-normal leading-relaxed">Can raise your issue in this ticket form</p>
          </div>
        </div>
        <div class="divide-y divide-gray-200">
          <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
            <div class="flex flex-col">
              <label class="leading-loose">Ticket Title</label>
              <input type="text" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="...">
            </div>
    
            <div class="flex flex-col">
                <label class="leading-loose">Describe Your Issue </label>
                <textarea v-model="query" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="..."></textarea>
                <!-- <textarea v-model="query" rows="3"></textarea> -->
                <!-- <input type="text" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Optional"> -->
            </div>
        </div>
        <!-- <p>Select Department </p> -->

        <div>
            <label class="leading-loose">Choose department </label>
            <select
                v-model="department"
                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent pb-3 px-12  transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                >
                <option :value="dept.data.attributes.name" class="text-body dark:text-bodydark" v-for="dept in departments" :key="dept.data.department_id" > {{ dept.data.attributes.name }}</option>
            
            </select>
        </div>

          <div class="pt-4 flex items-center space-x-4">
              <button class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none" v-on:click="handleClose">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Cancel
              </button>
              <button class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none" v-on:click="submitQuery">Create</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- <div class="query-form">
    <h2>Create New Ticket</h2>
    <form @submit.prevent="submitQuery">
      <div class="entry">
        <fieldset>
          <legend>Title</legend>
          <input type="text" v-model="title" placeholder="Enter the title...">
        </fieldset>
        <fieldset>
          <legend>Issue</legend>
      <textarea v-model="query" placeholder="Enter your issue..." rows="6"></textarea>
        </fieldset>
      </div>
      <div class="btm">
      <div class="category-buttons">
        <button type="button" @click="selectCategory('Security')" :class="{ active: selectedCategory === 'Security' }">Security</button>
        <button type="button" @click="selectCategory('Technical')" :class="{ active: selectedCategory === 'Technical' }">Technical</button>
        <button type="button" @click="selectCategory('Management')" :class="{ active: selectedCategory === 'Management' }">Management</button>
      </div>
      <button type="submit">Submit</button>

      </div>
    </form>
  </div> -->
</template>

<script setup>

import { ref, defineEmits, onMounted } from 'vue';
import apiClient from '../../services/api';
import { getCookie } from '../../helper/CookieHelper.js'

  const emit = defineEmits(['formSubmitted', 'close' ]);

  const departments = ref([]);
  const department = ref(null);


    onMounted(() => {
    
    apiClient.get('/api/departments')
    .then(function(response) {
        console.log(response.data.data);
        departments.value = response.data.data;
    })
    .catch(function(error) {
        console.log(error);
    })

    });

    const title = ref('');
    const query = ref('');

    const submitQuery = () => {
      console.log('Title:', title.value);
      console.log('Query:', query.value);
      console.log('Category:', department.value);

      const payload = {
        'title': title.value,
        'body': query.value,
        'department': department.value
      }

      apiClient.post(`/api/users/${getCookie('userId')}/tickets`, payload)
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        })


      title.value = '';
      query.value = '';
      selectedCategory.value = null;
      emit('formSubmitted');
    };

    const handleClose = () => {
      emit('close');
    };

    const selectCategory = (category) => {
      selectedCategory.value = category;
    };
</script>



