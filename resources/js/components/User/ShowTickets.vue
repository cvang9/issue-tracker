<template>
  <div class="cont">
    <side-bar :id="4"></side-bar>
    <div class="container">
      <div class="contain">
        <temp-file head="Your Issues :"></temp-file>
      </div>
      
      <div class="load">
        <Loader v-if="loading" />
      </div>
      <div v-if="!loading && issues.length == 0">No Issue raised yet</div>
      <div class="issue-cont" v-if="!loading">

        <div class="relative mx-16 my-4" v-for="issue in issues" :key="issue.id" >

            <span class="absolute -z-10 w-full h-full inset-1 rounded-xl" > Hello </span>
            <p class="absolute py-1 z-10 px-3 -left-8 -top-2 -rotate-[10deg] black_border text-white font-bold" :class="issue.data.attributes.status === 'processing' ? 'bg-blue-700' : issue.data.attributes.status === 'resolved' ?  'bg-green-500' : issue.data.attributes.status === 'pending' ? 'bg-yellow-500' : 'bg-red-500' ">
            {{ issue.data.attributes.status }}
            </p>

            <div class="p-8 border border-black  bg-white rounded-xl z-20" :class="issue.data.attributes.status === 'processing' ? 'purple_border' : issue.data.attributes.status === 'resolved' ?  'green_border' : issue.data.attributes.status === 'pending' ? 'yellow_border' : 'red_border' ">
                <p class="font-mono  font-bold" :class="issue.data.attributes.status === 'processing' ? 'text-blue-700' : issue.data.attributes.status === 'resolved' ?  'text-green-500' : issue.data.attributes.status === 'pending' ? 'text-yellow-500' : 'text-red-500' ">{{ issue.data.attributes.title }} </p>
                {{ issue.data.attributes.body }}
                <div class="flex justify-between mt-4 mb-3">
                    <div class=" rounded-md px-3 py-1 text-white" :class="issue.data.attributes.status === 'processing' ? 'bg-blue-700' : issue.data.attributes.status === 'resolved' ?  'bg-green-500' : issue.data.attributes.status === 'pending' ? 'bg-yellow-500' : 'bg-red-500' ">
                        {{ issue.data.attributes.department.data.attributes.name }}
                    </div>
                    <div>
                        <span class="posted-at">{{ issue.data.attributes.created_at }}</span>
                    </div>
                </div>
                <div class="view"  v-if="issue.data.attributes.feedback">
                    <hr/>
                    <div>
                        <p class="mt-2 font-bold ">Resolver feedback</p>
                        <p>{{ issue.data.attributes.feedback }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="issue" v-for="issue in issues" :key="issue.id">
          <div class="state-badge" :class="getStateClass(issue.data.attributes.status)">
        {{ issue.data.attributes.status }}
        </div>
          <div class="bar w-full bg-neutral-200 dark:bg-neutral-600">
            <div
              class="bg-black p-0.5 text-center text-xs font-medium leading-none text-primary-100"
              :style="{ width: CalcProgress(issue.data.attributes.status) }"
            >
              {{ CalcProgress(issue.data.attributes.status) }}
            </div>
          </div>
          <div class="issue-details">
            <h2 class="issue-title">{{ issue.data.attributes.title }}</h2>
            <p class="issue-query">{{ issue.data.attributes.body }}</p>
            <div class="issue-meta">
              <button class="category">
                {{ issue.data.attributes.department.data.attributes.name }}
              </button>
              <span class="posted-at">{{ issue.data.attributes.created_at }}</span>
            </div>
          </div>
            <div class="view"  v-if="issue.data.attributes.feedback">
              <div class="feedback">
              <h2>Feedback</h2>
              <p>{{ issue.data.attributes.feedback }}</p>
              </div>
            </div> 
    
        </div>-->
    
      </div>
    </div> 
    <button
      class="add-button"
      @mouseover="showRaiseIssueText"
      @mouseout="hideRaiseIssueText"
      @click="showTicketForm = true"
    >
      +
    </button>
    <div class="raise-issue-text" v-show="showText">Raise your Issue</div>

    <div class="modal" v-if="showTicketForm">
      <div class="modal-content">
        <!-- <span class="close-button" @click="showTicketForm = false">&times;</span> -->
        <TicketForm @formSubmitted="handleFormSubmission"  @close="showTicketForm = false"/>
      </div>
    </div>
  </div>
</template>

<script setup>
// import axios from 'axios';
import { ref } from 'vue'
import Loader from '../Resolver/Loader.vue'
import SideBar from './SideBar.vue'
import apiClient from '../../services/api.js'
import TempFile from './TempFile.vue'
import TicketForm from './TicketForm.vue'
// import { Progress } from "@material-tailwind/react";

const issues = ref([])
const showText = ref(false)
const loading = ref(false)
const showTicketForm = ref(false)
import { getCookie } from '../../helper/CookieHelper.js'

const fetchTickets = (str) => {
  if (str != '0') loading.value = true
  apiClient
    .get(`/api/users/${getCookie('userId')}/tickets`)
    .then((res) => {
      console.log(res.data.data)
      issues.value = res.data.data
      issues.value.reverse()
      loading.value = false
      // console.log(issues._rawValue);
      // console.log(issues.value[0]);
    })
    .catch((error) => {
      console.log(error)
      loading.value = false
    })
}

fetchTickets()

const CalcProgress = (state) => {
  switch (state) {
    case 'pending':
      return '0%'
    case 'reject':
      return '100%'
    case 'resolve':
      return '100%'
    case 'processing':
      return '50%'
    default:
      return ''
  }
}

const handleFormSubmission = () => {
  fetchTickets('0')
  showTicketForm.value = false
}

const showRaiseIssueText = () => {
  showText.value = true
}

const hideRaiseIssueText = () => {
  showText.value = false
}

const convertDT = (dateString) => {
const date = new Date(dateString);
const formattedDate = `${date.getDate()} ${getMonthName(date.getMonth())} ${date.getFullYear()} ${formatHours(date.getHours())}:${formatMinutes(date.getMinutes())} ${getAMPM(date.getHours())}`;

return formattedDate;

}

function getMonthName(monthIndex) {
  const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  return months[monthIndex];
}

function formatHours(hours) {
  return hours % 12 || 12; // Convert to 12-hour format
}

function formatMinutes(minutes) {
  return minutes.toString().padStart(2, "0"); // Add leading zero if necessary
}


function getAMPM(hours) {
  return hours < 12 ? "AM" : "PM";
}

// const closeTicketForm = () => {
//   showTicketForm = false;
// }
</script>

<style scoped>
.cont {
  display: flex;
  background: white;
}

.contain {
  /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.644); */
  background-color: rgb(28 36 52);
  /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.644); */
  /* background-color: rgb(249, 244, 234); */
  height: 18vh;
  width: 100%;
  margin: auto;
  /* border-radius: 0 0 5rem 5rem; */
  /* margin: auto; */
  /* text-align: center; */
  display: flex;
  /* align-items: center; */
  justify-content: center;
  font-size: 75px;
  font-weight: lighter;
  margin-bottom: 2rem;
  color: white;
  /* text-transform: uppercase; */
}

.container {
  position: relative;
  width: 60%;
  margin: 0 auto;
  /* padding: 20px; */
}

h1 {
  text-align: center;
  margin-bottom: 1rem;
  font-size: 2rem;
}

.issue-cont {
  display: flex;
  flex-direction: column;
  gap: 3rem;
}

.issue {
  position: relative;
  gap: 2rem;
}

.issue-details:hover {
  box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}
.load {
  font-size: 10px;
  text-align: center;
}
.bar {
  float: right;
  width: 100px;
  position: relative;
  z-index: 100;
  margin: 1rem;
  color: white;
  border: 5px solid white;
  box-shadow: 1px 1px 5px black inset;
  /* border-radius: 2px; */
  background-color: white;
  /* transform: rotate(270deg); */
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

.state-badge {
  position: absolute;
  top: 10px;
  right: 10px;
  padding: 5px 10px;
  border-radius: 20px;
  font-size: 0.8rem;
  color: white;
  text-transform: uppercase;
  font-weight: bold;
  display: flex;
  align-items: center;
}

.pending {
  background-color: #ffc107; /* Yellow */
}

.reject {
  background-color: #dc3545; /* Red */
}

.resolve {
  background-color: #28a745; /* Green */
}

.processing {
  background-color: #007bff; /* Blue */
}

.state-badge span {
  margin-right: 5px;
}

.user-info {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
}

.user-info img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 15px;
}

.username {
  font-weight: bold;
}

.issue-details {
  background-color: rgb(249, 244, 234);
  border-radius: 10px 10px 0 0;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  position: relative;
  padding: 20px;
}

.issue-title {
  margin-top: 0;
  margin-bottom: 10px;
  font-size: 1.2rem;
}

.issue-query {
  margin-bottom: 15px;
  font-size: 1rem;
  color: gray;
}

.issue-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.category {
  padding: 5px 10px;
  font-size: 0.9rem;
  color: #777;
  background-color: #eee;
  border: 1px solid #ccc;
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.category:hover {
  background-color: #f0f0f0;
  border-color: #999;
  cursor:default;
}

.posted-at {
  color: gray;
}

.view {
  position: relative;
  /* bottom: -1rem; */
  /* top: 5rem; */
  width: 100%;
  height: 100%;
}

.feedback {
  background: rgb(242, 242, 242);
  box-shadow: 0px -12px 20px rgba(0, 0, 0, 0.36) inset;
  border-radius: 0 0 1rem 1rem;
  border: 2px dotted gray;
  border-top: 0;
  padding: 2rem;
}

.feedback h2 {
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
}

.profile-button {
  position: fixed;
  bottom: 100px;
  right: 20px;
  width: 60px;
  height: 60px;
  border: none;
  border-radius: 50%;
  /* background-color: #007bff; */
  color: #fff;
  font-size: 2.5rem;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  transition: transform 0.3s ease;
}

.profile-button img {
  width: 100%;
  height: 100%;
}

.profile-button:hover {
  transform: translateY(-10px) scale(1.05);
  /* transform: scale(1.05); */
}

.add-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 70px;
  height: 70px;
  border: none;
  border-radius: 50%;
  background-color: rgb(28 36 52);
  color: #fff;
  font-size: 2.5rem;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.add-button:hover {
  transform: translateY(-10%) scale(1.1);
}

.add-button::before,
.add-button::after {
  position: absolute;
  background-color: #fff;
  width: 2px;
  height: 30px;
  top: 50%;
  left: 50%;
}

.add-button::before {
  transform: translate(-50%, -50%);
}

.add-button::after {
  transform: translate(-50%, -50%) rotate(90deg);
}

.add-button:hover::after {
  font-size: 0.8rem;
  color: #fff;
  position: absolute;
  bottom: 70px;
  left: calc(50% - 70px);
  transform: translateX(-50%);
  padding: 5px 10px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.raise-issue-text {
  position: fixed;
  bottom: 30px;
  right: 180px;
  transform: translateX(50%);
  font-size: 1rem;
  font-weight: bold;
  color: rgb(28 36 52);
  background-color: #fff;
  padding: 10px 15px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease;
  z-index: 1;
  opacity: 0;
}

.add-button:hover + .raise-issue-text {
  opacity: 1;
}

.raise-issue-text:hover {
  background-color: #f0f0f0;
}

.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0;
  left: 9rem;
  width: 100%;
  height: 100%;
  margin: auto;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 100;
}

.modal-content {
  position: relative;
  /* background-color: #fefefe; */
  /* border-radius: 10px; */
  /* padding: 2rem; */
  /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); */
}

.close-button {
  position: absolute;
  top: 0px;
  right: 15px;
  cursor: pointer;
  /* padding: .5rem; */
  font-size: 2rem;
  /* background: #0056b3;
  border-radius: 100%; */
  padding: 0;
}

.purple_border {
    box-shadow: 4px 4px 1px rgb(34, 34, 206);
}

.green_border {
    box-shadow: 4px 4px 1px rgb(34, 206, 45);
}

.yellow_border {
    box-shadow: 4px 4px 1px rgb(207, 220, 27);
}

.red_border {
    box-shadow: 4px 4px 1px rgb(206, 71, 34);
}

.black_border {
    box-shadow: 4px 4px 1px rgb(0, 0, 0);
}

</style>