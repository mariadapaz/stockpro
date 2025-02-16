<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos via mass assignment
    protected $fillable = [
        'name', 
        'cnpj', 
        'phone', 
        'email', 
        'address',
    ];

    // Caso tenha campos protegidos contra mass assignment, adicione-os à propriedade $guarded
    // Exemplo: protected $guarded = ['id']; 
}
