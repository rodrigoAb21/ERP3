<?php

namespace App\Http\Controllers\Reportes;
use App\Http\Controllers\Controller;
use App\Modelos\Ventas\Punto;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function index(){
        $punto = DB::table('punto')
               ->where('visible', '=', '1') -> get();
        return view('admin.reportes.index',["punto" => $punto]);
    }

    public function ventas(Request $request){
        $mV = DB::select("select producto.id, producto.nombre,
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
                                order by SUM(detallev.cantidad) desc;",[$request -> punto_id, $request -> mes]);

        return view('admin.reportes.ReporteVentas',["mV" => $mV, "datos" => $request]);
    }

    public function ventasPDF($id, $mes){
        $mV = DB::select("select producto.id, producto.nombre,
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
                                order by SUM(detallev.cantidad) desc;",[$id, $mes]);
    }


    public function stockIndex(){
        $punto = DB::table('punto')
            ->where('visible', '=', '1')
            ->where('idEmpresa',Auth::user() -> idEmpresa)
            ->get();
        return view('admin.reportes.stockIndex',["punto" => $punto]);
    }


    public function stock(Request $request){
        if ($request -> punto != '0'){
            $stock = DB::select("select producto.id, producto.nombre, stock_puntoventa.stock_minimo as minimo, stock_puntoventa.stock as actual 
                          from producto, stock_puntoventa, punto 
                          where stock_puntoventa.idPuntoVenta = punto.id and producto.id = stock_puntoventa.idProducto
                           and stock_puntoventa.stock_minimo >= stock_puntoventa.stock and punto.id = ?;", [$request -> punto]);
            $punto = Punto::findOrFail($request -> punto);
        }else{
            $stock = DB::select("select producto.id, producto.nombre, stock_puntoventa.stock_minimo as minimo, stock_puntoventa.stock as actual, punto.nombre as punto 
                          from producto, stock_puntoventa, punto 
                          where stock_puntoventa.idPuntoVenta = punto.id and producto.id = stock_puntoventa.idProducto
                           and stock_puntoventa.stock_minimo >= stock_puntoventa.stock;");
            return view('admin.reportes.ReporteStock2',["stock" => $stock]);
        }
        return view('admin.reportes.ReporteStock',["stock" => $stock,"punto" => $punto]);
    }


    public function stockPDF2(){
        $stock = DB::select("select producto.id, producto.nombre, stock_puntoventa.stock_minimo as minimo, stock_puntoventa.stock as actual, punto.nombre as punto 
                          from producto, stock_puntoventa, punto 
                          where stock_puntoventa.idPuntoVenta = punto.id and producto.id = stock_puntoventa.idProducto
                           and stock_puntoventa.stock_minimo >= stock_puntoventa.stock;");

        $pdf = PDF::loadView('admin.reportes.stockPDF2',["stock" => $stock]);
        return $pdf->download('ProdReabastecimiento.pdf');
    }

    public function stockPDF($id){
        $stock = DB::select("select producto.id, producto.nombre, stock_puntoventa.stock_minimo as minimo, stock_puntoventa.stock as actual 
                          from producto, stock_puntoventa, punto 
                          where stock_puntoventa.idPuntoVenta = punto.id and producto.id = stock_puntoventa.idProducto
                           and stock_puntoventa.stock_minimo >= stock_puntoventa.stock and punto.id = ?;", [$id]);
        $punto = Punto::findOrFail($id);

        $pdf = PDF::loadView('admin.reportes.stockPDF',["stock" => $stock,"punto" => $punto]);
        return $pdf->download('ProdReabastecimiento.pdf');
    }

    /*



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
