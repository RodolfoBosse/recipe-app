<template>
    <div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Código</th>
                <th scope="col">Nome</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="recipe in recipes" :key="recipe.id">
                    <td>{{ recipe.id }}</td>
                    <td>{{ recipe.title }}</td>
                    <td>
                      <div class="row gap-3">
                        <router-link :to="`/recipes/${recipe.id}`" class="p-2 col border btn btn-primary">Detalhes</router-link>
                        <router-link :to="`/recipes/${recipe.id}/edit`" class="p-2 col border btn btn-success">Editar</router-link>
                        <button @click="deleteRecipe(recipe.id)" type="button" class="p-2 col border btn btn-danger">Deletar</button>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      recipes: []
    }
  },
  async created() {
    try {
      const response = await axios.get('/api/recipes');
      this.recipes = response.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async deleteRecipe(id) {
      try {
        await axios.delete(`/api/recipes/${id}`);
        this.recipes = this.recipes.filter(recipe => recipe.id !== id);
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>