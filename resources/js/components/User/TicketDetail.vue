<template>
  <div class="ticket-card">
    <div class="ticket-header">
      <h2 class="ticket-title">Title</h2>
      <div class="ticket-state" :class="getStateClass(ticket.status)">
        {{ ticket.status }}
      </div>
    </div>
    <div class="ticket-details">
      <p class="ticket-query">
        <span class="bold">Query:</span> {{ ticket.body }}
      </p>
      <p class="ticket-posted-by">
        <span class="bold">Posted by:</span>
        {{ ticket.user.data.attributes.name }}
      </p>
      <p v-if="1" class="ticket-feedback">
        <span class="bold">Feedback:</span> Lorem ipsum dolor sit amet,
        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRoute } from "vue-router";
import apiClient from "../../services/api";

const ticket = ref({});

const fetchTicketDetails = () => {
  // Access route parameter
  const route = useRoute();
  const ticketId = route.params.id;

  apiClient
    .get("/api/tickets/" + ticketId)
    .then((res) => {
      console.log(res.data.data.attributes);
      ticket.value = res.data.data.attributes;
      // console.log(issues._rawValue);
      // console.log(issues.value[0]);
    })
    .catch((error) => {
      console.log(error);
    });
  // Fetch ticket details using ticketId
  // Assign the fetched ticket details to 'ticket' ref
};

fetchTicketDetails();
const getStateClass = (state) => {
  switch (state) {
    case "pending":
      return "pending-state";
    case "reject":
      return "reject-state";
    case "processing":
      return "processing-state";
    case "resolve":
      return "resolve-state";
    default:
      return "";
  }
};
</script>

<style scoped>
.ticket-card {
  background-color: rgb(249, 244, 234);
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  padding: 20px;
  margin-bottom: 20px;
}

.ticket-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.ticket-title {
  font-size: 1.5rem;
  font-weight: bold;
  color: #333;
  margin: 0;
}

.ticket-state {
  font-size: 0.8rem;
  padding: 5px 10px;
  border-radius: 20px;
  color: #fff;
  text-transform: uppercase;
  display: flex;
  align-items: center;
}

.pending-state {
  background-color: #ffb048;
}

.reject-state {
  background-color: #f44336;
}

.processing-state {
  background-color: #2196f3;
  color: #fff;
}

.resolve-state {
  background-color: #4caf50;
  color: #fff;
}

.bold {
  font-weight: bold;
}

.ticket-details p {
  margin: 5px 0;
}
</style>