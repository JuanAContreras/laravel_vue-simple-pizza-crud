<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    /**
     * Devuelve el usuario que realiza el pedido
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Devuelve las pizzas de un pedido
     */
    public function pizzas(){
        return $this->hasMany(Pizza::class);
    }
}
