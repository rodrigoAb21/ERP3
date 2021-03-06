<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Modelos\Compras\Producto;
use App\Modelos\Seguridad\Bitacora;
use App\Modelos\Seguridad\Empleado;
use App\Modelos\Ventas\Cliente;
use App\Modelos\Ventas\Cuota;
use App\Modelos\Ventas\DetalleV;
use App\Modelos\Ventas\Garante;
use App\Modelos\Ventas\Pago;
use App\Modelos\Ventas\Punto;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CreditoController extends Controller
{
    public function index(Request $request){

        if($request){
            $query = trim($request->get('searchText'));
            $pago = DB::table('pago')
                ->where('pago.id','LIKE','%'.$query.'%')
                ->where('pago.idEmpresa','=',Auth::user()->idEmpresa)
                ->orderBy('pago.estado','asc')
                ->where('pago.tipo','Credito')
                ->paginate(25);
            return view('admin.Ventas.creditos.index',["pago"=>$pago,"searchText"=>$query]);
        }
    }

    public function create(){
        $punto = Punto::getPuntos();
        $cliente = Cliente::getClientes();
        $producto = Producto::getProductos();
        return view('admin.Ventas.creditos.create',["punto" => $punto, "cliente" => $cliente, "producto" => $producto]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $empleado = Empleado::findOrFail(Auth::user()->idEmpleado);
            $pago = new Pago();
            $pago -> nombre = $request -> get('nombre');
            $pago -> nit = $request -> get('nit');
            $pago -> idPuntoVenta = $request -> get('idPuntoVenta');
            $pago -> idCliente = $request -> get('idCliente');
            $pago -> montoTotal = $request -> get('t2');
            $pago -> idEmpleado = $empleado -> id;
            $pago -> idEmpresa = Auth::user() -> idEmpresa;
            $pago -> tipo = 'Credito';
            $pago -> nroCuotas = $request -> nroCuotas;
            $pago -> plazo = $request -> plazo;
            $pago -> montoCuota = $request -> montoCuota2;
            $pago -> interes = $request -> interes;
            $pago -> estado = "0/".$request -> nroCuotas;
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

            $garante = new Garante();
            $garante -> ci = $request -> g1ci;
            $garante -> nombre = $request -> g1nombre;
            $garante -> direccion = $request -> g1direccion;
            $garante -> telefono = $request -> g1telefono;



            $file = Input::file('g1documento');
            $file -> move(public_path().'/documentos/'.$request -> g1nombre.'/', $file->getClientOriginalName());
            $garante -> documento = $file->getClientOriginalName();



            $garante -> idEmpresa = Auth::user() -> idEmpresa;
            $garante -> visible = 1;
            $garante -> idCredito = $pago -> id;
            if ($garante -> save()){
                Bitacora::registrarCreate(Utils::$TABLA_GARANTE, $garante -> id, "Se creo al garante ".$garante -> nombre);
            }

            $garante2 = new Garante();
            $garante2 -> ci = $request -> g2ci;
            $garante2 -> nombre = $request -> g2nombre;
            $garante2 -> direccion = $request -> g2direccion;
            $garante2 -> telefono = $request -> g2telefono;


            $file = Input::file('g2documento');
            $file -> move(public_path().'/documentos/'.$request -> g2nombre.'/', $file->getClientOriginalName());
            $garante2 -> documento = $file->getClientOriginalName();

            $garante2 -> idEmpresa = Auth::user() -> idEmpresa;
            $garante2 -> visible = 1;
            $garante2 -> idCredito = $pago -> id;

            if ($garante2 -> save()){
                Bitacora::registrarCreate(Utils::$TABLA_GARANTE, $garante2 -> id, "Se creo al garante ".$garante2 -> nombre);
            }

            $i = 0;

            while ($i < $pago -> nroCuotas){
                $cuota = new Cuota();
                $cuota -> fecha = $my_time -> toDateTimeString();
                $cuota -> monto = $pago -> montoCuota;
                $cuota -> idEmpleado = $pago -> idEmpleado;
                $cuota -> idEmpresa = $pago -> idEmpresa;
                $cuota -> estado = 'Sin Pagar';
                $cuota -> visible = '1';
                $cuota -> idCredito = $pago -> id;
                if ($cuota ->save()){
                    Bitacora::registrarCreate(Utils::$TABLA_CUOTA, $cuota -> id, 'se creo la cuota nro'.$cuota->id);
                }
                $i = $i + 1;
            }

            DB::commit();
            Bitacora::registrarCreate( Utils::$TABLA_CREDITO,$pago->id,'se realizo una nueva venta al credito nro'.$pago->id);
        } catch (Exception $e) {

            DB::rollback();

        }


        return  Redirect::to('admin/creditos');
    }


    public function show($id)
    {

        $pago = Pago::getPago($id);

        $garante = Garante::getGarante($id);

        $detalle = DetalleV::getDetalle($id);
        return view('admin.Ventas.creditos.show',["pago"=>$pago,"detalle"=>$detalle,"garante"=>$garante]);
    }

    public function destroy($id){
        $pago = Pago::findOrFail($id);
        $pago -> estado = 'Anulada';
        if ($pago ->update()){
            Bitacora::registrarDelete(Utils::$TABLA_CREDITO, $id,'se anulo el pago al credito No. '.$pago -> id);
        }
        return Redirect::to('admin/creditos');
    }



}
