<template>
    <div>
        <h2 v-if="isNewRecipe">Adicionar Receita</h2>
        <h2 v-else>Editar Receita</h2>
        <form @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="title" class="form-label">Receita:</label>
                <input
                    class="form-control"
                    type="text"
                    id="title"
                    v-model="recipe.title"
                    required
                />
                <div
                    v-for="(input, index) in newIngredients"
                    :key="`ingredientInput-${index}`"
                    class="container py-2 text-center"
                >
                    <div class="row g-0 gap-3 align-items-center">
                        <div class="col px-0">
                            <label for="ingredients" class="form-label"
                                >Ingredientes:</label
                            >
                            <select
                                name="ingredients"
                                id="ingredients"
                                class="form-control"
                                v-model="input.ingredient"
                                required
                            >
                                <option v-for="ingredient in ingredients">
                                    {{ ingredient.name }}
                                </option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="quantity" class="form-label"
                                >Previsto em Kg:</label
                            >
                            <input
                                class="form-control"
                                type="text"
                                id="quantity"
                                v-model="input.quantity"
                                required
                            />
                        </div>
                        <div class="col-1 mh-100">
                            <svg
                                @click="addField(input, newIngredients)"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                                class="ml-2 cursor-pointer"
                            >
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path
                                    fill="green"
                                    d="M11 11V7h2v4h4v2h-4v4h-2v-4H7v-2h4zm1 11C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"
                                />
                            </svg>
                        </div>
                        <div class="col-1 mh-100">
                            <svg
                                v-show="newIngredients.length > 1"
                                @click="removeField(index, newIngredients)"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                                class="ml-2 cursor-pointer"
                            >
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path
                                    fill="#EC4899"
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9.414l2.828-2.829 1.415 1.415L13.414 12l2.829 2.828-1.415 1.415L12 13.414l-2.828 2.829-1.415-1.415L10.586 12 7.757 9.172l1.415-1.415L12 10.586z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" v-if="isNewRecipe" class="btn btn-primary">
                Adicionar Receita
            </button>
            <button type="submit" v-else class="btn btn-primary">
                Atualizar Receita
            </button>
        </form>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "AddRemove",
    data() {
        return {
            recipe: {
                title: "",
            },
            ingredients: [],
            newIngredients: [{ ingredient: "", quantity: "", id:"NULL"}]
        };
    },
    computed: {
        isNewRecipe() {
            return !this.$route.path.includes("edit");
        },
    },
    async created() {
        try {
            const responseing = await axios.get(`/api/ingredients`);
            this.ingredients = responseing.data
        } catch (error) {
            console.error(error);
        }
        if (!this.isNewRecipe) {
            const response = await axios.get(
                `/api/recipes/${this.$route.params.id}`
            );
            const responseing = await axios.get(
                `/api/ingredients`
            );
            this.recipe = response.data;
            this.ingredients = responseing.data;
        }
    },
    methods: {
        addField(value, fieldType) {
            fieldType.push({ ingredient: "", quantity:"", id:"" });
        },
        removeField(index, fieldType) {
            fieldType.splice(index, 1);
        },
        async submitForm() {
            try {
                const ids = [];
                const names = [];
                //get the names of the ingredients select
                for(var i=0; i<this.newIngredients.length; i++){
                    names[i] = this.newIngredients[i].ingredient;
                }
                //get the ids of the ingredients select and store on another array
                for(var i=0; i<names.length; i++){
                    for(var j=0; j<this.ingredients.length; j++){
                        if(names[i] == this.ingredients[j].name){
                        ids[i] = this.ingredients[j].id;
                    }                        
                    }
                }
                console.log(ids);
                if (this.isNewRecipe) {
                    await axios.post("/api/recipes", {recipe: this.recipe, ingredients: this.newIngredients, ingredient_id: ids});
                } else {
                    await axios.put(
                        `/api/recipes/${this.$route.params.id}`, {recipe: this.recipe, ingredients: this.newIngredients, ingredient_id: ids});
                }
                this.$router.push("/recipes");
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>
