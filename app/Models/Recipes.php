<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipes extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'ingredients',
        'quantity',
        'ingredient_id'
    ];

    protected $casts = [
        'title'=> 'string',
        'ingredients' => 'array',
        'quantity' => 'array',
        'ingredient_id'=> 'array'
    ];
}

