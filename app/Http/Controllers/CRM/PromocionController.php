<?php

namespace App\Http\Controllers;


use App\Modelos\CRM\DetallePromo;
use App\Modelos\CRM\Promocion;
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
        return view('admin.CRM.promocion.index',compact('promociones','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Nueva Promocion';

        return view('admin.CRM.promocion.create',compact('title'));
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
        return view('admin.CRM.promocion.productos', compact('promocion', 'productos','otros_productos'));
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
    public function store(Request $request)
    {
        $promocion = new Promocion;
        $promocion->nombre = $request->nombre;
        $promocion->fechaEmpieza=$request->fechaComienzo;
        $promocion->fechaTermina=$request->fechaFinal;
        $promocion->visible=1;
        $promocion->save();

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
}
