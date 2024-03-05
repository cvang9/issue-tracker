<template>
    <div class=" bg-white px-10 flex flex-col justify-center shadow rounded-3xl sm:py-5">
  <div class="relative  w-100 sm:max-w-xl sm:mx-auto">
        <div v-if="invalid"
            class=" flex w-full border-l-6 border-[#F87171] bg-[#F87171] bg-opacity-[15%] px-7 py-2 shadow-md dark:bg-[#1B1B24] dark:bg-opacity-30 md:p-5"
        >
            <div
            class="mr-5 flex h-9 w-full max-w-[36px] items-center justify-center rounded-lg bg-[#F87171]"
            >
            <svg
                width="13"
                height="13"
                viewBox="0 0 13 13"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                d="M6.4917 7.65579L11.106 12.2645C11.2545 12.4128 11.4715 12.5 11.6738 12.5C11.8762 12.5 12.0931 12.4128 12.2416 12.2645C12.5621 11.9445 12.5623 11.4317 12.2423 11.1114C12.2422 11.1113 12.2422 11.1113 12.2422 11.1113C12.242 11.1111 12.2418 11.1109 12.2416 11.1107L7.64539 6.50351L12.2589 1.91221L12.2595 1.91158C12.5802 1.59132 12.5802 1.07805 12.2595 0.757793C11.9393 0.437994 11.4268 0.437869 11.1064 0.757418C11.1063 0.757543 11.1062 0.757668 11.106 0.757793L6.49234 5.34931L1.89459 0.740581L1.89396 0.739942C1.57364 0.420019 1.0608 0.420019 0.740487 0.739944C0.42005 1.05999 0.419837 1.57279 0.73985 1.89309L6.4917 7.65579ZM6.4917 7.65579L1.89459 12.2639L1.89395 12.2645C1.74546 12.4128 1.52854 12.5 1.32616 12.5C1.12377 12.5 0.906853 12.4128 0.758361 12.2645L1.1117 11.9108L0.758358 12.2645C0.437984 11.9445 0.437708 11.4319 0.757539 11.1116C0.757812 11.1113 0.758086 11.111 0.75836 11.1107L5.33864 6.50287L0.740487 1.89373L6.4917 7.65579Z"
                fill="#ffffff"
                stroke="#ffffff"
                ></path>
            </svg>
            </div>
            <div class="w-full">
            <h5 class="mb-3 font-bold text-[#B45454]">Empty Fields</h5>
            <ul>
                <li class="leading-relaxed text-[#CD5D5D]">
                *Please fill all the fields
                </li>
            </ul>
            </div>
        </div>
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
              <input v-model="title"  type="text" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="...">
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
  const invalid = ref(false);


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

      if(title.value==='' || query.value==='' || department.value==='')
      {
        invalid.value = true;
        return;
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
      // selectedCategory.value = null;
      console.log(1);
      emit('formSubmitted');
    };

    const handleClose = () => {
      emit('close');
    };

    const selectCategory = (category) => {
      selectedCategory.value = category;
    };
</script>



