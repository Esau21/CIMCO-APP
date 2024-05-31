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

   /* Definimos una funcion para hacer que el stock en 
    nuestra tabla de productos baje cuando se haga una nuevo detalle de transaccion */
    public function reduceStock($quantity)
    {
        if ($this->stock < $quantity) {
            throw new \Exception('Stock insuficiente para el producto');
        }

        $this->stock -= $quantity;
        $this->save();
    }
}
