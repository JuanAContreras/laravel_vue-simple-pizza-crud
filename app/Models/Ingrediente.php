<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    /**
     * Devuelve las pizzas que contienen el ingrediente
     */
    public function pizza(){
        return $this->belongsToMany(Pizza::class);
    }
}
