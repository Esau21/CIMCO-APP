<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {

        return $this->obtener();
    }

    public function paginationView()
    {
        return 'bootstrap';
    }

    public function obtener()
    {
        $productos = Product::select('products.*')
            ->orderBy('id', 'ASC')
            ->paginate(1);

        if (request()->ajax()) {
            return response()->json($productos);
        }

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $products = Product::create([
            "nombre" => $request->nombre,
            "descripcion" => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
        ]);

        $products->save();
        return redirect()->route('productos');
    }

    public function edit($id)
    {
        $productos = Product::find($id);

        return view('productos.editar', compact('productos'));
    }

    public function update(Request $request ,$id)
    {
        $productos = Product::findOrFail($id);

        $productos->nombre = $request->nombre;
        $productos->descripcion = $request->descripcion;
        $productos->precio = $request->precio;
        $productos->stock = $request->stock;

        $productos->save();


        return redirect()->route('productos');
    }

    public function eliminar($id)
    {
        $producto = Product::findOrFail($id);
        $producto->delete();

        return response()->json(['message' => 'Producto eliminado correctamente']);
    }
}
