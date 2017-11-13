<?php

namespace App\Http\Controllers\Compras;


use App\Http\Controllers\Controller;
use App\Modelos\Compras\Producto;
use App\Modelos\Compras\Tipo;
use App\Modelos\Seguridad\Bitacora;
use App\Utils;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ProductoController extends Controller
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
            $producto = DB::table('producto')->where('producto.nombre','LIKE','%'.$query.'%')
                ->join('tipo', 'tipo.id', '=', 'producto.tipo_id')
                ->where('producto.visible','=','1')
                ->where('producto.idEmpresa','=', Auth::user() -> idEmpresa)
                ->select('producto.id', 'producto.nombre', 'producto.precioActual', 'producto.imagen','tipo.nombre as tipo')
                ->orderBy('producto.id','asc')
                ->paginate(25);
            return view('admin.Compras.productos.index',["producto" => $producto, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo = Tipo::getTipos();
        return view("admin.Compras.productos.create",["tipo" => $tipo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto -> nombre = $request -> nombre;
        $producto -> especificacion = $request -> especificacion;
        $producto -> garantia = $request -> garantia;
        $producto -> puntosEquivale = $request -> puntosEquivale;
        $producto -> puntosPorVenta = $request -> puntosPorVenta;
        $producto -> precioUCompra = $request -> precioUCompra;
        $producto -> precioUVenta = $request -> precioUVenta;
        $producto -> precioActual = $request -> precioActual;
        $producto -> tipo_id = $request -> tipo_id;
        $producto -> visible = 1;
        $producto -> idEmpresa = Auth::user() -> idEmpresa;
        if (Input::hasFile('imagen')) {
            $file = Input::file('imagen');
            $file -> move(public_path().'/img/productos/', $file->getClientOriginalName());
            $producto -> imagen = $file->getClientOriginalName();
        }
        if ($producto -> save()){
            Bitacora::registrarCreate( Utils::$TABLA_PRODUCTO,$producto->id,'se creo el producto '.$producto -> nombre);
        }

        return Redirect::to('admin/productos');
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
        $tipo = Tipo::getTipos();
        return view("admin.Compras.productos.edit",["tipo" => $tipo, "producto" => Producto::findOrFail($id)]);
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
        $producto = Producto::findOrFail($request -> id);
        $producto -> nombre = $request -> nombre;
        $producto -> especificacion = $request -> especificacion;
        $producto -> garantia = $request -> garantia;
        $producto -> puntosEquivale = $request -> puntosEquivale;
        $producto -> puntosPorVenta = $request -> puntosPorVenta;
        $producto -> tipo_id = $request -> tipo_id;
        if (Input::hasFile('imagen')) {
            $file = Input::file('imagen');
            $file -> move(public_path().'/img/productos/',$file -> getClientOriginalName());
            $producto -> imagen = $file -> getClientOriginalName();
        }
        if ($producto -> update()){
            Bitacora::registrarUpdate(Utils::$TABLA_PRODUCTO, $producto -> id,'se actualizo el producto '.$producto -> nombre);
        }

        return Redirect::to('admin/productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto -> visible = 0;
        if ($producto ->update()){
            Bitacora::registrarDelete(Utils::$TABLA_PRODUCTO, $id,'se elimino el producto '.$producto -> nombre);
        }
        return Redirect::to('admin/productos');
    }
}
