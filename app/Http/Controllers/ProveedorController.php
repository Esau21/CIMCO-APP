<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::select('proveedors.*')
            ->orderBy('id', 'DESC')
            ->paginate(5);

        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $proveedores = Proveedor::create([
            "nombre" => $request->nombre,
            "contacto" => $request->contacto,
            "telefono" => $request->telefono,
            "email" => $request->email,
        ]);

        $proveedores->save();
    }

    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->update([
            "nombre" => $request->nombre,
            "contacto" => $request->contacto,
            "telefono" => $request->telefono,
            "email" => $request->email,
        ]);

        $proveedor->save();

        return redirect()->route('proveedores');
    }

    public function delete($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return response()->json(['success' => true]);
    }
}
