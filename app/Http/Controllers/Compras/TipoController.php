<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Modelos\Compras\Tipo;
use App\Modelos\Seguridad\Bitacora;
use App\Utils;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TipoController extends Controller
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
            $tipo=DB::table('tipo')->where('tipo.nombre','LIKE','%'.$query.'%')
                ->join('categoria_producto', 'categoria_producto.id', '=', 'tipo.idCategoriaProd')
                ->where('tipo.visible','=','1')
                ->select('tipo.id', 'tipo.nombre','categoria_producto.nombre as categoria')
                ->orderBy('tipo.id','asc')
                ->paginate(25);
            return view('admin.Compras.tipos.index',["tipo" => $tipo, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = DB::table('categoria_producto')
            ->where('visible', '=', '1') -> get();
        return view("admin.Compras.tipos.create",["categoria" => $categoria]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = new Tipo();
        $tipo -> nombre = $request->get('nombre');
        $tipo -> visible = 1;
        $tipo -> idEmpresa = Auth::user() -> idEmpresa;
        $tipo -> idCategoriaProd = $request->get('idCategoriaProd');
        if ($tipo -> save()){
            Bitacora::registrarCreate( Utils::$TABLA_TIPO,$tipo->id);
        }

        return Redirect::to('admin/tipos');
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
        $categoria = DB::table('categoria_producto')
            ->where('visible', '=', '1') -> get();
        return view("admin.Compras.tipos.edit",["categoria" => $categoria, "tipo" => Tipo::findOrFail($id)]);
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
        $tipo = Tipo::findOrFail($request -> id);
        $tipo -> nombre = $request->get('nombre');
        $tipo -> idCategoriaProd = $request->get('idCategoriaProd');
        if ($tipo -> update()){
            Bitacora::registrarUpdate(Utils::$TABLA_TIPO, $tipo -> id);
        }

        return Redirect::to('admin/tipos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = Tipo::findOrFail($id);
        $tipo -> visible = 0;
        if ($tipo ->update()){
            Bitacora::registrarDelete(Utils::$TABLA_TIPO, $id);
        }
        return Redirect::to('admin/tipos');
    }
}
