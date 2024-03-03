<template>
<div class="cont">
  <side-bar></side-bar>
<div class="body-cont">
    <div class="container">
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
    </div>
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