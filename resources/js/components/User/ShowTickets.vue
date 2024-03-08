<template>
  <user-dashboard>
    <div class="container" :class="showTicketForm ? 'cont-dis' : ''">
      <div class="contain">
        <top-heading head="Your Issues :"></top-heading>
      </div>

      <div class="load">
        <Loader v-if="loading" />
      </div>
      <div v-if="!loading && showAllIssues.length == 0" class="issue-head">
        No Issue raised yet
        <p>Raise one By clicking on below +</p>
      </div>
      <div class="issue-cont" v-if="!loading && showAllIssues.length">
        <div class="btn-upper">
          <button class="show" id="all" @click="showBtn('all')">
            <span>Show all Issues</span> {{ showAllIssues.length }}
          </button>
          <button class="show" id="resolved" @click="showBtn('resolved')">
            <span>Resolved Issues</span> {{ resolveIssues.length }}
          </button>
          <button class="show" id="processing" @click="showBtn('processing')">
            <span>Processing Issues</span> {{ processingIssues.length }}
          </button>
          <button class="show" id="pending" @click="showBtn('pending')">
            <span>Pending Issues</span> {{ pendingIssues.length }}
          </button>
          <button class="show" id="rejected" @click="showBtn('rejected')">
            <span>Rejected Issues</span> {{ rejectedIssues.length }}
          </button>
        </div>
        <div class="issue-head" v-if="issues.length === 0">No Issues in this state</div>
        <div class="relative mx-8 my-1" v-for="issue in issues" :key="issue.id">
          <div
            class="p-8 border border-black bg-white rounded-xl z-20"
            :class="
              issue.data.attributes.status === 'processing'
                ? 'purple_border'
                : issue.data.attributes.status === 'resolved'
                  ? 'green_border'
                  : issue.data.attributes.status === 'pending'
                    ? 'yellow_border'
                    : 'red_border'
            "
          >
            <p
              class="font-mono font-bold"
              :class="
                issue.data.attributes.status === 'processing'
                  ? 'text-blue-700'
                  : issue.data.attributes.status === 'resolved'
                    ? 'text-green-500'
                    : issue.data.attributes.status === 'pending'
                      ? 'text-yellow-500'
                      : 'text-red-500'
              "
            >
              {{ issue.data.attributes.title }}
            </p>
            {{ issue.data.attributes.body }}
            <div class="flex justify-between mt-4 mb-3">
              <div
                class="rounded-md px-3 py-1 text-white"
                :class="
                  issue.data.attributes.status === 'processing'
                    ? 'bg-blue-700'
                    : issue.data.attributes.status === 'resolved'
                      ? 'bg-green-500'
                      : issue.data.attributes.status === 'pending'
                        ? 'bg-yellow-500'
                        : 'bg-red-500'
                "
              >
                {{ issue.data.attributes.department.data.attributes.name }}
              </div>
              <div>
                <span class="posted-at">{{ issue.data.attributes.created_at }}</span>
              </div>
            </div>
            <div class="view" v-if="issue.data.attributes.feedback">
              <hr />
              <div>
                <p class="mt-2 font-bold">Resolver feedback</p>
                <p>{{ issue.data.attributes.feedback }}</p>
              </div>
            </div>
          </div>
        </div>
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
        <TicketForm @formSubmitted="handleFormSubmitted" @close="showTicketForm = false" />
      </div>
    </div>
  </user-dashboard>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import UserDashboard from './UserDashboard.vue'
import Loader from '../Resolver/Loader.vue'
import apiClient from '../../services/api.js'
import TopHeading from './TopHeading.vue'
import TicketForm from './TicketForm.vue'
import { toast } from 'vue3-toastify'

const issues = ref([])
const showAllIssues = ref([])
const resolveIssues = ref([])
const processingIssues = ref([])
const rejectedIssues = ref([])
const pendingIssues = ref([])
const showText = ref(false)
const loading = ref(false)
const showTicketForm = ref(false)
import { getCookie } from '../../helper/CookieHelper.js'

const fetchTickets = (str) => {
  if (str != '0') loading.value = true
  apiClient
    .get(`/api/users/${getCookie('userId')}/tickets`)
    .then((res) => {
      issues.value = res.data.data
      issues.value.reverse()

      showAllIssues.value = issues.value
      resolveIssues.value = []
      processingIssues.value = []
      rejectedIssues.value = []
      pendingIssues.value = []
      issues.value.forEach((e) => {
        if (e.data.attributes.status === 'resolved') resolveIssues.value.push(e)
        if (e.data.attributes.status === 'processing') processingIssues.value.push(e)
        if (e.data.attributes.status === 'rejected') rejectedIssues.value.push(e)
        if (e.data.attributes.status === 'pending') pendingIssues.value.push(e)
      })
    })
    .then(() => {
      showTicketForm.value = false
      if (str == '0') {
        toast.success('Issue Created Successfully', {
          autoClose: 1000
        })
      }
      loading.value = false
    })
    .catch((error) => {
      console.log(error)
      loading.value = false
    })
}
onMounted(() => {
  fetchTickets()
})

const showBtn = (val) => {
  loading.value = true
  switch (val) {
    case 'pending':
      issues.value = pendingIssues.value
      break
    case 'rejected':
      issues.value = rejectedIssues.value
      break
    case 'resolved':
      issues.value = resolveIssues.value
      break
    case 'processing':
      issues.value = processingIssues.value
      break
    default:
      issues.value = showAllIssues.value
  }
  loading.value = false
}

const handleFormSubmitted = () => {
  fetchTickets('0')
}

const showRaiseIssueText = () => {
  showText.value = true
}

const hideRaiseIssueText = () => {
  showText.value = false
}
</script>

<style scoped>
.cont {
  display: flex;
  background: rgba(216, 216, 216, 0.53);
}

.cont-dis {
  height: 100vh;
  overflow-y: hidden;
}

.contain {
  background-color: rgb(28 36 52);
  height: 18vh;
  width: 100%;
  margin: auto;
  display: flex;
  justify-content: center;
  font-size: 75px;
  font-weight: lighter;
  margin-bottom: 2rem;
  color: white;
  text-shadow: 5px 5px 5px rgba(164, 164, 164, 0.338);
}

.container {
  position: relative;
  width: 60%;
  margin: 0 auto;
}

h1 {
  text-align: center;
  margin-bottom: 1rem;
  font-size: 2rem;
}
.btn-upper {
  text-align: center;
}
.btn-upper button {
  text-align: center;
  padding: 1rem;
  margin: 0.5rem;
  background-color: gray;
  padding: 0.3rem 1rem 0.3rem 0rem;
  color: white;
  border-radius: 0.5rem;
  text-shadow: 2px 1px rgba(0, 0, 0, 0.338);
}

.btn-upper button span {
  padding: 0.5rem;
  border-radius: 0.5rem;
  box-shadow: 1px 1px 5px black;
  margin-right: 0.5rem;
  text-shadow: none;
}

#all span {
  background-color: black;
  color: white;
}

#pending span {
  background-color: #ffc107; /* Yellow */
}

#rejected span {
  background-color: #dc3545; /* Red */
}

#resolved span {
  background-color: #28a745; /* Green */
}

#processing span {
  background-color: #007bff; /* Blue */
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

.issue-head {
  font-size: 35px;
  border: dotted;
  text-align: center;
  padding: 2rem;
  text-transform: uppercase;
}

.issue-head p {
  font-size: 20px;
  color: gray;
  text-transform: lowercase;
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
  background-color: white;
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

.rejected {
  background-color: #dc3545; /* Red */
}

.resolved {
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
  cursor: default;
}

.posted-at {
  color: gray;
}

.view {
  position: relative;
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
}

.close-button {
  position: absolute;
  top: 0px;
  right: 15px;
  cursor: pointer;
  font-size: 2rem;
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
