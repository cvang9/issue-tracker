<template>
  <main class="flex w-full h-full shadow-lg rounded-3xl section">
    <section class="flex flex-col w-2/12 bg-slate-800 rounded-l-3xl dark:z-10">
      <div class="w-16 mx-auto mt-9 mb-9 p-4 bg-indigo-600 rounded-2xl text-white">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1"
            d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"
          />
        </svg>
      </div>
      <div class="ml-20">
        <DarkModeSwitcher/>
      </div>
      <nav class="relative flex flex-col py-4 items-center">
        <div class="ml-1">
          <p class="text-white">
            Resolved
          </p>
          <button @click="getResolvedTickets" class="w-10 p-1 border text-gray-700 bg-white rounded-2xl mb-4 hover:bg-slate-300">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1"
            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"
            />
          </svg>
        </button>
      </div>
      <div class="ml-3">
        <p class="text-white">
          Processed
        </p>
        <button
        @click="getProcessingTickets"
        class="w-10 p-1 border text-gray-700 rounded-2xl bg-white mb-4 hover:bg-slate-300"
        >
        <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        >
        <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="1"
        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
        />
      </svg>
    </button>
  </div>  
  <div>
    <p class="text-white">Pending</p>
    <button @click="getPendingTickets" class="w-10 p-1 border bg-white text-gray-700 rounded-2xl mb-4 hover:bg-slate-300">
      <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1"
              d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"
              />
            </svg>
          </button>
        </div>
        <div class="ml-1">
          <p class="text-white">Rejected</p>
          <button @click="getRejectedTickets" class="w-10 p-1 border text-gray-700 bg-white rounded-2xl mb-24 hover:bg-slate-300">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
            />
          </svg>
        </button>
      </div>
      
        <router-link
        :to="`/resolver-profile/${$route.params.id}`"
          class="w-13 mr-4 p-2 border text-gray-700 bg-white rounded-2xl hover:bg-slate-300"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1"
              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
            />
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
            />
          </svg>
        </router-link>
      </nav>
    </section>
    <PageLoader v-if="loadingTickets"/>
    <section v-if="!loadingTickets" class="flex flex-col pt-3 w-4/12 bg-grey-100 h-full overflow-y-scroll dark:bg-black dark:text-white">
      <ul v-for="item in cards" :key="item" class="mt-5">
        <li  
        @click="() => setAttributes(item)"
        class="py-5 border-b px-3 transition hover:bg-indigo-100 dark:hover:bg-slate-700 dark:hover:text-white">
          <p
            
            class="flex justify-between items-center outline-none"
          >
            <h3 class="text-lg font-semibold">
              {{ item.data.attributes.user.data.attributes.name }}
            </h3>
            <!-- <p class="text-md text-gray-400 text-right">23m ago</p> -->
          </p>
          <div class="text-md italic text-gray-400">See the ticket status !</div>
        </li>
      </ul>
    </section>
    <section v-if="!loadingTickets" class="w-6/12 px-4 flex flex-col bg-white rounded-r-3xl overflow-y-auto dark:bg-black dark:text-white">
      <div class="flex justify-between items-center h-48 border-b-2 mb-8">
        <div class="flex space-x-4 items-center">
          <div class="h-12 w-12 rounded-full overflow-hidden">
            <img :src="profile" loading="lazy" class="h-full w-full object-cover" />
          </div>
          <div class="flex flex-col ">
            <h3 class="font-semibold text-lg ">{{ username }}</h3>
            <p class="text-light text-gray-400">{{ email }}</p>
          </div>
        </div>
      </div>
      <section>
        <h1 class="font-bold text-2xl">Issue Regarding your department</h1>
        <article class="mt-8 text-gray-500 leading-7 tracking-wider dark:text-white">
          <p>Hi {{ username }},</p>
          <p>
            {{ body }}
          </p>
          <footer class="mt-12">
            <p>Thanks & Regards,</p>
            <p>{{ username }}</p>
          </footer>
        </article>
        <ul class="flex space-x-10 mt-10 mb-10">
          
          <li
            class="w-10 h-10 rounded-lg p-1 cursor-pointer transition duration-200 text-blue-400 hover:bg-blue-100"
          >
            <svg
              @click="changeRoute"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1"
                d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"
              />
            </svg>
           <p class="mt-1 mb-1">Chat</p> 
          </li>
          <li
            class="w-30 h-10 rounded-lg p-1 cursor-pointer transition duration-200 text-blue-400 hover:bg-blue-100"
          >
            <svg
              @click="toogle = !toogle"
              class="w-8"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1"
                d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"
              />
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"
              />
            </svg>
            <p class="mt-1 mb-1 ">Schedule Chat</p>
          </li>
        </ul>
        <div v-if="toogle">
          <input class="mt-8 mr-2 outline-none rounded-lg dark:bg-slate-400 dark:text-black-2" type="text" v-model="chatDate" />
          <button
            v-if="!chatDateLoading"
            @click="submitDate"
            class="bg-blue-500 hover:bg-blue-800 text-white px-6 py-2 rounded-xl"
          >
            Schedule
          </button>
          <Loader v-if="chatDateLoading"></Loader>
        </div>
      </section>
      <section class="mt-6 border rounded-xl bg-gray-50 mb-3">
        <textarea
          class="w-full bg-gray-50 p-2 rounded-xl outline-none dark:bg-slate-400 dark:text-black-2"
          placeholder="Type your reply here..."
          rows="3"
          v-model="feedback"
        ></textarea>
        <div class="flex items-center justify-between p-2">
          <button
            v-if="!feedbackLoader"
            @click="resolve"
            class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-800"
          >
            Resolve
          </button>
          <Loader v-if="feedbackLoader"></Loader>
          <button
            v-if="!feedbackLoader"
            @click="rejected"
            class="bg-blue-600 hover:bg-blue-800 text-white px-6 py-2 rounded-xl"
          >
            Reject
          </button>
          <button
            v-if="!feedbackLoader"
            @click="processing"
            class="bg-blue-600 hover:bg-blue-800 text-white px-6 py-2 rounded-xl"
          >
            Process
          </button>
        </div>
      </section>
    </section>
  </main>
</template>
<script setup>
import PageLoader from './PageLoader.vue'
import apiClient from '../../services/api.js'
import Loader from './Loader.vue'
import { onMounted, ref } from 'vue'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { useAuthStore } from '../../store/auth.js'
import { useRoute, useRouter } from 'vue-router'
import { getCookie } from '../../helper/CookieHelper.js'
import DarkModeSwitcher from '../Header/DarkModeSwitcher.vue'
const cards = ref([])
const route = useRoute()
const route1 = useRouter()
const { authenticated, toggleState } = useAuthStore()
const status = ref('')
const toogle = ref(false)
const chatDate = ref('')
const chatDateLoading = ref('')
const feedback = ref('')
const username = ref('')
const email = ref('')
const userId = ref('')
const body = ref('')
const ticketId = ref('')
const profile = ref('http://[::1]:5173/storage/app/uploads/profile.png')
const loadingTickets = ref(true)
const feedbackLoader = ref(false)
toast.success('Welcome back', {
  autoClose: 1000
})
const submitDate = () => {
  chatDateLoading.value = true
  const resolverId = getCookie('resolverId')
  const payload = {
    timestamp: chatDate.value
  }
  chatDate.value = ''
  apiClient
    .post(`api/messages/${resolverId}/notify/${userId.value}`, payload)
    .then((response) => {
      console.log(response.data)
      toast.success('Invitation sent !', {
        autoClose: 1000
      })
      chatDateLoading.value = false
      // this.$emit('loadagain')
    })
    .catch((error) => {
      toast.error('Error occured,Please try again later', {
        autoClose: 1000
      })
      chatDateLoading.value = false
      console.log(error)
    })
}
const changeRoute = () => {
  route1.push(`/chat?role=resolver&friendId=${userId.value}`)
}
const setAttributes = (item) => {
  username.value = item.data.attributes.user.data.attributes.name
  email.value = item.data.attributes.user.data.attributes.email
  ticketId.value = item.data.ticket_id
  body.value = item.data.attributes.body
  userId.value = item.data.attributes.user.data.user_id
  if (item.data.attributes.user.data.attributes.img !== '') {
    profile.value = `http://[::1]:5173/storage/app/uploads/${item.data.attributes.user.data.attributes.img}`
  }
  console.log(ticketId.value)
}
onMounted(() => {
  if (!authenticated) {
    route1.push('/')
  } else {
    getResolvedTickets()
  }
})
const getResolvedTickets = () => {
  loadingTickets.value = true
  apiClient
    .get(`/api/resolvers/${route.params.id}/tickets`)
    .then((response) => {
      cards.value = response.data.data.tickets.resolved
      username.value = cards.value[0].data.attributes.user.data.attributes.name
      email.value = cards.value[0].data.attributes.user.data.attributes.email
      ticketId.value = cards.value[0].data.ticket_id
      body.value = cards.value[0].data.attributes.body
      userId.value = cards.value[0].data.attributes.user.data.user_id
      if (cards.value[0].data.attributes.user.data.attributes.img !== '') {
        profile.value = `http://[::1]:5173/storage/app/uploads/${cards.value[0].data.attributes.user.data.attributes.img}`
      }
      console.log(response.data)
      loadingTickets.value = false
    })
    .catch((error) => {
      console.log(error)
      loadingTickets.value = false
    })
}

const getPendingTickets = () => {
  loadingTickets.value = true
  apiClient
    .get(`/api/resolvers/${route.params.id}/tickets`)
    .then((response) => {
      cards.value = response.data.data.tickets.pending
      console.log(cards.value)
      loadingTickets.value = false
    })
    .catch((error) => {
      console.log(error)
      loadingTickets.value = false
    })
}

const getRejectedTickets = () => {
  loadingTickets.value = true
  apiClient
    .get(`/api/resolvers/${route.params.id}/tickets`)
    .then((response) => {
      cards.value = response.data.data.tickets.rejected
      console.log(cards.value)
      loadingTickets.value = false
    })
    .catch((error) => {
      console.log(error)
      loadingTickets.value = false
    })
}
const getProcessingTickets = () => {
  loadingTickets.value = true
  apiClient
    .get(`/api/resolvers/${route.params.id}/tickets`)
    .then((response) => {
      cards.value = response.data.data.tickets.processing
      console.log(cards.value)
      loadingTickets.value = false
    })
    .catch((error) => {
      console.log(error)
    })
}
const resolve = () => {
  feedbackLoader.value = true
  status.value = 'resolved'
  const payload = {
    feedback: feedback.value,
    status: status.value
  }
  feedback.value = ''
  apiClient
    .put(`/api/resolvers/${route.params.id}/tickets/${ticketId.value}`, payload)
    .then((response) => {
      console.log(response.data)
      feedbackLoader.value = false
      toast.success('Successfullt updated', {
        autoClose: 1000
      })
      // this.$emit('loadagain')
    })
    .catch((error) => {
      feedbackLoader.value = false
      toast.error('Error occured,Please try again later', {
        autoClose: 1000
      })
      console.log(error)
    })
}
const rejected = () => {
  status.value = 'rejected'
  feedbackLoader.value = true
  // this.toggle = !this.toggle
  const payload = {
    feedback: feedback.value,
    status: status.value
  }
  feedback.value = ''
  apiClient
    .put(`/api/resolvers/${route.params.id}/tickets/${ticketId.value}`, payload)
    .then((response) => {
      console.log(response.data)
      toast.success('Successfullt updated', {
        autoClose: 1000
      })
      feedbackLoader.value = false
      // this.$emit('loadagain')
    })
    .catch((error) => {
      toast.error('Error occured,Please try again later', {
        autoClose: 1000
      })
      feedbackLoader.value = false
      console.log(error)
    })
}
const processing = () => {
  status.value = 'processing'
  feedbackLoader.value = true
  const payload = {
    feedback: feedback.value,
    status: status.value
  }
  feedback.value = ''
  // this.toggle = !this.toggle
  apiClient
    .put(`/api/resolvers/${route.params.id}/tickets/${ticketId.value}`, payload)
    .then((response) => {
      console.log(response.data)
      toast.success('Successfullt updated', {
        autoClose: 1000
      })
      feedbackLoader.value = false
      // this.$emit('loadagain')
    })
    .catch((error) => {
      toast.error('Error occured,Please try again later', {
        autoClose: 1000
      })
      feedbackLoader.value = false
      console.log(error)
    })
}
</script>
<style scoped>
.section {
  /* Target the scrollbar track */
  height: 100vh;
}
</style>