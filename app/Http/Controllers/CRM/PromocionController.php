<?php

namespace App\Http\Controllers;

use App\DetallePromo;
use App\Producto;
use App\Promocion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromocionController extends Controller
{
    public function index()
    {
        $title = 'Promociones';
        $promociones = DB::table('promocion')
            ->where('visible','=',1)
        ->get();
        return view('promocion.index',compact('promociones','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Nueva Promocion';

        return view('promocion.create',compact('title'));
    }
    public function productos($id)
    {
        $promocion = Promocion::findOrfail($id);
        $productos = $promocion->productos;

        $otros_productos=DB::select('SELECT producto.id,producto.nombre
FROM producto
WHERE producto.visible=1
 and producto.id not in(SELECT detalle_promo.producto from detalle_promo WHERE detalle_promo.promo=? and detalle_promo.visible=1)',
            [$id]);
        return view('promocion.productos', compact('promocion', 'productos','otros_productos'));
    }
    public function agregarProductos(Request $request, $id)
    {
        $productos=$request->productos;
        $promo_id=$request->id;
        foreach ($productos as $producto){
            if(! DetallePromo::where('promo', '=',$promo_id)
                ->where('producto', '=',$producto)
                ->update(['cantidad' => 0,'visible'=>1]))
            {
                $detalle=new DetallePromo;
                $detalle->promo=$promo_id;
                $detalle->producto=$producto;
                $detalle->cantidad=0;
                $detalle->visible=1;
                $detalle->save();
            }
        }
        return redirect('/admin/promocion/'.$id.'/productos');
    }
    public function actualizarCantidad(Request $request, $id)
    {
        $productos=$request->productos;
        $cantidades=$request->cantidades;
        $i=0;
        foreach ($productos as $producto) {
            DetallePromo::where('promo', '=',$id)
                ->where('producto', '=',$producto)
                ->update(['cantidad' => $cantidades[$i]]);
        $i++;
        }
        return redirect('/admin/promocion/'.$id.'/productos');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promocion = new Promocion;
        $promocion->nombre = $request->nombre;
        $promocion->fechaEmpieza=$request->comienzo;
        $promocion->fechaTermina=$request->final;
        if($promocion->save())
        {

        }else
        {

        }
        return redirect('admin/promocion');

    }
    public function removerProducto(Request $request, $id)
    {
        $productos=$request->productos;
        $promo_id=$request->id;

        foreach ($productos as $producto) {
            if(!DetallePromo::where('promo', '=',$promo_id)
                ->where('producto', '=',$producto)
                ->update(['cantidad' => 0,'visible'=>0]))
                dd('error');
        }
        return redirect('/admin/promocion/'.$id.'/productos');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
