<?php

namespace App\Http\Controllers\Ventas;

use App\Modelos\Seguridad\Bitacora;
use App\Modelos\Ventas\Garante;
use App\Utils;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class GaranteController extends Controller
{
    public function index(Request $request)
    {
        if ($request){
            $query = trim($request -> get('searchText'));
            $garante=DB::table('garante')->where('garante.nombre','LIKE','%'.$query.'%')
                ->join('pago','pago.id','=','garante.idCredito')
                ->where('garante.visible','=','1')
                ->where('garante.idEmpresa','=',Auth::user()->idEmpresa)
                ->select('garante.id','garante.ci','garante.nombre','garante.telefono','garante.documento','pago.id as credito')
                ->orderBy('garante.id','asc')
                ->paginate(25);
            return view('admin.Ventas.garantes.index',["garante" => $garante, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $garante = DB::table('garante')
            -> join('pago', 'pago.id', '=', 'garante.idCredito')
            -> select('garante.id', 'garante.ci', 'garante.nombre', 'garante.direccion', 'garante.telefono', 'garante.documento', 'pago.id as credito')
            -> where('garante.id', '=', $id)
            -> first();
        
        return view('admin.Ventas.garantes.show',["garante"=>$garante]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin.Ventas.garantes.edit",["garante" => Garante::findOrFail($id)]);
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
        $garante = Garante::findOrFail($request -> id);
        $garante -> nombre = $request->get('nombre');
        $garante -> ci = $request->get('ci');
        $garante -> direccion = $request->get('direccion');
        $garante -> telefono = $request->get('telefono');
        $garante -> documento = $request->get('documento');
        if ($garante -> update()){
            Bitacora::registrarUpdate(Utils::$TABLA_PUNTO, $garante -> id,'se actualizo al garante '.$garante -> nombre);
        }

        return Redirect::to('admin/garantes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
