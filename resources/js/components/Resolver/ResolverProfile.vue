<template>
  <PageLoader v-if="loading" />
  <main v-if="user" class="profile-page">
    <section class="relative block h-500-px">
      <div
        class="absolute top-0 w-full h-full bg-center bg-cover"
        style="
          background-image: url('https://images.unsplash.com/photo-1555099962-4199c345e5dd?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max&ixid=eyJhcHBfaWQiOjEyMDd9');
        "
      >
        <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
      </div>
      <div
        class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
        style="transform: translateZ(0px)"
      >
        <svg
          class="absolute bottom-0 overflow-hidden"
          xmlns="http://www.w3.org/2000/svg"
          preserveAspectRatio="none"
          version="1.1"
          viewBox="0 0 2560 100"
          x="0"
          y="0"
        >
          <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section>
    <section class="relative py-16 bg-blueGray-200">
      <div class="container mx-auto px-4">
        <div
          class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64 dark:bg-slate-700"
        >
          <div class="px-6">
            <div class="flex flex-wrap justify-center">
              <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                <div class="relative border">
                  <img
                    alt="..."
                    :src="profile"
                    class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"
                  />
                </div>
              </div>
              <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                <div class="py-6 px-3 mt-32 sm:mt-0">
                  <Loader v-if="logoutLoading" />
                  <button
                    v-else
                    @click="logout"
                    class="bg-red active:bg-red-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
                    type="button"
                  >
                    LogOut
                  </button>
                </div>
              </div>
              <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                <div class="py-6 px-3 mt-32 sm:mt-0"></div>
              </div>
              <div class="w-full lg:w-4/12 px-4 lg:order-1">
                <div class="flex justify-center py-4 lg:pt-4 pt-8">
                  <div class="mr-4 p-3 text-center">
                    <span
                      class="text-xl font-bold block uppercase tracking-wide text-blueGray-600 dark:text-white"
                      >{{ user?.data?.attributes?.counts?.resolved_tickets }}</span
                    ><span class="text-sm text-blueGray-400 dark:text-white">Resolved</span>
                  </div>
                  <div class="mr-4 p-3 text-center">
                    <span
                      class="text-xl font-bold block uppercase tracking-wide text-blueGray-600 dark:text-white"
                      >{{ user?.data?.attributes?.counts?.rejected_tickets }}</span
                    ><span class="text-sm text-blueGray-400 dark:text-white">Rejected</span>
                  </div>
                  <div class="lg:mr-4 p-3 text-center">
                    <span
                      class="text-xl font-bold block uppercase tracking-wide text-blueGray-600 dark:text-white"
                      >{{ user?.data?.attributes?.counts?.processing_tickets }}</span
                    ><span class="text-sm text-blueGray-400 dark:text-white">Processing</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center mt-8">
              <h3
                class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 dark:text-white"
              >
                {{ name }}
              </h3>
              <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                Resolver
              </div>
              <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                Joinded :-{{ user.data.attributes.user.data.attributes.created_at }}
              </div>
              <div class="mb-2 text-blueGray-600 mt-10 dark:text-white">
                <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400 dark:text-white"></i
                >Department -
                {{ department }}
              </div>
              <div class="mb-2 text-blueGray-600 dark:text-white">
                <i
                  class="fas fa-regular fa-envelope mr-2 text-lg text-blueGray-400 dark:text-white"
                ></i
                >Email-
                {{ email }}
              </div>
            </div>
            <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
              <div class="flex flex-wrap justify-center">
                <div class="w-full lg:w-9/12 px-4">
                  <p class="mb-4 text-lg leading-relaxed text-blueGray-700 dark:text-white">
                    The primary responsibility of a department resolver is to address and resolve
                    issues that arise within their assigned department. These issues could range
                    from employee conflicts and performance concerns to operational challenges and
                    resource allocation problems. the role of a department resolver is crucial in
                    maintaining smooth operations, fostering a positive work environment, and
                    ensuring that departmental goals are met effectively within the organization.
                  </p>
                  <router-link :to="`/resolver/${route.params.id}`" class="font-normal text-red"
                    >Show Tickets</router-link
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import PageLoader from './PageLoader.vue'
import { useRoute, useRouter } from 'vue-router'
import apiClient from '../../services/api.js'
import { useAuthStore } from '../../store/auth.js'
import Loader from './Loader.vue'
const user = ref('')
const route = useRoute()
const name = ref('')
const profile = ref('http://[::1]:5173/storage/app/uploads/profile.png')
const route1 = useRouter()
const department = ref('')
const darkMode = ref(false)
const loading = ref(true)
const logoutLoading = ref(false)
const email = ref('email')
const { toggleState } = useAuthStore()
import { deleteCookie } from '../../helper/CookieHelper.js'
const loadUser = () => {
  loading.value = true
  apiClient
    .get(`/api/resolvers/${route.params.id}`)
    .then((response) => {
      user.value = response.data
      name.value = user.value.data?.attributes?.user?.data?.attributes?.name
      email.value = user.value.data?.attributes?.user?.data?.attributes?.email
      department.value = user.value?.data?.attributes?.department?.data?.attributes?.name
      if (user.value?.data?.attributes?.user?.data?.attributes?.img !== '') {
        profile.value = `http://[::1]:5173/storage/app/uploads/${user.value?.data?.attributes?.user?.data?.attributes?.img}`
      }
      loading.value = false
      console.log(user.value)
    })
    .catch((error) => {
      console.log(error)
      loading.value = false
    })
}
onMounted(() => {
  if (localStorage.getItem('dark')) {
    darkMode.value = true
  }
  loadUser()
})
const logout = () => {
  logoutLoading.value = true
  apiClient
    .get('/api/logout')
    .then((response) => {
      toggleState()

      deleteCookie('role')
      deleteCookie('resolverId')

      logoutLoading.value = false
      route1.push('/')
    })
    .catch((error) => {
      console.log(error)
      toast.error('Error occured,Please try again later', {
        autoClose: 1000
      })
      logoutLoading.value = false
    })
}
</script>
<style scoped>
</style>