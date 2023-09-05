<template>
    <div>
      <h2 v-if="isNewIngredient">Adicionar Ingrediente</h2>
      <h2 v-else>Editar Ingrediente</h2>
        <form @submit.prevent="submitForm">
          <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input class="form-control" type="text" id="name" v-model="ingredient.name" required />
          </div>
          <button type="submit" v-if="isNewIngredient" class="btn btn-primary">Adicionar Ingrediente</button>
          <button type="submit" v-else class="btn btn-primary">Atualizar Ingrediente</button>
        </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    data() {
      return {
        ingredient: {
          name: ""
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
        const response = await axios.get(
          `/api/ingredients/${this.$route.params.id}`);
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
          this.$router.push('/ingredients');
        } catch (error) {
          console.error(error);
        }
      }
    }
  }
  </script>