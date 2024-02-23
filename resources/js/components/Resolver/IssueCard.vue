<template>
  <div class="card-main-div shadow-2xl px-4 py-3">
    <div class="card-div-header">
      <img
        src="https://qph.fs.quoracdn.net/main-qimg-2b21b9dd05c757fe30231fac65b504dd"
        alt="none"
      />
      <p class="mr-5">Rahul Singh</p>
    </div>
    <h1>Title of the issue</h1>
    <p>
      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta harum
      vitae recusandae aut est cupiditate suscipit accusamus nemo eum
      dignissimos, corporis veniam quis minima repudiandae!
    </p>
    <div class="card-button">
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-4 rounded"
        @click="feedback = !feedback"
      >
        {{ feedback ? "Close" : "Open" }}
      </button>
    </div>
    <div v-if="feedback" class="feedback">
      <textarea style="width: 100%" v-model="text"></textarea>
      <button
        disabled="!text"
        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mr-4"
      >
        Resolve
      </button>
      <button
        disabled="!text"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
      >
        Reject
      </button>
    </div>
  </div>
</template>
<script setup>
import { ref } from "vue";
const text = ref("");
const feedback = ref(false);
</script>
<style scoped>
.card-main-div {
  min-height: 15vmax;
  transition: all 0.5s;
}
.card-main-div:hover {
  transform: scale(1.05);
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
}
.feedback {
  width: 100%;
  margin-top: 1vmax;
}
textarea:focus {
  outline: none;
}
</style>