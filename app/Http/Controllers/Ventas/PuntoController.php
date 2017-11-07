<?php

namespace App\Http\Controllers\Ventas;

use App\Modelos\Seguridad\Bitacora;
use App\Modelos\Ventas\Punto;
use App\Utils;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PuntoController extends Controller
{
    public function index(Request $request)
    {
        if ($request){
            $query = trim($request -> get('searchText'));
            $punto=DB::table('punto')->where('punto.nombre','LIKE','%'.$query.'%')
                ->where('visible','=','1')
                ->where('idEmpresa','=',Auth::user()->idEmpresa)
                ->orderBy('punto.id','asc')
                ->paginate(25);
            return view('admin.Ventas.puntos.index',["punto" => $punto, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.Ventas.puntos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $punto = new Punto();
        $punto -> nombre = $request->get('nombre');
        $punto -> ubicacion = $request->get('ubicacion');
        $punto -> idEmpresa = Auth::user() -> idEmpresa;
        $punto -> visible = 1;
        if ($punto -> save()){
            Bitacora::registrarCreate( Utils::$TABLA_PUNTO,$punto->id,'se creo al punto '.$punto -> nombre);
        }

        return Redirect::to('admin/puntosVenta');
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
        return view("admin.Ventas.puntos.edit",["punto" => punto::findOrFail($id)]);
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
        $punto = Punto::findOrFail($request -> id);
        $punto -> nombre = $request -> get('nombre');
        $punto -> ubicacion = $request -> get('ubicacion');
        if ($punto -> update()){
            Bitacora::registrarUpdate(Utils::$TABLA_PUNTO, $punto -> id,'se actualizo al punto '.$punto -> nombre);
        }

        return Redirect::to('admin/puntosVenta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $punto = Punto::findOrFail($id);
        $punto -> visible = 0;
        if ($punto ->update()){
            Bitacora::registrarDelete(Utils::$TABLA_PUNTO, $id,'se elimino al punto '.$punto -> nombre);
        }
        return Redirect::to('admin/puntosVenta');
    }
}
