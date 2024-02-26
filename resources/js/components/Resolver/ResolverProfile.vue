<template>
  <form v-if="user">
    <div :class="[darkMode ? 'dark-profile-main-div shadow-2xl' : 'profile-main-div shadow-2xl']">
      <div :class="[darkMode ? 'dark-profile-left-div' : ' profile-left-div']">
        <p :class="[darkMode ? 'dark-heading' : 'heading']">My Profile</p>
        <p>Name</p>
        <input type="text" placeholder="name" readonly v-model="name" />
        <p>Email</p>
        <input type="email" placeholder="email" readonly v-model="email" />
        <p>Department</p>
        <input type="text" placeholder="department" readonly v-model="department" />
        <div @click="goback" :class="[darkMode ? 'dark-edit-button' : 'edit-button']">
          <button>Back to Issues</button>
        </div>
      </div>
      <div :class="[darkMode ? 'dark-profile-right-div' : 'profile-right-div']">
        <img :src="profile" alt="resolver" />
        <P style="font-size: 2vmax">Department- {{ department }}</P>
        <p style="color: green">
          Ticket resolved -
          {{ user?.data?.attributes?.counts?.resolved_tickets }}
        </p>
        <p style="color: red">
          Ticket rejected -
          {{ user?.data?.attributes?.counts?.rejected_tickets }}
        </p>
        <p>
          Ticket processing -
          {{ user?.data?.attributes?.counts?.processing_tickets }}
        </p>
      </div>
    </div>
  </form>
  <div v-else :class="[darkMode ? 'dark-loading' : 'loading']">
    <div></div>
  </div>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import apiClient from '../../services/api.js'
const user = ref('')
const route = useRoute()
const name = ref('')
const profile = ref('http://[::1]:5173/storage/app/uploads/profile.png')
const router = useRouter()
const department = ref('')
const darkMode = ref(false)
const loading = ref(false)
const email = ref('email')
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
    })
    .catch((error) => {
      console.log(error)
    })
  loading.value = false
}
function goback() {
  router.push(`/resolver/${route.params.id}`)
}
onMounted(() => {
  if (localStorage.getItem('dark')) {
    darkMode.value = true
  }
  loadUser()
})
</script>
<style scoped>
.profile-main-div {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  background-color: rgb(243, 237, 237);
  height: 100vh;
  padding: 4vmax 4vmax;
  gap: 4vmax;
}
.profile-left-div {
  width: 50%;
  background-color: white;
  padding: 2vmax 2vmax;
  border-radius: 15px;
}
.heading {
  text-align: center;
  font-weight: 600;
  font-size: 1.8vmax;
  color: rgb(133, 127, 127);
  font-family: Verdana, Geneva, Tahoma, sans-serif;
}
.profile-left-div > input {
  padding: 1vmax 1vmax;
  color: black;
  width: 100%;
  border: 1px solid rgb(123, 123, 207);
  border-radius: 5px;
  outline: none;
  margin: 0.5vmax 0;
}
.profile-left-div > {
  outline: none;
}
.profile-right-div {
  width: 40%;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.profile-right-div > img {
  margin-top: 2vmax;
  margin-left: 2vmax;
  width: 90%;
  border-radius: 50%;
  border: 1px solid rgb(123, 123, 207);
  margin-bottom: 2vmax;
}
.edit-button {
  padding: 0.8vmax 0;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid rgb(123, 123, 207);
  background-color: rgb(123, 123, 207);
  border-radius: 10px;
  margin-top: 1vmax;
  color: white;
  font-size: 1.3vmax;
  transition: all 0.5s;
}
.edit-button:hover {
  background-color: white;
  border: 1px solid rgb(123, 123, 207);
  color: rgb(123, 123, 207);
  cursor: pointer;
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

/* dark mode */
.dark-profile-main-div {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  background-color: #3a3a3a;
  height: 100vh;
  padding: 4vmax 4vmax;
  gap: 4vmax;
  color: white;
}
.dark-profile-left-div {
  width: 50%;
  background-color: #727070;
  padding: 2vmax 2vmax;
  border-radius: 15px;
}
.dark-heading {
  text-align: center;
  font-weight: 600;
  font-size: 1.8vmax;
  color: white;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
}
.dark-profile-left-div > input {
  padding: 1vmax 1vmax;
  color: black;
  width: 100%;
  border: 1px solid #3a3a3a;
  border-radius: 5px;
  outline: none;
  margin: 0.5vmax 0;
}
.dark-profile-left-div > {
  outline: none;
}
.dark-profile-right-div {
  width: 40%;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.dark-profile-right-div > img {
  margin-top: 2vmax;
  margin-left: 2vmax;
  width: 90%;
  border-radius: 50%;
  border: 1px solid #3a3a3a;
  margin-bottom: 2vmax;
}
.dark-edit-button {
  padding: 0.8vmax 0;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #3a3a3a;
  background-color: white;
  border-radius: 10px;
  margin-top: 1vmax;
  color: black;
  font-size: 1.3vmax;
  transition: all 0.5s;
}
.dark-edit-button:hover {
  cursor: pointer;
}
.dark-loading {
  width: 100vw;
  height: 100vh;
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
</style>