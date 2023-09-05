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

        //return view('ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'unique:ingredients,name|required|max:255'
        ]);

        return Ingredients::create([
            'name' => $request['name']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ingredients = Ingredients::find($id);
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
            'name' => 'required|string'
        ]);
        $ingredients = Ingredients::find($request->id);
        $ingredients->update([
            'name' => $request->name
        ]);
        return $ingredients;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ingredients = Ingredients::find($id);
        $ingredients->delete();
        
        return response()->json(['message' => 'Ingrediente excluído com sucesso']);
    }
}
