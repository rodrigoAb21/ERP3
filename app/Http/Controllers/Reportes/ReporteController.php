<?php

namespace App\Http\Controllers\Reportes;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index(){
        $punto = DB::table('punto')
               ->where('visible', '=', '1') -> get();
        return view('admin.reportes.index',["punto" => $punto]);
    }

    public function ventas(Request $request){
        $mV = DB::select('select producto.id, producto.nombre,
                          SUM(detallev.cantidad) as cantidad,
                          producto.precioUVenta as precioV, 
                          SUM(detallev.cantidad)*producto.precioUVenta as ganancia,
                          SUM(detallev.cantidad)*producto.precioUCompra as ganancia_neta 
                          from producto 
                          inner join detallev on producto.id = detallev.idProducto 
                          inner join pago on detallev.idPago = pago.id,punto
                          where pago.idPuntoVenta = punto.id and
                                punto.nombre= ? and 
                                month (pago.fecha) = ?
                                group  by producto.id
                                order by SUM(detallev.cantidad) desc;',                                                             [$request -> puntoVenta, $request ->mes]);

        return view('admin.reportes.ReporteVentas',["mV" => $mV]);
    }

    public function ventasPDF(Request $request){
        $mV = DB::select('select producto.id, producto.nombre,
                          SUM(detallev.cantidad) as cantidad,
                          producto.precioUVenta as precioV, 
                          SUM(detallev.cantidad)*producto.precioUVenta as ganancia,
                          SUM(detallev.cantidad)*producto.precioUCompra as ganancia_neta 
                          from producto 
                          inner join detallev on producto.id = detallev.idProducto 
                          inner join pago on detallev.idPago = pago.id,punto
                          where pago.idPuntoVenta = punto.id and
                                punto.nombre= ? and 
                                month (pago.fecha) = ?
                                group  by producto.id
                                order by SUM(detallev.cantidad) desc;',
                          [$request -> puntoVenta, $request ->mes]);

        $pdf = \PDF::loadView('admin.reportes.ReporteVentas',["mV" => $mV]);
        return $pdf->download('ReporteVentas.pdf');
    }

    public function ventasImprimir(Request $request){
        $mV = DB::select('select producto.id, producto.nombre,
                          SUM(detallev.cantidad) as cantidad,
                          producto.precioUVenta as precioV, 
                          SUM(detallev.cantidad)*producto.precioUVenta as ganancia,
                          SUM(detallev.cantidad)*producto.precioUCompra as ganancia_neta 
                          from producto 
                          inner join detallev on producto.id = detallev.idProducto 
                          inner join pago on detallev.idPago = pago.id,punto
                          where pago.idPuntoVenta = punto.id and
                                punto.nombre= ? and 
                                month (pago.fecha) = ?
                                group  by producto.id
                                order by SUM(detallev.cantidad) desc;',                                                             [$request -> puntoVenta, $request ->mes]);

        $pdf = \PDF::loadView('admin.reportes.ReporteVentas',["mV" => $mV]);
        return $pdf->download('ReporteVentas.pdf');
    }

/*
    public function reclamosPDF(){
        $reclamo=DB::table('reclamo')
            ->join('cliente', 'cliente.id', '=', 'reclamo.idCliente')
            ->select('reclamo.id', 'cliente.nombre', 'cliente.apellido','reclamo.asunto','reclamo.fecha')
            ->where ('reclamo.visible','=','1')
            ->orderBy('reclamo.fecha','asc')
            ->get();

        $pdf = \PDF::loadView('admin.reportes.ListaReclamos',["reclamo" => $reclamo]);
        return $pdf->download('ListaReclamos.pdf');
    }





    public function cortes(){
        $medidor=DB::table('medidor')
            ->join('cliente', 'cliente.id', '=', 'medidor.idCliente')
            ->select('cliente.id', 'cliente.nombre', 'cliente.apellido','medidor.nroSerie', 'medidor.deuda', 'cliente.direccion', 'cliente.idUbicacion')
            ->where ('medidor.deuda','>','2')
            ->orderBy('medidor.id','asc')
            ->get();
        return view('admin.reportes.ListaCortes',["medidor" => $medidor]);
    }

    public function cortesPDF(){
        $medidor=DB::table('medidor')
            ->join('cliente', 'cliente.id', '=', 'medidor.idCliente')
            ->select('cliente.id', 'cliente.nombre', 'cliente.apellido','medidor.nroSerie', 'medidor.deuda', 'cliente.direccion', 'cliente.idUbicacion')
            ->where ('medidor.deuda','>','2')
            ->orderBy('medidor.id','asc')
            ->get();

        $pdf = \PDF::loadView('admin.reportes.ListaCortes',["medidor" => $medidor]);
        return $pdf->download('ListaCortes.pdf');
    }




    public function controles(){
        $control=DB::table('control')
            ->join('trabajador','trabajador.id','=', 'control.idTrabajador')
            ->join('uv','uv.id','=', 'control.idUv')
            ->select('control.id', 'uv.nombre as uv', 'trabajador.nombre as trabajador', 'control.fechaInicio')
            ->where ('control.estado','=','En proceso')
            ->orderBy('control.id','asc')
            ->get();
        return view('admin.reportes.ListaControles',["control" => $control]);
    }

    public function controlesPDF(){
        $control=DB::table('control')
            ->join('trabajador','trabajador.id','=', 'control.idTrabajador')
            ->join('uv','uv.id','=', 'control.idUv')
            ->select('control.id', 'uv.nombre as uv', 'trabajador.nombre as trabajador', 'control.fechaInicio')
            ->where ('control.estado','=','En proceso')
            ->orderBy('control.id','asc')
            ->get();

        $pdf = \PDF::loadView('admin.reportes.ListaControles',["control" => $control]);
        return $pdf->download('ListaControles.pdf');
    }
*/

}
