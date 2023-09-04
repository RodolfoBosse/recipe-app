<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use App\Models\Ingredients;
use Illuminate\Http\Request;

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
    public function create()
    {
        $ingredients_list = Ingredients::pluck('name')->toJson();
        return view('recipes.create', compact('ingredients_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $recipe = new Recipes;

        $recipe->title = $request->title;

        $recipe->save();
        //$newrecipe = Recipe::find(['title' => $recipe->title]);
        for ($i='0'; $i<is_countable($request->ingredients) && count($request->ingredients); ++$i){
            $ingredients_id = Ingredients::firstorCreate(['name' => $request->ingredients[$i]])->id;

            $quantity = $request->quantity[$i];
            $recipe->ingredients()->attach($ingredients_id, ['quantity' => $quantity]);
        }
        return Recipes::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $recipe = Recipes::with('ingredients')->findorFail($id);
        return view('recipes.recipe', compact('recipe'));
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
    public function update(Request $request, Recipes $recipes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipes $recipes)
    {
        //
    }
}
