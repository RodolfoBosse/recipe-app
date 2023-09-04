<template>
    <div>
        <h5 id="associating-form-text-with-form-controls">Name:</h5>
        <h6>{{ recipe.tittle }}</h6>
        <router-link :to="`/recipes/${recipe.id}/edit`" class="btn btn-primary">Edit</router-link>
    </div>
</template>

<script>
import axios from 'axios';
export default {
data() {
    return {
    recipe: {}
    }
},
async created() {
    try {
    const response = await axios.get(`/api/recipes/${this.$route.params.id}`);
    this.recipe = response.data;
    } catch (error) {
    console.error(error);
    }
}
}
</script>