<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    /**
     * Devuelve el pedido que contiene la Pizza
     *  */
    public function pedido()
    {
        return $this->hasOne(Pedido::class);
    }

    /**
     * Devuelve la lista de ingredientes de la pizza
     */
    public function ingredientes(){
        return $this->belongsToMany(Ingrediente::class);
    }
}
