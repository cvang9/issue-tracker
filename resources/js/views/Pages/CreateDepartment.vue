<script setup>
import { ref, onMounted } from 'vue'
import BreadcrumbDefault from '@/components/Breadcrumbs/BreadcrumbDefault.vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
const pageTitle = ref(' Create / Update / Delete Department')
import apiClient from '../../services/api.js';

const departmentCreate = ref('');
const departmentUpdate = ref('');
const departmentUpdateName = ref('');
const departmentDelete = ref('');
const bool = ref(false);
const crud = ref('');
const createLoading = ref(false);
const updateLoading = ref(false);
const deleteLoading = ref(false);

const departments = ref([]);

const handleCreate = ()=> {

    const payload = {
        'department' : departmentCreate.value
    }

    createLoading.value = true;

    apiClient.post('/api/departments', payload )
    .then(function(response) {
        if( response.status == 201 )
        {
            crud.value = 'Created';
            bool.value = true;
            setTimeout( function() {
                bool.value = false;
            }, 3000 )

        }
        createLoading.value = false;
    })
    .catch(function(error) {
        createLoading.value = false;
        console.log(error);
    })
}

const handleUpdate = ()=> {

    const payload = {
        'department' : departmentUpdate.value,
        'name' : departmentUpdateName.value
    }

    updateLoading.value = true;

    apiClient.put('/api/departments', payload )
    .then(function(response) {
        if( response.status == 200 )
        {
            crud.value = 'Updated';
            bool.value = true;
            setTimeout( function() {
                bool.value = false;
            }, 3000 )
        }
        updateLoading.value = false;
    })
    .catch(function(error) {
        updateLoading.value = false;
        console.log(error);
    })

}

const handleDelete = () => {

    const payload = {
        'department' : departmentDelete.value
    }

    deleteLoading.value = true;


    apiClient.put('/api/departments/delete', payload )
    .then(function(response) {
        if( response.status == 200 )
        {
            crud.value = 'Deleted';
            bool.value = true;
            setTimeout( function() {
                bool.value = false;
            }, 3000 )
        }

        deleteLoading.value = false;
    })
    .catch(function(error) {

        deleteLoading.value = false;
        console.log(error);
    })

}

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
</script>

<template>
  <DefaultLayout>

    <div v-if="bool"
            class=" mb-5 flex w-full border-l-6 border-[#34D399] bg-[#34D399] bg-opacity-[15%] px-7 py-8 shadow-md dark:bg-[#1B1B24] dark:bg-opacity-30 md:p-9"
        >
            <div
            class="mr-5 flex h-9 w-full max-w-[36px] items-center justify-center rounded-lg bg-[#34D399]"
            >
            <svg
                width="16"
                height="12"
                viewBox="0 0 16 12"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                d="M15.2984 0.826822L15.2868 0.811827L15.2741 0.797751C14.9173 0.401867 14.3238 0.400754 13.9657 0.794406L5.91888 9.45376L2.05667 5.2868C1.69856 4.89287 1.10487 4.89389 0.747996 5.28987C0.417335 5.65675 0.417335 6.22337 0.747996 6.59026L0.747959 6.59029L0.752701 6.59541L4.86742 11.0348C5.14445 11.3405 5.52858 11.5 5.89581 11.5C6.29242 11.5 6.65178 11.3355 6.92401 11.035L15.2162 2.11161C15.5833 1.74452 15.576 1.18615 15.2984 0.826822Z"
                fill="white"
                stroke="white"
                ></path>
            </svg>
            </div>
            <div class="w-full">
            <h5 class="mb-3 text-lg font-bold text-black dark:text-[#34D399]">
                Successfully {{ crud }} Department
            </h5>
            <p class="text-base leading-relaxed text-body">
                You can check in departments list
            </p>
            </div>
        </div>
    
    <div class="mx-auto max-w-270">
      
      <BreadcrumbDefault :pageTitle="pageTitle" />
      <form v-on:submit.prevent="handleCreate">
        <div>
            <label class="mb-2.5 block text-black dark:text-white">
             Create Department 
            <span v-if="required" class="text-meta-1">*</span>
            </label>
            <input
            type="text"
            placeholder="Enter Department Name"
            name="department"
            v-model="departmentCreate"
            class="w-full rounded border-[1.5px] text-black border-stroke bg-transparent py-3 px-5 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
            />
        </div>
        <div class="flex justify-start gap-4.5 mt-5">
              <button v-if="!createLoading"
                class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90"
                type="submit"
              >
                Create 
              </button>
              <button v-if="createLoading" disabled type="button" class=" flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90 inline-flex items-center">
                  <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                      <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Loading
          </button>
            </div>
      </form>

      <form v-on:submit.prevent="handleUpdate" class="mt-5">
        <div>
            <label class="mb-2.5 block text-black dark:text-white">
            Update Department Name
            <span v-if="required" class="text-meta-1">*</span>
            </label>
            <input
            type="text"
            placeholder="Enter Department Name"
            name="department"
            v-model="departmentUpdateName"
            class="w-full rounded border-[1.5px] text-black border-stroke bg-transparent py-3 px-5 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
            />
        </div>
        <label
                class="mb-3 block text-sm font-medium text-black dark:text-white"
                for="email"
                >Department
             </label>
            <div class="relative z-20 bg-white dark:bg-form-input">
            <span class="absolute top-1/2 left-4 z-30 -translate-y-1/2">
                <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                >
                <g opacity="0.8">
                    <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M10.0007 2.50065C5.85852 2.50065 2.50065 5.85852 2.50065 10.0007C2.50065 14.1428 5.85852 17.5007 10.0007 17.5007C14.1428 17.5007 17.5007 14.1428 17.5007 10.0007C17.5007 5.85852 14.1428 2.50065 10.0007 2.50065ZM0.833984 10.0007C0.833984 4.93804 4.93804 0.833984 10.0007 0.833984C15.0633 0.833984 19.1673 4.93804 19.1673 10.0007C19.1673 15.0633 15.0633 19.1673 10.0007 19.1673C4.93804 19.1673 0.833984 15.0633 0.833984 10.0007Z"
                    fill="#637381"
                    ></path>
                    <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0.833984 9.99935C0.833984 9.53911 1.20708 9.16602 1.66732 9.16602H18.334C18.7942 9.16602 19.1673 9.53911 19.1673 9.99935C19.1673 10.4596 18.7942 10.8327 18.334 10.8327H1.66732C1.20708 10.8327 0.833984 10.4596 0.833984 9.99935Z"
                    fill="#637381"
                    ></path>
                    <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M7.50084 10.0008C7.55796 12.5632 8.4392 15.0301 10.0006 17.0418C11.5621 15.0301 12.4433 12.5632 12.5005 10.0008C12.4433 7.43845 11.5621 4.97153 10.0007 2.95982C8.4392 4.97153 7.55796 7.43845 7.50084 10.0008ZM10.0007 1.66749L9.38536 1.10547C7.16473 3.53658 5.90275 6.69153 5.83417 9.98346C5.83392 9.99503 5.83392 10.0066 5.83417 10.0182C5.90275 13.3101 7.16473 16.4651 9.38536 18.8962C9.54325 19.069 9.76655 19.1675 10.0007 19.1675C10.2348 19.1675 10.4581 19.069 10.6159 18.8962C12.8366 16.4651 14.0986 13.3101 14.1671 10.0182C14.1674 10.0066 14.1674 9.99503 14.1671 9.98346C14.0986 6.69153 12.8366 3.53658 10.6159 1.10547L10.0007 1.66749Z"
                    fill="#637381"
                    ></path>
                </g>
                </svg>
            </span>
            <select
                v-model="departmentUpdate"
                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
            >
                <option :value="dept.data.attributes.name" class="text-body dark:text-bodydark" v-for="dept in departments" :key="dept.data.department_id" > {{ dept.data.attributes.name }}</option>
            </select>
            </div>
        <div class="flex justify-start gap-4.5 mt-5">
              <button v-if="!updateLoading"
                class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90"
                type="submit"
              >
                Update Department
              </button>
              <button v-if="updateLoading" disabled type="button" class=" flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90 inline-flex items-center">
                  <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                      <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Loading
          </button>
            </div>
      </form>


      <form v-on:submit.prevent="handleDelete"  class="mt-5">
        <div>
            <label class="mb-2.5 block text-black dark:text-white">
             Delete Department Name
            <span v-if="required" class="text-meta-1">*</span>
            </label>
            <div class="relative z-20 bg-white dark:bg-form-input">
            <span class="absolute top-1/2 left-4 z-30 -translate-y-1/2">
                <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                >
                <g opacity="0.8">
                    <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M10.0007 2.50065C5.85852 2.50065 2.50065 5.85852 2.50065 10.0007C2.50065 14.1428 5.85852 17.5007 10.0007 17.5007C14.1428 17.5007 17.5007 14.1428 17.5007 10.0007C17.5007 5.85852 14.1428 2.50065 10.0007 2.50065ZM0.833984 10.0007C0.833984 4.93804 4.93804 0.833984 10.0007 0.833984C15.0633 0.833984 19.1673 4.93804 19.1673 10.0007C19.1673 15.0633 15.0633 19.1673 10.0007 19.1673C4.93804 19.1673 0.833984 15.0633 0.833984 10.0007Z"
                    fill="#637381"
                    ></path>
                    <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0.833984 9.99935C0.833984 9.53911 1.20708 9.16602 1.66732 9.16602H18.334C18.7942 9.16602 19.1673 9.53911 19.1673 9.99935C19.1673 10.4596 18.7942 10.8327 18.334 10.8327H1.66732C1.20708 10.8327 0.833984 10.4596 0.833984 9.99935Z"
                    fill="#637381"
                    ></path>
                    <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M7.50084 10.0008C7.55796 12.5632 8.4392 15.0301 10.0006 17.0418C11.5621 15.0301 12.4433 12.5632 12.5005 10.0008C12.4433 7.43845 11.5621 4.97153 10.0007 2.95982C8.4392 4.97153 7.55796 7.43845 7.50084 10.0008ZM10.0007 1.66749L9.38536 1.10547C7.16473 3.53658 5.90275 6.69153 5.83417 9.98346C5.83392 9.99503 5.83392 10.0066 5.83417 10.0182C5.90275 13.3101 7.16473 16.4651 9.38536 18.8962C9.54325 19.069 9.76655 19.1675 10.0007 19.1675C10.2348 19.1675 10.4581 19.069 10.6159 18.8962C12.8366 16.4651 14.0986 13.3101 14.1671 10.0182C14.1674 10.0066 14.1674 9.99503 14.1671 9.98346C14.0986 6.69153 12.8366 3.53658 10.6159 1.10547L10.0007 1.66749Z"
                    fill="#637381"
                    ></path>
                </g>
                </svg>
            </span>
            <select
                v-model="departmentDelete"
                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                name="department"
            >
                <option :value="dept.data.attributes.name" class="text-body dark:text-bodydark" v-for="dept in departments" :key="dept.data.department_id" > {{ dept.data.attributes.name }}</option>
            </select>
            </div>
        </div>
           <div class="flex justify-start gap-4.5 mt-5">
              <button v-if="!deleteLoading"
                class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90"
                type="submit"
              >
                Delete Department
              </button>
              <button v-if="deleteLoading" disabled type="button" class=" flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90 inline-flex items-center">
                  <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                      <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Loading
          </button>
            </div>
      </form>
    </div>
  </DefaultLayout>
</template>