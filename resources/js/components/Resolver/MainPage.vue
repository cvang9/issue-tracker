<template>
  <div v-if="loadingTickets || loadingUser" :class="[darkMode ? 'dark-loading' : 'loading']">
    <div></div>
  </div>
  <div v-else :class="[darkMode ? 'dark-main-div' : 'main-div']">
    <div :class="[darkMode ? 'dark-left-div' : 'left-div']">
      <img :src="profile" alt="resolver" />
      <p class="name">
        {{ user?.data?.attributes?.user?.data?.attributes?.name }}
      </p>
      <P>{{ user?.data?.attributes?.department?.data?.attributes?.name }}</P>
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
        <router-link :to="`/resolver-profile/${$route.params.id}`"> My Profile </router-link>
      </button>
      <button
        v-if="!loading"
        class="bg-red hover:bg-white hover:text-red text-white font-bold py-2 px-4 rounded mt-4"
        @click="logoutHandler"
      >
        Logout
      </button>
      <Loader v-if="loading" />
      <button :class="[darkMode ? 'lightbutton' : 'darkbutton']" @click="toggleMode">
        {{ darkMode ? 'Light' : 'Dark' }}
      </button>
    </div>
    <div :class="[darkMode ? 'dark-right-div' : 'right-div']">
      <p>Your Department Related issues</p>
      <div v-for="item in cards.data" :key="item" class="right-div-card">
        <issue-card :card="item" @loadagain="newfunc" :darkMode="darkMode" />
      </div>
    </div>
  </div>
</template>

<script setup>
import IssueCard from './IssueCard.vue'
import Loader from './Loader.vue'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { useAuthStore } from '../../store/auth.js'
import apiClient from '../../services/api.js'
import { useRoute, useRouter } from 'vue-router'
import { onMounted, ref } from 'vue'
const loading = ref(false)
const route = useRoute()
const loadingUser = ref(true)
const loadingTickets = ref(true)
const route1 = useRouter()
const cards = ref([])
const darkMode = ref(false)
const user = ref(null)
const profile = ref('http://[::1]:5173/storage/app/uploads/profile.png')
const { authenticated, toggleState } = useAuthStore()
function toggleMode() {
  darkMode.value = !darkMode.value
  if (darkMode.value) {
    localStorage.setItem('dark', true)
  } else {
    localStorage.removeItem('dark')
  }
}
function newfunc() {
  loaded()
  toast.success('Successfully resolved', {
    autoClose: 1000
  })
}
toast.success('Welcome back', {
  autoClose: 1000
})
const logoutHandler = () => {
  loading.value = true
  apiClient
    .get('/api/logout')
    .then((response) => {
      toggleState()
      localStorage.removeItem('token')
      localStorage.removeItem('id')
      localStorage.removeItem('role')
      loading.value = false
      route1.push('/')
    })
    .catch((error) => {
      console.log(error)
      toast.error('Error occured,Please try again later', {
        autoClose: 1000
      })
      loading.value = false
    })
}
const loadUser = () => {
  loadingUser.value = true
  apiClient
    .get(`/api/resolvers/${route.params.id}`)
    .then((response) => {
      user.value = response.data

      if (user.value?.data?.attributes?.user?.data?.attributes?.img !== '') {
        profile.value = `http://[::1]:5173/storage/app/uploads/${user.value?.data?.attributes?.user?.data?.attributes?.img}`
      }
      loadingUser.value = false
    })
    .catch((error) => {
      console.log(error)
      loadingUser.value = false
    })
}
const loaded = () => {
  loadingTickets.value = true
  apiClient
    .get(`/api/resolvers/${route.params.id}/tickets`)
    .then((response) => {
      cards.value = response.data
      loadingTickets.value = false
    })
    .catch((error) => {
      console.log(error)
      loadingTickets.value = false
    })
}
onMounted(() => {
  if (localStorage.getItem('dark')) {
    darkMode.value = true
  }
  if (!authenticated) {
    route1.push('/')
  } else {
    loaded()
    loadUser()
  }
})
</script>
<style scoped>
/* light mode CSS */
.main-div {
  height: 100vh;
  display: flex;
  /* gap: 2vmax; */
  width: 100%;
}
.left-div {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 25%;
}
.left-div > img {
  margin-top: 5vmax;
  width: 80%;
  border-radius: 50%;
  margin-bottom: 2vmax;
}
.left-div > .name {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-weight: 700;
}
.right-div {
  width: 75%;
  background-color: rgb(248, 243, 243);
  overflow-y: auto;
  border-radius: 5px;
}
.right-div > p {
  margin: 5px 0;
  text-align: center;
  font-size: 2vmax;
  color: gray;
  padding-bottom: 1.2vmax;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  border-bottom: 1px solid grey;
}
.right-div-card {
  padding: 1rem 2rem;
}
.loading {
  width: 100vw;
  height: 100vh;
  background-color: whitesmoke;
  display: grid;
  place-items: center;
  max-width: 100%;
}
.loading > div {
  width: 15vmax;
  border-bottom: 4px solid rgb(116, 84, 84);
  border-radius: 50%;
  height: 14vmax;
  animation: loadingRouter 850ms linear infinite;
}
@keyframes loadingRouter {
  to {
    transform: rotateZ(-360deg);
  }
}

/* dark mode CSS */
.dark-main-div {
  height: 100vh;
  display: flex;
  /* gap: 2vmax; */
  width: 100%;
}
.dark-left-div {
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #3a3a3a;
  width: 25%;
  color: white;
}
.dark-left-div > img {
  margin-top: 5vmax;
  width: 80%;
  border-radius: 50%;
  margin-bottom: 2vmax;
}
.dark-left-div > .name {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-weight: 700;
}
.dark-right-div {
  width: 75%;
  background-color: #3a3a3a;
  overflow-y: auto;
  border-radius: 5px;
}
.dark-right-div > p {
  margin: 5px 0;
  text-align: center;
  font-size: 2vmax;
  /* color: white; */
  color: rgba(235, 235, 235, 0.6);
  padding-bottom: 1.2vmax;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  border-bottom: 1px solid grey;
}
.dark-right-div-card {
  padding: 1rem 2rem;
}
.dark-loading {
  width: 100vw;
  height: 100vh;
  /* background-color: whitesmoke; */
  background-color: #3a3a3a;
  display: grid;
  place-items: center;
  max-width: 100%;
}
.dark-loading > div {
  width: 15vmax;
  border-bottom: 4px solid white;
  border-radius: 50%;
  height: 14vmax;
  animation: loadingRouter 850ms linear infinite;
}
@keyframes loadingRouter {
  to {
    transform: rotateZ(-360deg);
  }
}
.lightbutton {
  position: fixed;
  border: 1px solid white;
  left: 10px;
  padding: 1px 5px;
  border-radius: 5px;
  bottom: 10px;
}
.darkbutton {
  position: fixed;
  background-color: #3a3a3a;
  border: 1px solid black;
  color: white;
  left: 10px;
  padding: 1px 5px;
  border-radius: 5px;
  bottom: 10px;
}
</style>
