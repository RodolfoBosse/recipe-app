<template>
    <div>
        <h5 id="associating-form-text-with-form-controls">Nome:</h5>
        <h3>{{ ingredient.name }}</h3>
        <router-link :to="`/ingredients/${ingredient.id}/edit`" class="btn btn-primary">Editar</router-link>
    </div>
</template>

<script>
import axios from 'axios';
export default {
data() {
    return {
    ingredient: {}
    }
},
async created() {
    try {
    const response = await axios.get(`/api/ingredients/${this.$route.params.id}`);
    this.ingredient = response.data;
    } catch (error) {
    console.error(error);
    }
}
}
</script>