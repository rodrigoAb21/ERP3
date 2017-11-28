<?php

namespace App\Http\Controllers\Compras;


use App\Http\Controllers\Controller;

use App\Modelos\Compras\LoteProducto;
use App\Modelos\Compras\NotaCompra;
use App\Modelos\Compras\Producto;
use App\Modelos\Compras\Proveedor;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NotaCompraController extends Controller
{

    public function index()
    {
        $compras=NotaCompra::where('idEmpresa','=',Auth::user()->idEmpresa)
            ->get();

        return view('admin.Compras.notaCompra.index',compact('compras'));
    }

    public function create()
    {
        $fechaActual=$this->getFechaActual();
        $proveedores=Proveedor::where ('idEmpresa','=',Auth::user()->idEmpresa)
            ->get();
        $productos=Producto::where ('idEmpresa','=',Auth::user()->idEmpresa)
            ->get();

        return view('admin.Compras.notaCompra.create',compact('fechaActual',
            'proveedores','productos'));
    }

    public function show($id)
    {
        $compra=NotaCompra::find($id);

        return view ('admin.Compras.notaCompra.show',compact('compra'));

    }
    public function store()
    {
        $productos = json_decode($_GET['r'], TRUE);
        $proveedor=$_GET['p'];
        $fecha=$_GET['f'];
        $compra = new  NotaCompra;
        $compra->fecha=$fecha;
        $compra->montoTotal=0;
        $compra->idEmpresa=Auth::user()->idEmpresa;
        $compra->idProveedor=$proveedor;
        $cantidadProductos=0;
        $compra->cantidadProductos=$cantidadProductos;
        $compra->finalizado=0;
        if($compra->save())
        {
            $totalCompra=0;
            foreach ($productos as $producto)
            {
                $lote_producto=new LoteProducto;
                $lote_producto->idNotaCompra=$compra->id;
                $lote_producto->idProducto=$producto[0];
                $lote_producto->cantidad=$producto[2]; $cantidadProductos=$cantidadProductos+$producto[2];
                $lote_producto->precioU=$producto[3];
                $lote_producto->subtotal=$producto[4];
                $totalCompra=$totalCompra+$producto[4];
                $lote_producto->save();
            }
            $compra->montoTotal=$totalCompra;
            $compra->cantidadProductos=$cantidadProductos;
            $compra->update();
        }

        flash('Compra registrada, se procedera a reabastecer a los puntos de venta.')->success();
        return redirect('admin/ingreso/'.$compra->id);

    }
    public function getFechaActual()
    {
        return $fechaActual = Carbon::now()->format('Y-m-d');
    }
}
