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
        $detailt = DetailTransaccion::create([
            "transaccionId" => $request->transaccionId,
            "productId" => $request->productId,
            "quantity" => $request->quantity,
            "UCC" => $request->UCC,
        ]);

        $detailt->save();

        return redirect()->route('details');
    }
}
