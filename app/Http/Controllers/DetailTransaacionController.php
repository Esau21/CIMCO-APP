<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaccion;
use App\Models\Product;
use App\Models\Transaccion;
use Illuminate\Http\Request;

class DetailTransaacionController extends Controller
{
    public function index()
    {
        $detailstrasacciones = DetailTransaccion::join('transaccions as t', 't.id', '=', 'transaccionId')
            ->join('products as p', 'p.id', '=', 'productId')
            ->select('detail_transaccions.*', 't.fecha as date', 'p.nombre as namepro')
            ->orderBy('detail_transaccions.id', 'ASC')
            ->paginate(5);
        return view('detail.index', compact('detailstrasacciones'));
    }

    public function create()
    {
        $productos = Product::all();
        $transaccion = Transaccion::all();

        return view('detail.create', compact('productos', 'transaccion'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaccionId' => 'required|integer|exists:transaccions,id',
            'productId' => 'required|integer|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'UCC' => 'required|string|size:12|unique:detail_transaccions,UCC',
        ]);

        $product = Product::findOrFail($request->productId);

        // Verificar si el stock es suficiente
        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'Stock insuficiente para el producto.'], 400);
        }

        $detailt = DetailTransaccion::create([
            "transaccionId" => $request->transaccionId,
            "productId" => $request->productId,
            "quantity" => $request->quantity,
            "UCC" => $request->UCC,
        ]);

        /* vamos ah reducir el stock del producto */
        // Reducir el stock del producto
        $product->reduceStock($request->quantity);

        $detailt->save();

        return redirect()->route('details');
    }

    public function edit($id)
    {
        $detailT = DetailTransaccion::find($id);
        $productos = Product::all();
        $transaccion = Transaccion::all();

        return view('detail.edit', compact('detailT', 'productos', 'transaccion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'transaccionId' => 'required|integer|exists:transaccions,id',
            'productId' => 'required|integer|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'UCC' => 'required|string|size:12|unique:detail_transaccions,UCC,'.$id,
        ]);

        $detailTransaccion = DetailTransaccion::find($id);
        $product = Product::find($detailTransaccion->productId);

        // Restaurar el stock del producto
        $product->stock += $detailTransaccion->quantity;
        $product->save();

        // Actualizar los detalles de la transacción
        $detailTransaccion->update([
            "transaccionId" => $request->transaccionId,
            "productId" => $request->productId,
            "quantity" => $request->quantity,
            "UCC" => $request->UCC,
        ]);

        // Actualizar el producto si ha cambiado
        if ($detailTransaccion->productId != $request->productId) {
            // Restaurar el stock del producto anterior
            $oldProduct = Product::find($detailTransaccion->productId);
            $oldProduct->stock += $detailTransaccion->quantity;
            $oldProduct->save();

            // Reducir el stock del nuevo producto
            $newProduct = Product::find($request->productId);
            if ($newProduct->stock < $request->quantity) {
                return response()->json(['message' => 'Stock insuficiente para el nuevo producto.'], 400);
            }
            $newProduct->stock -= $request->quantity;
            $newProduct->save();
        } else {
            // Reducir el stock del mismo producto
            if ($product->stock < $request->quantity) {
                return response()->json(['message' => 'Stock insuficiente para el producto.'], 400);
            }
            $product->stock -= $request->quantity;
            $product->save();
        }

        return redirect()->route('details')->with('success', 'Transacción actualizada correctamente.');
    }

    public function delete(Request $request, $id)
    {
        $detailTransaccion = DetailTransaccion::findOrFail($id);
        //Hacemos que el stock se restaure al producto anterior
        if($detailTransaccion->productId != $request->productId)
        {
            $oldProduct = Product::find($detailTransaccion->productId);
            $oldProduct->stock += $detailTransaccion->quantity;
            $oldProduct->save();
        }
        $detailTransaccion->delete();

        return response()->json(['message' => 'La transaccion fue eliminada con exito']);
    }
}
