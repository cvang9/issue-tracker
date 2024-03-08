<template>
  <div class="body-cont">
    <div class="contain">
      <top-heading v-if="!loading" :head="`Hi, ${name} :`"></top-heading>
    </div>
    <div>
      <div class="px-4 pb-6 text-center lg:pb-8 xl:pb-11.5">
        <div
          class="relative z-30 mx-auto -mt-22 h-30 w-full max-w-30 rounded-full bg-white/20 p-1 backdrop-blur sm:h-44 sm:max-w-44 sm:p-3"
        >
          <div class="relative drop-shadow-2">
            <img
              v-if="!loading"
              class="profile"
              :src="`http://[::1]:5173/storage/app/uploads/${UserImage}`"
            />
          </div>
        </div>
        <div class="load">
          <Loader v-if="loading" />
        </div>
        <div class="mt-4">
          <h3 class="text-2xl font-medium text-black ">{{ User.name }}</h3>
          <p class="mb-1.5 text-l font-medium text-black ">{{ User.email }}</p>
          <p class="font-medium ">Joined us: {{ User.created_at }}</p>
          <div
            class="mx-auto mt-4.5 mb-5.5 max-w-94 rounded-md border border-stroke py-2.5 shadow-1"
          >
            <span class="font-semibold text-black"
              >User ( Issue Tracking System )
            </span>
          </div>

          <div class="mx-auto max-w-180">
            <h4 class="font-medium text-black">About User Powers</h4>
            <p class="mt-4.5 text-sm font-normal">
              Welcome to our organization's ticketing system! As a valued user, you have the ability
              to raise tickets for any issues you encounter within the organization. Simply submit a
              ticket to the relevant resolver department team, and our dedicated resolvers will work
              diligently to address your concerns. Rest assured that your issues will be promptly
              resolved or appropriately rejected if necessary. Our administrative team oversees all
              processes, ensuring smooth operations and providing support where needed. Thank you
              for being an integral part of our organization's problem-solving process.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import TopHeading from './TopHeading.vue'
import { ref } from 'vue'
import { getCookie } from '../../helper/CookieHelper.js'
import apiClient from '../../services/api.js'
import Loader from '../Resolver/Loader.vue'
const loading = ref(false)

const User = ref({})
const UserImage = ref('')
const name = ref('')
const fetchUser = () => {
  loading.value = true
  apiClient
    .get(`/api/users/${getCookie('userId')}`)
    .then((res) => {
      User.value = res.data.data.attributes
      if (User.value.img !== '') UserImage.value = User.value.img
      else UserImage.value = './profile.png'

      name.value = User.value.name
      loading.value = false
    })
    .catch((error) => {
      console.log(error)
    })
}

fetchUser()
</script>

<style scoped>
.cont {
  display: flex;
  background: #e2e2e2;
  padding: 0;
}
.body-cont {
  width: 60%;
  margin: 0 auto;
}
.contain {
  background-color: rgb(28 36 52);
  height: 25vh;
  width: 100%;
  display: flex;
  justify-content: center;
  font-size: 75px;
  font-weight: lighter;
  color: white;
}

.profile {
  border-radius: 100%;
}

.img-cont {
  width: 30%;
  margin-left: 2rem;
  position: absolute;
  top: 6rem;
  height: 150px;
  width: 150px;
  border: 10px solid white;
  border-radius: 100%;
}

.bottom-cont {
  display: flex;
  justify-content: space-between;
  flex-direction: column;
  gap: 2rem;
  margin-top: 7rem;
}

.form-cont {
  padding-left: 2.5rem;
}
.name {
  font-size: 3rem;
}

.email {
  font-size: 1.3rem;
  color: gray;
}

.btm-right {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 2rem;
}

.first {
  height: 120px;
  width: 200px;
  padding: 1rem;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.644);
  background-color: white;
}

.first p {
  font-size: 2.5rem;
}

#chart {
  background: white;
  padding: 1rem;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.644);
}

.load {
  font-size: 10px;
  text-align: center;
}

.logout {
  position: fixed;
  top: 1rem;
  right: 15px;
  background: rgb(28 36 52);
  color: white;
  padding: 1.2rem;
  border-radius: 100%;
  z-index: 100;
  transition: all 0.3s ease;
}

.logout:hover {
  transform: translateY(10%) scale(1.1);
  cursor: pointer;
}
</style>
