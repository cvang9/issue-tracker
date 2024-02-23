<template>
  <div class="container">
    <!-- <button @click="fetchTickets">Hello</button> -->
    <button class="profile-button" @click="goToProfile">
      <img :src="user" alt="Profile Icon">
    </button>
    <div class="issue" v-for="issue in issues" :key="issue.id">
      <div class="state-badge" :class="getStateClass(issue.data.attributes.status)">
      {{ issue.data.attributes.status }}
      </div>
      <div class="user-info">
        <img :src="profile" :alt="issue.username">
        <span class="username">{{ issue.data.attributes.user.data.attributes.name }}</span>
      </div>
      <div class="issue-details">
        <h2 class="issue-title">{{ issue.data.attributes.body }}</h2>
        <p class="issue-query">{{ issue.data.attributes.body }}</p>
        <div class="issue-meta">
          <button class="category">{{ issue.data.attributes.department.data.attributes.name }}</button>
          <span class="posted-at">Posted {{ issue.postedAt }}</span>
        </div>
      </div>
    </div>
    <button class="add-button" @mouseover="showRaiseIssueText" @mouseout="hideRaiseIssueText" @click="showTicketForm = true">+</button>
    <div class="raise-issue-text" v-show="showText">Raise your Issue</div>

    <div class="modal" v-if="showTicketForm">
      <div class="modal-content">
        <span class="close-button" @click="showTicketForm = false">&times;</span>
        <TicketForm />
      </div>
    </div>
  </div>
</template>

<script setup>

// import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import profile from './profile.png'
import user from './user.png'
import TicketForm from './TicketForm.vue';
import apiClient from "../../services/api.js"

  const issues = ref([]);

  // const fetchTickets = () => {
    apiClient.get('/api/tickets')
      .then(res => {
        console.log(res.data.data);
        issues.value = res.data.data;
        // console.log(issues._rawValue);
        // console.log(issues.value[0]);
      })
      .catch(error => {
        console.log(error);
      })
  // }
    // const issues = ref([
    //   {
    //     id: 1,
    //     title: "How to learn programming?",
    //     query: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vulputate tempor libero. Maecenas ultricies eleifend magna, at malesuada nisi imperdiet a. Etiam ipsum arcu, ullamcorper eget finibus non, accumsan nec mauris. Mauris scelerisque leo eget turpis tincidunt hendrerit. Praesent efficitur mauris facilisis vulputate molestie.",
    //     category: "Programming",
    //     userImage: profile,
    //     username: "User 1",
    //     postedAt: "2 hours ago"
    //   },
    //   {
    //     id: 2,
    //     title: "What are some good books for learning JavaScript?",
    //     query: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vulputate tempor libero. Maecenas ultricies eleifend magna, at malesuada nisi imperdiet a. Etiam ipsum arcu, ullamcorper eget finibus non, accumsan nec mauris. Mauris scelerisque leo eget turpis tincidunt hendrerit. Praesent efficitur mauris facilisis vulputate molestie.",
    //     category: "JavaScript",
    //     userImage: profile,
    //     username: "User 2",
    //     postedAt: "5 hours ago"
    //   }
    //   // Add more issues as needed
    // ]);

    const router = useRouter();
    const showText = ref(false);
    const showTicketForm = ref(false);

    const openTicketForm = () => {
      router.push('/ticketForm');
    };

    const showRaiseIssueText = () => {
      showText.value = true;
    };

    const hideRaiseIssueText = () => {
      showText.value = false;
    };

    const getStateClass = (state) => {
      switch (state) {
        case "pending":
          return "pending";
        case "reject":
          return "reject";
        case "resolve":
          return "resolve";
        case "processing":
          return "processing";
        default:
          return "";
      }
    };

    // const closeTicketForm = () => {
    //   showTicketForm = false;
    // }
</script>

<style scoped>
.container {
  position: relative;
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.issue {
  margin-bottom: 20px;
  padding: 20px;
  background-color: rgb(249, 244, 234);
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.issue:hover {
  box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
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

.issue-title {
  margin-top: 0;
  margin-bottom: 10px;
  font-size: 1.2rem;
}

.issue-query {
  margin-bottom: 15px;
  font-size: 1rem;
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
  width: 60px;
  height: 60px;
  border: none;
  border-radius: 50%;
  background-color: #007bff;
  color: #fff;
  font-size: 2.5rem;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.add-button:hover {
  background-color: #0056b3;
  transform: translateY(-10px) scale(1.05);
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
  right: 160px; 
  transform: translateX(50%);
  font-size: 1rem;
  font-weight: 400;
  color: #007bff;
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
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 100;
}

.modal-content {
  position: relative;
  background-color: #fefefe;
  border-radius: 10px;
  padding: 2rem;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
</style>
