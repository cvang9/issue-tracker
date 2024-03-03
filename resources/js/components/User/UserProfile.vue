<template>
<div class="cont">
  <side-bar></side-bar>
<div class="body-cont">

    <div
    >
      <div class="z-20 h-35 md:h-65">
        <img
          src="../../assets/img/cover-02.jpg"
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

            <img :src="`http://[::1]:5173/storage/app/uploads/user-06.png`" />

          </div>
        </div>
        <div class="mt-4">
          <h3 class="mb-1.5 text-2xl font-medium text-black dark:text-white">User</h3>
          <!-- <p class="font-medium dark:text-white"></p> -->
          <p class="font-medium dark:text-white">Joined us: last year</p>
          <div
            class="mx-auto mt-4.5 mb-5.5  max-w-94 rounded-md border border-stroke py-2.5 shadow-1 dark:border-strokedark dark:bg-[#37404F]"
          >
          <span class="font-semibold text-black dark:text-white">User ( Issue Tracking System ) </span>
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
    <!-- <div class="container">
        <temp-file head="Hi User :"></temp-file>
    </div>

    <div class="img-cont"> 
    <img :src="profile" alt=""> 

    </div>
    <div class="load">
        <Loader v-if="loading" />
      </div>
    <div class="bottom-cont" v-if="!loading">
        <div class="form-cont">
            <div class="name">
                <p>{{User.name}}</p>
            </div>
            <div class="email">
                <p>{{User.email}}</p>
            </div>
        </div>
        <div class="btm-right">
            <div class="first" id="one">Total Raised Issues<p>100</p></div>
            <div class="first" id="two">Resolved Issues<p>40</p></div>
            <div class="first" id="three">Pending Issues<p>20</p></div>
            <div class="first" id="four">Rejected Issues<p>40</p></div>
        </div>
        <div id="chart">
        <vue-apex-charts type="bar" height="150" :options="chartOptions" :series="series"></vue-apex-charts>
      </div>
    </div> -->
</div>

</div>
</template>

<script setup>
import profile from "./profile.png"
import tempFile from "./TempFile.vue"
import SideBar from "./SideBar.vue"
import VueApexCharts from 'vue3-apexcharts'
import { ref } from "vue"
import { getCookie } from '../../helper/CookieHelper.js'
import apiClient from '../../services/api.js'
import Loader from '../Resolver/Loader.vue'

const series = ref([{data: [4, 3, 7]}])
const loading = ref(false)
const chartOptions = ref({
            chart: {
              type: 'bar',
              height: 500
            },
            plotOptions: {
              bar: {
                borderRadius: 4,
                horizontal: true,
              }
            },
            dataLabels: {
              enabled: false
            },
            xaxis: {
              categories: ['Management', 'Technical', 'Security'
              ],
            }
          })

const User = ref({});
const fetchUser = () => {
  apiClient
    .get(`/api/users/${getCookie('userId')}`)
    .then((res) => {
      User.value = res.data.data.attributes;
    })
    .catch((error) => {
      console.log(error)
    })
}

fetchUser();

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
    .container {
  /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.644); */
        background-color: rgb(28 36 52);
        /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.644); */
        /* background-color: rgb(249, 244, 234); */
        height: 18vh;
        width: 100%;
        /* border-radius: 0 0 5rem 5rem; */
        /* margin: auto; */
        /* text-align: center; */
        display: flex;
        /* align-items: center; */
        justify-content: center;
        font-size: 75px;
        font-weight: lighter;
        color: white;
        /* text-transform: uppercase; */
    }

    .img-cont {
        width: 30%;
        margin-left: 2rem;
        /* display: flex;
        justify-content: center; */
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
        /* flex-direction: column; */
        gap: 2rem;
    }

    .first {
        height: 120px;
        width: 200px;
        padding: 1rem;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.644);
        background-color: white;
    }

    .first p{
        font-size: 2.5rem;
    }

    #chart {
        background: white;
        padding: 1rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.644);
        /* background-color: rgb(249, 244, 234); */
        /* margin: 0 1.4rem; */
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