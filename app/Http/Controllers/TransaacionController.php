<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Transaccion;
use App\Models\User;
use Illuminate\Http\Request;

class TransaacionController extends Controller
{
    public function index()
    {
        $trasaccion = Transaccion::join('users as u', 'u.id', '=', 'usuarioId')
            ->join('proveedors as p', 'p.id', '=', 'proveedorId')
            ->select('transaccions.*', 'p.nombre as nombrepro', 'u.name as nameu')
            ->orderBy('transaccions.id', 'ASC')
            ->paginate(4);
        return view('transacciones.index', compact('trasaccion'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $users = User::all();

        return view('transacciones.create', compact('proveedores', 'users'));
    }

    public function store(Request $request)
    {
        $trasaccion = Transaccion::create([
            "fecha" => $request->fecha,
            "hora" => $request->hora,
            "tipo" => $request->tipo,
            "observaciones" => $request->observaciones,
            "usuarioId" => $request->usuarioId,
            "proveedorId" => $request->proveedorId,
        ]);

        $trasaccion->save();

        return redirect()->route('transaccion');
    }

    public function edit($id)
    {
        $transaccion = Transaccion::find($id);
        $proveedores = Proveedor::all();
        $users = User::all();
    
        return view('transacciones.edit', compact('transaccion', 'proveedores', 'users'));
    }

    public function update(Request $request,$id)
    {
        $transaccion = Transaccion::find($id);
        $transaccion->update([
            "fecha" => $request->fecha,
            "hora" => $request->hora,
            "tipo" => $request->tipo,
            "observaciones" => $request->observaciones,
            "usuarioId" => $request->usuarioId,
            "proveedorId" => $request->proveedorId,
        ]);

        $transaccion->save();
        return redirect()->route('transaccion');
    }

    public function delete($id)
    {
        $trasaccion = Transaccion::findOrFail($id);
        $trasaccion->delete();

        return response()->json(['success', 'Transaccion eliminada con exito']);

    }
    
}
