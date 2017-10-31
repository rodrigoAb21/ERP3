<?php

namespace App\Http\Controllers\CRM;

use App\Modelos\CRM\Seguimiento;
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
        $seguimientos = DB::select('SELECT seguimiento.idCliente as cliente_id ,cliente.nombre as cliente_nombre, cliente.tipo as cliente_tipo,COUNT(seguimiento.idCliente) as count
                                FROM seguimiento,cliente
                                where seguimiento.idCliente=cliente.id
                                and seguimiento.idEmpleado=?
                                GROUP BY (seguimiento.idCliente)', [Auth::user()->empleado->id]);
        $date = Carbon::now();
        $fechaActual = $date->format('Y-m-d');

        $clientes=Cliente::all();
        return view('admin.CRM.seguimientos.index',compact('seguimientos','fechaActual','clientes'));
        
    }

    public function cliente($id)
    {
        $seguimientos =Seguimiento::where('idCliente','=',$id)
                                    ->where('idEmpleado','=',Auth::user()->empleado->id)
                                    ->orderBy('fechaInicio')
                                    ->get();
        $cliente=Cliente::find($id);
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
        flash('Seguimiento registrado exitosamente ...!! ')->success();
        return redirect('admin/seguimientos');
    }
    public function getFechaActual()
    {
        return $fechaActual = Carbon::now()->format('Y-m-d');
    }
}
