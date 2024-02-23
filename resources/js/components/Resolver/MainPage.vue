<template>
  <div class="main-div">
    <div class="left-div">
      <img
        src="https://qph.fs.quoracdn.net/main-qimg-2b21b9dd05c757fe30231fac65b504dd"
        alt="resolver"
      />
      <p>Shivam Teotia</p>
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4"
      >
        <router-link to="/resolver-profile"> My Profile </router-link>
      </button>
    </div>
    <div class="right-div">
      <p>Your Department Related Issues</p>
      <div v-for="item in 5" :key="item" class="right-div-card">
        <issue-card />
      </div>
    </div>
  </div>
</template>


<script>

import IssueCard from "./IssueCard.vue";
import apiClient from "../../services/api.js";

export default {

    components: {
        'issue-card' : IssueCard
    },

    setup() {
        
        apiClient.get('/api/users')
        .then(response => {
          console.log(response.data);
        })
        .catch(error => {
          console.error(error);
        });
            
    },
}


</script>



<style scoped>
.main-div {
  height: 100vh;
  display: flex;
  gap: 2vmax;
  width: 100%;
}
.left-div {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 25%;
}
.left-div > img {
  margin-top: 2vmax;
  width: 80%;
  border-radius: 50%;
  margin-bottom: 2vmax;
}
.left-div > p {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
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
</style>