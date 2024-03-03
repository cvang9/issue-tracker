<template>
  <div class="query-form">
    <h2>Create New Ticket</h2>
    <form @submit.prevent="submitQuery">
      <div class="entry">
        <fieldset>
          <legend>Title</legend>
          <input type="text" v-model="title" placeholder="Enter the title...">
        </fieldset>
        <fieldset>
          <legend>Issue</legend>
      <textarea v-model="query" placeholder="Enter your issue..." rows="6"></textarea>
        </fieldset>
      </div>
      <div class="btm">
      <div class="category-buttons">
        <button type="button" @click="selectCategory('Security')" :class="{ active: selectedCategory === 'Security' }">Security</button>
        <button type="button" @click="selectCategory('Technical')" :class="{ active: selectedCategory === 'Technical' }">Technical</button>
        <button type="button" @click="selectCategory('Management')" :class="{ active: selectedCategory === 'Management' }">Management</button>
      </div>
      <button type="submit">Submit</button>

      </div>
    </form>
  </div>
</template>

<script setup>
import { ref,} from 'vue';
import apiClient from '../../services/api';
import { getCookie } from '../../helper/CookieHelper.js'

  const emit = defineEmits(['formSubmitted'])

    const title = ref('');
    const query = ref('');
    const selectedCategory = ref(null);

    const submitQuery = () => {
      console.log('Title:', title.value);
      console.log('Query:', query.value);
      console.log('Category:', selectedCategory.value);

      const payload = {
        'body': query.value,
        'department': selectedCategory.value
      }

      apiClient.post(`/api/users/${getCookie('userId')}/tickets`, payload)
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        })


      title.value = '';
      query.value = '';
      selectedCategory.value = null;
      emit('formSubmitted');
    };

    const selectCategory = (category) => {
      selectedCategory.value = category;
    };
</script>

<style scoped>
fieldset {
  border: 1px dotted black;
  margin-bottom: 2rem;
}
legend {
  font-size: 30px;
  text-transform: uppercase;
}
h2 {
  text-align: center;
  font-size: 40px;
  margin-bottom: 1rem;
}

.query-form {
  /* width: 1000px; */
  /* margin: auto 10rem; */
  padding: 0 40px;
  background-color: #e2e2e2;
  border-radius: 8px;
  color: rgb(28 36 52);
  /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.644); */
}

form {
  display: flex;
  flex-wrap: wrap;
  flex-direction: column;
  justify-content: space-around;
}

.entry {
  display: flex;
  flex-direction: column;
}
.btm {
  display: flex;
  align-items: center;
  flex-direction: column;
}
input[type="text"], textarea {
  padding: 10px;
  margin-bottom: 15px;
  font-size: 16px;
  border: none;
  border-radius: 4px;
  width: 500px;
  color: gray;
  background-color: #e2e2e2;
}
input[type="text"], textarea:focus {
  outline: none;
  
  /* background-color: rgb(249, 244, 234); */
}

textarea {
  resize: none;
}

.category-buttons {
  display: flex;
  justify-content: space-between;
}

.category-buttons button {
  flex-grow: 1;
  padding: 10px;
  margin-right: 5px;
  font-size: 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.category-buttons button.active {
  background-color: rgb(28 36 52);
  color: #fff;
}

button[type="submit"] {
  padding: 10px;
  font-size: 16px;
  border: none;
  border-radius: 4px;
  background-color: rgb(28 36 52);
  color: #fff;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin: 1rem 0;
  width: 100%;
}

button[type="submit"]:hover {
  background-color: #0056b3;
}
</style>
