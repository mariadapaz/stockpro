<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'sector', 'status', 'user_id'];

    // Relacionamento com o Produto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relacionamento com o Usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
