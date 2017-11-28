<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Modelos\CRM\DetallePromo;
use App\Modelos\CRM\Promocion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetallePromoController extends Controller
{
    public function editarProductos($id)
    {
        $promocion=Promocion::findOrFail($id);
        $otros_productos=$this->getAllWhere($id);

        return view ('admin.CRM.promocion.product',compact('promocion','otros_productos'));
    }

    public function getAllWhere($id)
    {
        return DB::select('SELECT producto.id,producto.nombre,producto.precioUVenta
                                    FROM producto
                                    WHERE producto.visible=1
                                     and producto.id not in
                                     (SELECT detalle_promo.producto from detalle_promo 
                                     WHERE detalle_promo.promo=? and detalle_promo.visible=1)',
            [$id]);
    }

    public function actualizarPrecio(Request $request)
    {
        $promo_id=$request->promo_id;
        $precios=$request->precio ;
        $productos=$request->producto;
        $i=0;
        foreach ($productos as $producto) {
            DetallePromo::where('promo', '=',$promo_id)
                ->where('producto', '=',$producto)
                ->update(['precio' => $precios[$i]]);
            $i++;
        }

        return redirect('admin/promocion/'.$promo_id.'/editarProductos');

    }
    public function agregar(Request $request)
    {
        $productos=$request->producto;
        $promo_id=$request->id;
        $i=0;
        foreach ($productos as $producto){
            if(! DetallePromo::where('promo', '=',$promo_id)
                ->where('producto', '=',$producto)
                ->update(['precio' => $request->precio[$i],'visible'=>1]))
            {
                $detalle=new DetallePromo;
                $detalle->promo=$promo_id;
                $detalle->producto=$producto;
                $detalle->precio=$request->precio[$i];
                $detalle->visible=1;
                $detalle->save();
            }
            $i++;
        }
        return redirect('admin/promocion/'.$promo_id.'/editarProductos');
    }
    public function remover(Request $request, $id)
    {
        $productos=$request->producto;
        $promo_id=$request->id;
        foreach ($productos as $producto) {
            DetallePromo::where('promo', '=',$promo_id)
                ->where('producto', '=',$producto)
                ->update(['visible'=>0]);

        }
        return redirect('/admin/promocion/'.$promo_id.'/editarProductos');
    }

}
