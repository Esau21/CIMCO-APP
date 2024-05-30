<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //protegemos los fillable de los campos de nuestra base de datos
    protected $fillable = [
        'nombre', 
        'descripcion',
        'precio',
        'stock'
    ];
}
