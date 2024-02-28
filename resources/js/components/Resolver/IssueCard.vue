<template>
  <div
    :class="[
      darkMode ? 'dark-card-main-div shadow-2xl px-4 py-3' : 'card-main-div shadow-2xl px-4 py-3'
    ]"
  >
    <div :class="[darkMode ? 'dark-card-div-header' : 'card-div-header']">
      <img :src="profile" alt="none" />
      <p class="mr-5">
        {{ card.data.attributes.user.data.attributes.name }}
      </p>
    </div>
    <!-- <h2>Title of the issue</h2> -->
    <p>
      {{ card.data.attributes.body }}
    </p>
    <div :class="[darkMode ? 'dark-card-button' : 'card-button']">
      <p :class="getStateClass">{{ card.data.attributes.status }}</p>
      <button
        v-show="
          card.data.attributes.status === 'pending' || card.data.attributes.status === 'processing'
        "
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-4 rounded"
        @click="toogle = !toogle"
      >
        {{ toogle ? 'Close' : 'Open' }}
      </button>
    </div>
    <div class="chat">
      <router-link :to="`/chat?role=resolver&friendId=${card.data.attributes.user.data.user_id}`">
        <img class="chat-image" src="./chat.png" alt="none"
      /></router-link>
    </div>
    <transition name="fade">
      <div v-if="toogle" :class="[darkMode ? 'dark-feedback' : 'feedback']">
        <textarea style="width: 100%" v-model="feedback" placeholder="resolve query"></textarea>
        <button
          :disabled="!feedback"
          class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mr-4"
          @click="resolve"
        >
          Resolve
        </button>
        <button
          :disabled="!feedback"
          class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mr-4"
          @click="rejected"
        >
          Reject
        </button>
        <button
          :disabled="!feedback"
          class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mr-4"
          @click="processing"
        >
          Processing
        </button>
      </div>
    </transition>
  </div>
</template>
<script>
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import apiClient from '../../services/api.js'
export default {
  props: ['card', 'darkMode'],
  emits: ['loadagain'],
  data() {
    return {
      toogle: false,
      feedback: '',
      status: 'pending',
      profile: 'http://[::1]:5173/storage/app/uploads/user.png'
    }
  },
  onmounted() {
    if (this.card.data.attributes.user.data.attributes.img !== '') {
      this.profile = `http://[::1]:5173/storage/app/uploads/${this.card.data.attributes.user.data.attributes.img}`
    }
  },
  computed: {
    getStateClass() {
      switch (this.card.data.attributes.status) {
        case 'pending':
          return 'pending'
        case 'rejected':
          return 'rejected'
        case 'resolved':
          return 'resolved'
        case 'processing':
          return 'processing'
        default:
          return ''
      }
    },
    resolve() {
      this.status = 'resolved'
      const payload = {
        feedback: this.feedback,
        status: this.status
      }
      this.toggle = !this.toggle
      apiClient
        .put(`/api/resolvers/${this.$route.params.id}/tickets/${this.card.data.ticket_id}`, payload)
        .then((response) => {
          console.log(response.data)
          this.$emit('loadagain')
        })
        .catch((error) => {
          toast.error('Error occured,Please try again later', {
            autoClose: 1000
          })
          console.log(error)
        })
    },
    rejected() {
      this.status = 'rejected'
      this.toggle = !this.toggle
      const payload = {
        feedback: this.feedback,
        status: this.status
      }
      apiClient
        .put(`/api/resolvers/${this.$route.params.id}/tickets/${this.card.data.ticket_id}`, payload)
        .then((response) => {
          console.log(response.data)
          this.$emit('loadagain')
        })
        .catch((error) => {
          toast.error('Error occured,Please try again later', {
            autoClose: 1000
          })
          console.log(error)
        })
    },
    processing() {
      this.status = 'processing'
      const payload = {
        feedback: this.feedback,
        status: this.status
      }
      this.toggle = !this.toggle
      apiClient
        .put(`/api/resolvers/${this.$route.params.id}/tickets/${this.card.data.ticket_id}`, payload)
        .then((response) => {
          console.log(response.data)
          this.$emit('loadagain')
        })
        .catch((error) => {
          toast.error('Error occured,Please try again later', {
            autoClose: 1000
          })
          console.log(error)
        })
    }
  }
}
</script>
<style scoped>
.card-main-div {
  min-height: 15vmax;
  transition: all 0.5s;
  border-radius: 10px;
}
.card-main-div:hover {
  transform: scale(1.03);
}
.card-div-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 4px;
}
.card-div-header > img {
  width: 4vmax;
  border-radius: 50%;
}
.card-button {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 8px;
}
.feedback {
  width: 100%;
  margin-top: 1vmax;
  border-radius: 10px;
}
.feedback > textarea {
  padding: 1vmax 1vmax;
  margin-bottom: 1vmax;
}
textarea:focus {
  outline: none;
}
h2 {
  font-family: 'Courier New', Courier, monospace;
  font-size: 1.2vmax;
  font-weight: 650;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.pending {
  padding: 0.5vmax 0.5vmax;
  color: white;
  border-radius: 4px;
  background-color: #ffc107; /* Yellow */
}
.rejected {
  padding: 0.5vmax 0.5vmax;
  border-radius: 4px;
  color: white;
  background-color: #dc3545; /* Red */
}
.resolved {
  padding: 0.5vmax 0.5vmax;
  border-radius: 4px;
  color: white;
  background-color: #28a745; /* Green */
}
.processing {
  padding: 0.5vmax 0.5vmax;
  border-radius: 4px;
  color: white;
  background-color: #007bff; /* Blue */
}

.chat {
  color: grey;
  margin: 1vmax 0;
  border-radius: 5px;
  padding: 0.5vmax 0;
  width: 20%;
}
.chat-image {
  height: 40px;
}
/* Dark mode */
.dark-card-main-div {
  min-height: 15vmax;
  transition: all 0.5s;
  border-radius: 10px;
  /* border: 1px solid white; */
  background-color: rgba(235, 235, 235, 0.342);
  color: rgb(255, 255, 255);
}
.dark-card-main-div:hover {
  transform: scale(1.03);
}
.dark-card-div-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 4px;
}
.dark-card-div-header > img {
  width: 4vmax;
  border-radius: 50%;
}
.dark-card-button {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.dark-feedback {
  width: 100%;
  margin-top: 1vmax;
  border-radius: 10px;
}
.dark-feedback > textarea {
  padding: 1vmax 1vmax;
  margin-bottom: 1vmax;
  background-color: rgb(160, 159, 159);
  color: white;
}
textarea:focus {
  outline: none;
}
h2 {
  font-family: 'Courier New', Courier, monospace;
  font-size: 1.2vmax;
  font-weight: 650;
}
</style>