<?php

namespace App\Http\Controllers\Compras;


use App\Modelos\Compras\CategoriaProducto;
use App\Modelos\Seguridad\Bitacora;
use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class CategoriaProductoController extends Controller
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
            $categoria=DB::table('categoria_producto')->where('categoria_producto.nombre','LIKE','%'.$query.'%')
                ->where('visible','=','1')
                ->where('idEmpresa','=', Auth::user() -> idEmpresa)
                ->orderBy('categoria_producto.id','asc')
                ->paginate(25);
            return view('admin.Compras.categorias.index',["categoria" => $categoria, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.Compras.categorias.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = new CategoriaProducto();
        $categoria -> nombre = $request->get('nombre');
        $categoria -> visible = 1;
        $categoria -> idEmpresa = Auth::user() -> idEmpresa;
        if ($categoria -> save()){
            Bitacora::registrarCreate(Utils::$TABLA_CATEGORIA_PRODUCTO, $categoria -> id,'se creo la categoria.producto '.$categoria -> nombre );
        }

        return Redirect::to('admin/categoriaProducto');
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
        return view("admin.Compras.categorias.edit",["categoria" => CategoriaProducto::findOrFail($id)]);
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
        $categoria = CategoriaProducto::findOrFail( $request->id);
        $categoria -> nombre = $request->get('nombre');
        if ($categoria -> update()){
            Bitacora::registrarUpdate(Utils::$TABLA_CATEGORIA_PRODUCTO, $request -> id,'se actualizo la categoria.producto '. $categoria -> nombre);
        }


        return Redirect::to('admin/categoriaProducto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = CategoriaProducto::findOrFail($id);
        $categoria -> visible = '0';
        if ($categoria -> update()){
            Bitacora::registrarDelete(Utils::$TABLA_CATEGORIA_PRODUCTO, $id,'se elimino la categoria.producto '.$categoria -> nombre);
        }

        return Redirect::to('admin/categoriaProducto');
    }
}
