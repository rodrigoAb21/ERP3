<?php

namespace App\Http\Controllers\CRM;

use App\Bitacora;
use App\Utils;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Modelos\CRM\Estado;
use DB;

class EstadoController extends Controller
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
            $estado=DB::table('estado')->where('nombre','LIKE','%'.$query.'%')
                ->where ('visible','=','1')
                ->orderBy('id','asc')
                ->paginate(25);
            return view('admin.CRM.estados.index',["estado" => $estado, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.CRM.estados.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estado = new Estado;
        $estado -> nombre = $request->get('nombre');
        $estado -> descripcion = $request -> get('descripcion');
        $estado -> tipo = $request->get('tipo');
        $estado -> idEmpresa = Auth::user() -> idEmpresa;
        $estado -> visible = '1';
        if ($estado -> save()){
            Bitacora::registrarCreate(Utils::$TABLA_ESTADO, $estado -> id);
        }
        return Redirect::to('admin/estados');
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
        return view("admin.CRM.estados.edit",["estado"=>estado::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $estado = Estado::findOrFail($request -> id);
        $estado -> nombre = $request->get('nombre');
        $estado -> descripcion = $request->get('descripcion');
        $estado -> tipo = $request->get('tipo');
        if ($estado -> update()){
            Bitacora::registrarUpdate(Utils::$TABLA_ESTADO,$request -> id);
        }
        return Redirect::to('admin/estados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado = Estado::findOrFail($id);
        $estado -> visible = '0';
        if ($estado -> update()){
            Bitacora::registrarDelete(Utils::$TABLA_ESTADO,$id);
        }
        return Redirect::to('admin/estados');
    }
}
