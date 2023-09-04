<template>
    <div>
      <h2 v-if="isNewIngredient">Add Ingredient</h2>
      <h2 v-else>Edit Ingredient</h2>
        <form @submit.prevent="submitForm">
          <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input class="form-control" type="text" id="name" v-model="ingredient.name" required />
          </div>
          <button type="submit" v-if="isNewIngredient" class="btn btn-primary">Add Ingredient</button>
          <button type="submit" v-else class="btn btn-primary">Update Ingredient</button>
        </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    data() {
      return {
        ingredient: {
          name: ''
        }
      }
    },
    computed: {
        isNewIngredient() {
        return !this.$route.path.includes('edit');
      }
    },
    async created() {
      if (!this.isNewIngredient) {
        const response = await axios.get(`/api/ingredients/${this.$route.params.id}`);
        this.ingredient = response.data;
      }
    },
    methods: {
      async submitForm() {
        try {
          if (this.isNewIngredient) {
            await axios.post('/api/ingredients', this.ingredient);
          } else {
            await axios.put(`/api/ingredients/${this.$route.params.id}`, this.ingredient);
          }
          this.$router.push('/');
        } catch (error) {
          console.error(error);
        }
      }
    }
  }
  </script>