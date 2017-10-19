<?php

namespace App\Http\Controllers\CRM;

use App\Bitacora;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Modelos\CRM\Seguimiento;
use DB;

class SeguimientoController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request){
            $query = trim($request -> get('searchText'));
            $seguimiento=DB::table('seguimiento')
                ->join('cliente', 'cliente.id', '=', 'seguimiento.idCliente')
                ->join('empleado', 'empleado.id', '=', 'seguimiento.idEmpleado')
                ->join('estado', 'estado.id', '=', 'seguimiento.idEstado')
                ->select('seguimiento.id', 'cliente.nombre as cliente', 'estado.nombre as estado','seguimiento.fechaInicio','empleado.nombre as empleado')
                ->where ('seguimiento.visible','=','1')
                ->where('cliente.nombre','LIKE','%'.$query.'%')
                ->orderBy('seguimiento.id','asc')
                ->paginate(25);
            return view('admin.CRM.seguimientos.index',["seguimiento" => $seguimiento, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = DB::table('cliente')->get();
        $empleado = DB::table('empleado')->get();
        $estado = DB::table('estado')->get();
        return view("admin.CRM.seguimientos.create",["cliente" => $cliente, "empleado" => $empleado, "estado" => $estado]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seguimiento = new Seguimiento;

        $mytime = Carbon::now('America/La_Paz');
        $seguimiento -> fechaInicio = $mytime->toDateString();

        $seguimiento -> idCliente = $request->get('idCliente');
        $seguimiento -> idEmpleado = $request->get('idEmpleado');
        $seguimiento -> idEstado = $request->get('idEstado');
        $seguimiento -> visible = '1';
        if ($seguimiento -> save()){
            Bitacora::registrarCreate(Utils::$TABLA_SEGUIMIENTO, $seguimiento->id);
        }

        return Redirect::to('admin/seguimientos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = DB::table('cliente')->get();
        $empleado = DB::table('empleado')->get();
        $estado = DB::table('estado')->get();
        return view("admin.CRM.seguimientos.edit",["seguimiento"=>seguimiento::findOrFail($id), "cliente" => $cliente, "empleado" => $empleado, "estado" => $estado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seguimiento = seguimiento::findOrFail($id);
        $seguimiento -> idCliente = $request->get('idCliente');
        $seguimiento -> idEmpleado = $request->get('idEmpleado');
        $seguimiento -> idEstado = $request->get('idEstado');
        if ($seguimiento -> update()){
            Bitacora::registrarUpdate(Utils::$TABLA_SEGUIMIENTO, $id);
        }
        return Redirect::to('admin/seguimientos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seguimiento = seguimiento::findOrFail($id);
        $seguimiento -> visible = '0';
        if ($seguimiento -> update()){
            Bitacora::registrarDelete(Utils::$TABLA_SEGUIMIENTO, $id);
        }
        return Redirect::to('admin/seguimientos');
    }
}
