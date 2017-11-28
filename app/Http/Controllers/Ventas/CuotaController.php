<?php

namespace App\Http\Controllers\Ventas;

use App\Modelos\Seguridad\Bitacora;
use App\Modelos\Ventas\Cuota;
use App\Modelos\Ventas\Pago;
use App\Utils;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CuotaController extends Controller
{
    public function index($id)
    {
            $cuota=DB::table('cuota')
                ->where('visible','=','1')
                ->where('idEmpresa','=',Auth::user()->idEmpresa)
                ->where('cuota.idCredito',$id)
                ->paginate(25);
            $pago = Pago::findOrFail($id);
            return view('admin.Ventas.cuotas.index',["cuota" => $cuota, "pago" => $pago]);
    }

    public function pagar($id)
    {
       $cuota = Cuota::findOrFail($id);
       $cuota -> estado = 'Pagada';
       $cuota -> fecha = Carbon::now('America/La_Paz') -> toDateString();
       $cuota -> idEmpleado = Auth::user() -> idEmpleado;
       if ($cuota -> update()){
           Bitacora::registrarUpdate(Utils::$TABLA_CUOTA, $id, 'Se pago la cuota numero:'.$id);
           $pago = Pago::findOrFail($cuota -> idCredito);
           $cant = DB::table('cuota')->where('idCredito',$pago -> id)->where('estado','Pagada')->count();
           if ($cant == $pago -> nroCuotas){
               $pago -> estado = "Finalizado";
           }else{
               $pago -> estado = $cant."/".$pago -> nroCuotas;
           }
           if ($pago -> update()){
               Bitacora::registrarUpdate(Utils::$TABLA_CREDITO,$pago -> id,'Se actualizo estado del credito nro'.$pago -> id);
           }

       }
       return back();
    }
}
