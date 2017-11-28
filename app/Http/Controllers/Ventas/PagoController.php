<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Modelos\Compras\Producto;
use App\Modelos\Seguridad\Bitacora;
use App\Modelos\Ventas\Cliente;
use App\Modelos\Ventas\DetalleV;
use App\Modelos\Ventas\Pago;
use App\Modelos\Ventas\Punto;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PagoController extends Controller
{
    public function index(Request $request){

        if($request){
            $query = trim($request->get('searchText'));
            $pago = DB::table('pago')
                ->where('pago.id','LIKE','%'.$query.'%')
                ->where('pago.idEmpresa','=',Auth::user()->idEmpresa)
                ->orderBy('pago.id','asc')
                ->where('pago.tipo','Contado')
                ->paginate(25);
            return view('admin.Ventas.pagos.index',["pago"=>$pago,"searchText"=>$query]);
        }
    }

    public function create(){
        $punto = Punto::getPuntos();
        $cliente = Cliente::getClientes();
        $producto = Producto::getProductos();
        return view('admin.Ventas.pagos.create',["punto" => $punto, "cliente" => $cliente, "producto" => $producto]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $pago = new Pago();
            $pago -> montoTotal = $request -> get('montoTotal');
            $pago -> nombre = $request -> get('nombre');
            $pago -> nit = $request -> get('nit');
            $pago -> idPuntoVenta = $request -> get('idPuntoVenta');
            $pago -> idCliente = $request -> get('idCliente');
            $pago -> idEmpleado = Auth::user() -> idEmpleado;
            $pago -> idEmpresa = Auth::user() -> idEmpresa;
            $pago -> tipo = 'Contado';
            $pago -> estado = 'Activa';
            $my_time = Carbon::now('America/La_Paz');
            $pago -> fecha = $my_time -> toDateTimeString();
            $pago -> save();

            $idProd = $request ->get('idProductoT');
            $cant = $request -> get('cantidadTabla');
            $subTotal = $request -> get('subTotal');
            $cont = 0;

            while ($cont < count($idProd)) {
                $detalle = new DetalleV();
                $detalle -> idPago = $pago -> id;
                $detalle -> idProducto = $idProd[$cont];
                $detalle -> cantidad = $cant[$cont];
                $detalle -> subtotal = $subTotal[$cont];
                $detalle -> save();
                $cont = $cont + 1;
            }

            DB::commit();
            Bitacora::registrarCreate( Utils::$TABLA_PAGO,$pago->id,'se realizo una nueva venta al contado');
        } catch (Exception $e) {

            DB::rollback();

        }


        return  Redirect::to('admin/pagos');
    }


    public function show($id)
    {
        $pago = DB::table('pago')
            -> join('cliente', 'cliente.id', '=', 'pago.idCliente')
            -> join('punto', 'punto.id', '=', 'pago.idPuntoVenta')
            -> join('empleado', 'empleado.id', '=', 'pago.idEmpleado')
            -> select('pago.id', 'pago.fecha', 'empleado.nombre as empleado', 'pago.montoTotal', 'pago.nit', 'pago.nombre', 'cliente.nombre as cliente', 'punto.nombre as punto')
            -> where('pago.id', '=', $id)
            -> first();

        $detalle = DetalleV::getDetalle($id);
        return view('admin.Ventas.pagos.show',["pago"=>$pago,"detalle"=>$detalle]);
    }

    public function destroy($id){
        $pago = Pago::findOrFail($id);
        $pago -> estado = 'Anulada';
        if ($pago ->update()){
            Bitacora::registrarDelete(Utils::$TABLA_PAGO, $id,'se anulo el pago al contado No. '.$pago -> id);
        }
        return Redirect::to('admin/pagos');
    }

    

}
