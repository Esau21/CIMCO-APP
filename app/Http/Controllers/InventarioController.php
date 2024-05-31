<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Product;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        $inventarios = Product::select('products.*')
            ->orderBy('id', 'ASC')
            ->paginate(5);

        return view('inventarios.index', compact('inventarios'));
    }
}
