<template>
  <div class="query-form">
    <form @submit.prevent="submitQuery">
      <input type="text" v-model="title" placeholder="Enter the title...">
      <textarea v-model="query" placeholder="Enter your query..." rows="6"></textarea>
      <div class="category-buttons">
        <button type="button" @click="selectCategory('General')" :class="{ active: selectedCategory === 'General' }">General</button>
        <button type="button" @click="selectCategory('Technical')" :class="{ active: selectedCategory === 'Technical' }">Technical</button>
        <button type="button" @click="selectCategory('Sales')" :class="{ active: selectedCategory === 'Sales' }">Sales</button>
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  setup() {
    const title = ref('');
    const query = ref('');
    const selectedCategory = ref(null);

    const submitQuery = () => {
      console.log('Title:', title.value);
      console.log('Query:', query.value);
      console.log('Category:', selectedCategory.value);
      title.value = '';
      query.value = '';
      selectedCategory.value = null;
    };

    const selectCategory = (category) => {
      selectedCategory.value = category;
    };

    return {
      title,
      query,
      selectedCategory,
      submitQuery,
      selectCategory
    };
  }
};
</script>

<style scoped>
.query-form {
  width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

form {
  display: flex;
  flex-direction: column;
}

input[type="text"], textarea {
  padding: 10px;
  margin-bottom: 15px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

textarea {
  resize: vertical;
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
  background-color: #007bff;
  color: #fff;
}

button[type="submit"] {
  padding: 10px;
  font-size: 16px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
  background-color: #0056b3;
}
</style>
