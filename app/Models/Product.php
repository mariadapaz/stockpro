<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; 


     // Método para calcular a quantidade atual (entrada - saída)
     public function getCurrentQuantityAttribute()
     {
         $entradas = $this->materialMovements()->where('type', 'entrada')->sum('quantity');
         $saidas = $this->materialMovements()->where('type', 'saida')->sum('quantity');
 
         return $entradas - $saidas;
     }

    public function materialMovements()
    {
        // Supondo que existe uma relação entre o produto e as movimentações de material
        return $this->hasMany(MaterialMovement::class);
    }
}

