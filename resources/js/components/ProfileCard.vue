<script setup>
import { ref } from 'vue';
import { useAdminStore } from '../store/admin.js';

const adminState = useAdminStore();
    

</script>


<template>
    <!-- ====== Profile Section Start -->
    <div
      class="overflow-hidden rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
    >
      <div class="relative z-20 h-35 md:h-65">
        <img
          src="../assets/img/user-07.png"
          alt="profile cover"
          class="h-full w-full rounded-tl-sm rounded-tr-sm object-cover object-center"
        />
        <div class="absolute bottom-1 right-1 z-10 xsm:bottom-4 xsm:right-4">
        </div>
      </div>
      <div class="px-4 pb-6 text-center lg:pb-8 xl:pb-11.5">
        <div
          class="relative z-30 mx-auto -mt-22 h-30 w-full max-w-30 rounded-full bg-white/20 p-1 backdrop-blur sm:h-44 sm:max-w-44 sm:p-3"
        >
          <div class="relative drop-shadow-2">

            <img :src="`http://[::1]:5173/storage/app/uploads/${adminState.img}`" />

          </div>
        </div>
        <div class="mt-4">
          <h3 class="mb-1.5 text-2xl font-medium text-black dark:text-white">{{ adminState.name }}</h3>
          <!-- <p class="font-medium dark:text-white"></p> -->
          <p class="font-medium dark:text-white">Joined us: {{  adminState.joined }}</p>
          <div
            class="mx-auto mt-4.5 mb-5.5  max-w-94 rounded-md border border-stroke py-2.5 shadow-1 dark:border-strokedark dark:bg-[#37404F]"
          >
          <span class="font-semibold text-black dark:text-white">Admin ( Issue Tracking System ) </span>
            <!-- <div
              class=" border-r border-stroke px-4 dark:border-strokedark xsm:flex-row"
            >
            </div> -->
            <!-- <div
              class="flex flex-col items-center justify-center gap-1 border-r border-stroke px-4 dark:border-strokedark xsm:flex-row"
            >
              <span class="font-semibold text-black dark:text-white">129K</span>
              <span class="text-sm dark:text-white">Followers</span>
            </div>
            <div class="flex flex-col items-center justify-center gap-1 px-4 xsm:flex-row">
              <span class="font-semibold text-black dark:text-white">2K</span>
              <span class="text-sm dark:text-white">Following</span>
            </div> -->
          </div>
  
          <div class="mx-auto max-w-180">
            <h4 class="font-medium text-black dark:text-white">About Admin Powers</h4>
            <p class="mt-4.5 text-sm font-normal dark:text-white">
                Hey there! So, um, being an admin for the ticket thingy is kind of like being the superhero of computer stuff. You have to read messages from people who need help with their techy problems and then decide who's gonna save the day. It's like being the boss of a super cool tech team! You make sure everyone gets their jobs and high-fives when they fix things. Oh, and you have to keep a super-duper organized list of all the problems and make sure everything runs super smoothly. It's like having a magical wand for computer troubles, and you get to make everything better! Being a ticket admin is like being the wizard of the tech world!
            </p>
          </div>
  
          
        </div>
      </div>
    </div>
    <!-- ====== Profile Section End -->
  </template>
  