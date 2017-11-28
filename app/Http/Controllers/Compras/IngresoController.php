<?php

namespace App\Http\Controllers\Compras;


use App\Http\Controllers\Controller;

use App\Modelos\Compras\NotaCompra;
use App\Modelos\Compras\StockPuntoVenta;
use App\Modelos\Ventas\Punto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class IngresoController extends Controller
{

    public function reabastecer($idNotaCompra)
    {
        $compra=NotaCompra::find($idNotaCompra);
        $puntosVenta= Punto::where('idEmpresa','=',Auth::user()->idEmpresa)->get();

       return view('admin.Compras.ingreso.reabastecer',compact('compra','puntosVenta'));
    }

    public function guardar(Request $request)
    {
       $compra=NotaCompra::find($request->compra_id);
       $controlStockTotal=0;
        $puntosVenta= Punto::where('idEmpresa','=',Auth::user()->idEmpresa)->get();
        DB::beginTransaction();
        foreach ($puntosVenta as $pv) {

            foreach ($compra->productos as $producto)
            {
                $idInput="v".$pv->id."p".$producto->id;
                if($request[$idInput]>0)
                {
                    $stockPV = StockPuntoVenta::where('idPuntoVenta','=',$pv->id)
                    ->where('idProducto','=', $producto->id)->first();
                    if($stockPV==null)
                    {
                        StockPuntoVenta::updateOrCreate(
                            ['idProducto' =>  $producto->id, 'idPuntoVenta' =>  $pv->id],
                            ['stock' => $request[$idInput],'stock_minimo' => 0]
                        );
                    }
                    else{
                        $stockPV->stock=$stockPV->stock+$request[$idInput];
                        $stockPV->update();
                    }
                    $controlStockTotal=$controlStockTotal+$request[$idInput];

                }

            }
        }
        if($controlStockTotal==$compra->cantidadProductos)
            {
                DB::commit();
                $compra->finalizado=1;
                $compra->update();
                flash('Puntos de Venta reabastecidos...!!')->success();
            }
        else
            {
                DB::rollBack();
                flash('Se debe reabastecer todos los productos de la compra Nª.'.$compra->id)->error();
            }
        return redirect('admin/notacompra');
    }

}
