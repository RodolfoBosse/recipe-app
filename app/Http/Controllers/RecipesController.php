<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use App\Models\Ingredients;
use Illuminate\Http\Request;
use PgSql\Result;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Recipes::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
       $recipes =  $request->validate([
            'recipe' => 'required|array',
            'recipe.*' => 'required|string|distinct',
            'ingredients' => 'required|array',
            'ingredients.*' => 'required|array',
            'ingredients.*.*' => 'required|string|distinct'
        ]);

        return Recipes::create([
            'title' => $request['recipe.title'],
            'ingredients' => $request->input('ingredients.*.ingredient'),
            'quantity' => $request->input('ingredients.*.quantity'),
            'ingredient_id' => $request->input('ingredient_id.*.id')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $recipe = Recipes::find($id);
        return $recipe;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipes $recipes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipes $recipe)
    {
        $request->validate([
            'recipe' => 'required|array',
            'recipe.title' => 'required|string|distinct',
            'ingredients' => 'required|array',
            'ingredients.*' => 'required|array',
            'ingredients.*.ingredient' => 'required|string|distinct'
        ]);

        $recipe->update([
            'title' => $request['recipe.title'],
            'ingredients' => $request->input('ingredients.*.ingredient'),
            'quantity' => $request->input('ingredients.*.quantity'),
            'ingredient_id' => $request->input('ingredient_id.*')
        ]);

        
        return $recipe;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recipes = Recipes::find($id);
        $recipes->delete();


        return response()->json(['message' => 'Receita excluída com sucesso']);
    }
}
