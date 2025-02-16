<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialMovement extends Model
{
    // Defina o relacionamento com o modelo Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // Relação com 'product_id'
    }
    public function user()
    {
        return $this->belongsTo(User::class); // Relação de muitos para um
    }
}
