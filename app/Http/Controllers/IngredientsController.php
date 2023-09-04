<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use Illuminate\Http\Request;
use App\Http\Requests;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ingredients::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'unique:ingredients,name|required|max:255',

        ]);

        return Ingredients::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredients $ingredients)
    {
        return $ingredients;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredients $ingredients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredients $ingredients)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $ingredients->update($request->all());
    
        return $ingredients;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredients $ingredients)
    {
        $ingredients->delete();
        
        return response()->json(['message' => 'Ingredient deleted successfully']);
    }
}
