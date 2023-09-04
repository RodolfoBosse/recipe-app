<template>
    <div>
        <h5 id="associating-form-text-with-form-controls">Name:</h5>
        <h6>{{ ingredient.name }}</h6>
        <router-link :to="`/ingredients/${ingredient.id}/edit`" class="btn btn-primary">Edit</router-link>
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