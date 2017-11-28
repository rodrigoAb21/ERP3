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
                    //
                    if(!isset($stockPV))
                    {
                        $stock1=new StockPuntoVenta;//
                        $stock1->idProducto=$producto->id;dd($producto->id);
                        $stock1->idPuntoVenta=$pv->id;
                        $stock1->stock=$request[$idInput];
                        $stock1->stock_minimo=0;
                        $stock1->save();
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
