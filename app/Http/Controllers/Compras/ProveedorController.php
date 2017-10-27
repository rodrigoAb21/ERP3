<?php

namespace App\Http\Controllers\Compras;

use App\Bitacora;
use App\Modelos\Compras\Proveedor;
use App\Utils;
use Hamcrest\Util;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProveedorController extends Controller
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
            $proveedor=DB::table('proveedor')->where('proveedor.nombre','LIKE','%'.$query.'%')
                ->where('visible','=','1')
                ->where('idEmpresa','=', Auth::user() -> idEmpresa)
                ->orderBy('proveedor.id','asc')
                ->paginate(25);
            return view('admin.Compras.proveedores.index',["proveedor" => $proveedor, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.Compras.proveedores.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = new Proveedor();
        $proveedor -> ci = $request->get('ci');
        $proveedor -> nombre = $request->get('nombre');
        $proveedor -> direccion = $request->get('direccion');
        $proveedor -> telefono = $request->get('telefono');
        $proveedor -> empresa = $request->get('empresa');
        $proveedor -> visible = 1;
        $proveedor -> idEmpresa = Auth::user() -> idEmpresa;
        if ($proveedor -> save()){
            Bitacora::registrarCreate(Utils::$TABLA_PROVEEDOR, $proveedor -> id);
        }

        return Redirect::to('admin/proveedores');
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
        return view("admin.Compras.proveedores.edit",["proveedor" => proveedor::findOrFail($id)]);
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
        $proveedor = proveedor::findOrFail( $request->id);
        $proveedor -> ci = $request->get('ci');
        $proveedor -> nombre = $request->get('nombre');
        $proveedor -> direccion = $request->get('direccion');
        $proveedor -> telefono = $request->get('telefono');
        $proveedor -> empresa = $request->get('empresa');
        if ($proveedor -> update()){
            Bitacora::registrarUpdate(Utils::$TABLA_PROVEEDOR, $request ->id);
        }

        return Redirect::to('admin/proveedores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = proveedor::findOrFail($id);
        $proveedor -> visible = '0';
        if ($proveedor -> update()){
            Bitacora::registrarDelete(Utils::$TABLA_PROVEEDOR, $id);
        }

        return Redirect::to('admin/proveedores');
    }
}
