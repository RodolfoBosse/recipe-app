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
                <tr v-for="ingredient in ingredients" :key="ingredient.id">
                    <td>{{ ingredient.id }}</td>
                    <td>{{ ingredient.name }}</td>
                    <td>
                      <div class="row gap-3">
                        <router-link :to="`/ingredients/${ingredient.id}`" class="p-2 col border btn btn-primary">Detalhes</router-link>
                        <router-link :to="`/ingredients/${ingredient.id}/edit`" class="p-2 col border btn btn-success">Editar</router-link>
                        <button @click="deleteIngredient(ingredient.id)" type="button" class="p-2 col border btn btn-danger">Deletar</button>
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
      ingredients: []
    }
  },
  async created() {
    try {
      const response = await axios.get('/api/ingredients');
      this.ingredients = response.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async deleteIngredient(id) {
      try {
        await axios.delete(`/api/ingredients/${id}`);
        this.ingredients = this.ingredients.filter(ingredient => ingredient.id !== id);
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>