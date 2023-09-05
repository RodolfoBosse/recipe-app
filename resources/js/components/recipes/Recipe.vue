<template>
    <div>
        <h6 id="associating-form-text-with-form-controls">Código: {{ recipes.id}}</h6>
        <h5 id="associating-form-text-with-form-controls">Receita: {{ recipes.title}}</h5>
        <div class="container py-2 text-center">
            <div class="row g-0 gap-3 align-items-start">
                <div class="col">
                    <h5 id="associating-form-text-with-form-controls">Ordem:</h5>
                    <ul class="list-group">
                        <li class="list-group-item" v-for="(ingredient, index) in recipes.ingredients">{{index + 1}}</li>
                    </ul>
                </div>
                <div class="col">
                    <h5 id="associating-form-text-with-form-controls">Código:</h5>
                    <ul class="list-group">
                        <li class="list-group-item" v-for="id in recipes.ingredient_id">{{id}}</li>
                    </ul>
                </div>
                <div class="col">
                    <h5 id="associating-form-text-with-form-controls">Ingredientes:</h5>
                    <ul class="list-group">
                        <li class="list-group-item" v-for="ingredient in recipes.ingredients">{{ingredient}}</li>
                    </ul>
                </div>
                <div class="col">
                    <h5 id="associating-form-text-with-form-controls">Previsto em Kg:</h5>
                    <ul class="list-group">
                        <li class="list-group-item" v-for="quantity in recipes.quantity">{{quantity}}</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <router-link :to="`/recipes/${recipes.id}/edit`" class="btn btn-primary">Editar</router-link>
    </div>
</template>

<script>
import axios from 'axios';
export default {
data() {
    return {
    recipes: {}
    }
},
async created() {
    try {
    const response = await axios.get(`/api/recipes/${this.$route.params.id}`);
    this.recipes = response.data;
    console.log(this.recipes);
    } catch (error) {
    console.error(error);
    }
}
}
</script>