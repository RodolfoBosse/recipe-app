<template>
    <div>
      <h2 v-if="isNewRecipe">Add Recipe</h2>
      <h2 v-else>Edit Recipe</h2>
        <form @submit.prevent="submitForm">
          <div class="mb-3">
            <label for="title" class="form-label">Name:</label>
            <input class="form-control" type="text" id="title" v-model="recipe.title" required />
          </div>
          <button type="submit" v-if="isNewRecipe" class="btn btn-primary">Add Recipe</button>
          <button type="submit" v-else class="btn btn-primary">Update Recipe</button>
        </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    data() {
      return {
        recipe: {
          title: ''
        }
      }
    },
    computed: {
        isNewRecipe() {
        return !this.$route.path.includes('edit');
      }
    },
    async created() {
      if (!this.isNewRecipe) {
        const response = await axios.get(`/api/recipes/${this.$route.params.id}`);
        this.recipe = response.data;
      }
    },
    methods: {
      async submitForm() {
        try {
          if (this.isNewRecipe) {
            await axios.post('/api/recipes', this.recipe);
          } else {
            await axios.put(`/api/recipes/${this.$route.params.id}`, this.recipe);
          }
          this.$router.push('/');
        } catch (error) {
          console.error(error);
        }
      }
    }
  }
  </script>