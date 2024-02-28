<script setup >
import { onClickOutside } from '@vueuse/core'
import { ref } from 'vue'
import apiClient from '../../services/api'

const target = ref(null)
const dropdownOpen = ref(false)
const notifying = ref(true)
const notificationItems = ref([]);

onClickOutside(target, () => {
  dropdownOpen.value = false
})

apiClient.get('/api/admin/notifications')
         .then(function(response) {
             console.log(response.data);
             notificationItems.value = response.data
         })
         .catch(function(error) {
            console.log(error);
         })

         function timeAgo(timestamp) {
            const currentDate = new Date();
            const targetDate = new Date(timestamp);
            const timeDifference = currentDate - targetDate;

            const seconds = Math.floor(timeDifference / 1000);
            const minutes = Math.floor(seconds / 60);
            const hours = Math.floor(minutes / 60);
            const days = Math.floor(hours / 24);

            if (seconds < 60) {
                return `${seconds} seconds ago`;
            } else if (minutes < 60) {
                return `${minutes} minutes ago`;
            } else if (hours < 24) {
                return `${hours} hours ago`;
            } else {
                return `${days} days ago`;
            }
        }
</script>

<template>
  <li class="relative" ref="target">
    <router-link
      class="relative flex h-8.5 w-8.5 items-center justify-center rounded-full border-[0.5px] border-stroke bg-gray hover:text-primary dark:border-strokedark dark:bg-meta-4 dark:text-white"
      to="#"
      @click.prevent="(dropdownOpen = !dropdownOpen), (notifying = false)"
    >
      <span
        :class="!notifying && 'hidden'"
        class="absolute -top-0.5 right-0 z-1 h-2 w-2 rounded-full bg-meta-1"
      >
        <span
          class="absolute -z-1 inline-flex h-full w-full animate-ping rounded-full bg-meta-1 opacity-75"
        ></span>
      </span>

      <svg
        class="fill-current duration-300 ease-in-out"
        width="18"
        height="18"
        viewBox="0 0 18 18"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M16.1999 14.9343L15.6374 14.0624C15.5249 13.8937 15.4687 13.7249 15.4687 13.528V7.67803C15.4687 6.01865 14.7655 4.47178 13.4718 3.31865C12.4312 2.39053 11.0812 1.7999 9.64678 1.6874V1.1249C9.64678 0.787402 9.36553 0.478027 8.9999 0.478027C8.6624 0.478027 8.35303 0.759277 8.35303 1.1249V1.65928C8.29678 1.65928 8.24053 1.65928 8.18428 1.6874C4.92178 2.05303 2.4749 4.66865 2.4749 7.79053V13.528C2.44678 13.8093 2.39053 13.9499 2.33428 14.0343L1.7999 14.9343C1.63115 15.2155 1.63115 15.553 1.7999 15.8343C1.96865 16.0874 2.2499 16.2562 2.55928 16.2562H8.38115V16.8749C8.38115 17.2124 8.6624 17.5218 9.02803 17.5218C9.36553 17.5218 9.6749 17.2405 9.6749 16.8749V16.2562H15.4687C15.778 16.2562 16.0593 16.0874 16.228 15.8343C16.3968 15.553 16.3968 15.2155 16.1999 14.9343ZM3.23428 14.9905L3.43115 14.653C3.5999 14.3718 3.68428 14.0343 3.74053 13.6405V7.79053C3.74053 5.31553 5.70928 3.23428 8.3249 2.95303C9.92803 2.78428 11.503 3.2624 12.6562 4.2749C13.6687 5.1749 14.2312 6.38428 14.2312 7.67803V13.528C14.2312 13.9499 14.3437 14.3437 14.5968 14.7374L14.7655 14.9905H3.23428Z"
          fill=""
        />
      </svg>
    </router-link>

    <!-- Dropdown Start -->
    <div
      v-show="dropdownOpen"
      class="absolute -right-27 mt-2.5 flex h-90 w-75 flex-col rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark sm:right-0 sm:w-80"
    >
      <div class="px-4.5 py-3">
        <h5 class="text-sm font-medium text-bodydark2">Notifications</h5>
      </div>

      <ul class="flex h-auto flex-col overflow-y-auto">
        <template v-for="(nots, index) in notificationItems" :key="index">
          <li>
            <div
              class="flex flex-col gap-2.5 border-t border-stroke px-4.5 py-3 hover:bg-gray-2 dark:border-strokedark dark:hover:bg-meta-4"
            >
            <p>Ticket ID: {{ nots.ticket_id }}</p>
              <p class="text-sm">
                {{ ( nots.operation === 'created') ? `${nots.name} has created a ticket .` : `${nots.resolver_name} has updated ${nots.name}'s ticket.` }}
              </p>

              <p class="text-xs">{{ ( nots.operation === 'created') ? timeAgo(nots.created_at) : timeAgo(nots.updated_at) }}</p>
            </div>
          </li>
        </template>
      </ul>
    </div>
    <!-- Dropdown End -->
  </li>
</template>
