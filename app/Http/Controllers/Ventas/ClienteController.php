<?php

namespace App\Http\Controllers\Ventas;

use App\Bitacora;
use App\Http\Controllers\Controller;
use App\Modelos\Ventas\Cliente;
use App\Utils;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClienteController extends Controller
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
            $cliente=DB::table('cliente')->where('cliente.nombre','LIKE','%'.$query.'%')
                ->where('visible','=','1')
                ->orderBy('cliente.id','asc')
                ->paginate(25);
            return view('admin.Ventas.clientes.index',["cliente" => $cliente, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = DB::table('categoria_cliente')
            ->where('visible', '=', '1') -> get();
        return view("admin.Ventas.clientes.create",["categoria" => $categoria]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente -> ci = $request->get('ci');
        $cliente -> nit = $request->get('nit');
        $cliente -> nombre = $request->get('nombre');
        $cliente -> puntosAcumulados = 0;
        $cliente -> direccion = $request->get('direccion');
        $cliente -> email = $request->get('email');
        $cliente -> tipo = $request->get('tipo');
        $cliente -> idEmpresa = 123456;
        $cliente -> visible = 1;
        $cliente -> idCategoria = $request->get('idCategoria');
        if ($cliente -> save()){
            Bitacora::registrarCreate( Utils::$TABLA_CLIENTE,$cliente->id);
        }

        return Redirect::to('admin/clientes');
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
        $categoria = DB::table('categoria_cliente')
            ->where('visible', '=', '1') -> get();
        return view("admin.Ventas.clientes.edit",["categoria" => $categoria, "cliente" => cliente::findOrFail($id)]);
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
        $cliente = cliente::findOrFail($id);
        $cliente -> ci = $request->get('ci');
        $cliente -> nit = $request->get('nit');
        $cliente -> nombre = $request->get('nombre');
        $cliente -> puntosAcumulados = $request->get('puntosAcumulados');
        $cliente -> direccion = $request->get('direccion');
        $cliente -> email = $request->get('email');
        $cliente -> tipo = $request->get('tipo');
        $cliente -> idEmpresa = 123456;
        $cliente -> idCategoria = $request->get('idCategoria');
        if ($cliente -> update()){
            Bitacora::registrarUpdate(Utils::$TABLA_CLIENTE, $cliente -> id);
        }

        return Redirect::to('admin/clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = cliente::findOrFail($id);
        $cliente -> visible = 0;
        if ($cliente ->update()){
            Bitacora::registrarDelete(Utils::$TABLA_CLIENTE, $id);
        }
        return Redirect::to('admin/clientes');
    }
}
