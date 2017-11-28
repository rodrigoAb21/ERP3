<?php

namespace App\Http\Controllers\Compras;


use App\Http\Controllers\Controller;

use App\Modelos\Ventas\Punto;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class InventarioController extends Controller
{

    public function index()
    {
        $puntosVenta=Punto::where('idEmpresa','=',Auth::user()->idEmpresa)
            ->get();

        return view('admin.Compras.inventario.index',compact('puntosVenta'));
    }

    public function showPromociones($idProducto)
    {
        $promociones=DB::select(
            'SELECT promocion.id,promocion.nombre,promocion.fechaEmpieza,promocion.fechaTermina
                FROM detalle_promo ,promocion
                WHERE detalle_promo.promo=promocion.id
                and promocion.visible=1
                and detalle_promo.producto=?', [$idProducto]);

        return view('admin.CRM.promocion.index',compact('promociones'));

    }


}
