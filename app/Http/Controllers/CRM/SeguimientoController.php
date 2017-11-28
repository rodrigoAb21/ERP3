<?php

namespace App\Http\Controllers\CRM;

use App\Modelos\CRM\Seguimiento;
use App\Modelos\Seguridad\Bitacora;
use App\Utils;
use App\Modelos\Ventas\Cliente;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeguimientoController extends Controller
{

    public function index()
    {
        $seguimientos =$this->select_count_seguimientos();
        $date = Carbon::now();
        $fechaActual = $date->format('Y-m-d');

        $clientes=Cliente::all();
        //Bitacora::registrarListar(Utils::$TABLA_SEGUIMIENTO);
        return view('admin.CRM.seguimientos.index',compact('seguimientos','fechaActual','clientes'));
        
    }

    public function select_count_seguimientos()
    {
        return DB::select('SELECT seguimiento.idCliente as cliente_id ,cliente.nombre as cliente_nombre, cliente.tipo as cliente_tipo,COUNT(seguimiento.idCliente) as count
                                FROM seguimiento,cliente
                                where seguimiento.idCliente=cliente.id
                                and seguimiento.idEmpleado=?
                                GROUP BY (seguimiento.idCliente)', [Auth::user()->empleado->id]);
    }

    public function getAllWhere($id)
    {
        return Seguimiento::where('idCliente','=',$id)
            ->where('idEmpleado','=',Auth::user()->empleado->id)
            ->orderBy('fechaInicio')
            ->get();

    }
    public function cliente($id)
    {
        $seguimientos =$this->getAllWhere($id);
        $cliente=Cliente::find($id);
        //Bitacora::registrarListar(Utils::$TABLA_SEGUIMIENTO);
        return view('admin.CRM.seguimientos.cliente',compact('seguimientos','cliente'));

    }
    public function store(Request $request)
    {
        $fechaActual = $this->getFechaActual();

        $seguimiento=new Seguimiento;
        $seguimiento->fechaInicio=$fechaActual;
        $seguimiento->idCliente=$request->cliente_id;
        $seguimiento->idEstado=1;
        $seguimiento->idEmpleado=Auth::user()->empleado->id;
        $seguimiento->visible=1;
        $seguimiento->proposito=$request->proposito;
        $seguimiento->save();

        $cliente=Cliente::findOrFail($request->cliente_id);

        Bitacora::registrarCreate( Utils::$TABLA_SEGUIMIENTO,$seguimiento->id,'se creo el seguimiento al cliente '. $cliente -> nombre );
        $this->enviarMensaje();
        return redirect('admin/seguimientos');
    }

    public function getFechaActual()
    {
        return $fechaActual = Carbon::now()->format('Y-m-d');
    }

    public function enviarMensaje()
    {
        flash('Seguimiento registrado exitosamente ...!! ')->success();
    }
}
