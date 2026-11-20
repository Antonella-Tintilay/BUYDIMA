<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class ReporteProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('juego')
            ->where('activo', 1)
            ->whereHas('juego', function ($consulta) {
                $consulta->where('activo', 1);
            })
            ->orderBy('nombre_producto')
            ->get();

        $totalProductos = $productos->count();
        $stockTotal = $productos->sum('stock');
        $precioPromedio = $productos->avg('precio') ?? 0;

        return view('reportes.productos', compact(
            'productos',
            'totalProductos',
            'stockTotal',
            'precioPromedio'
        ));
    }
}
