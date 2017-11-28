<?php

namespace App\Http\Controllers\CRM;

use App\Modelos\CRM\CategoriaBeneficio;
use App\Modelos\CRM\CategoriaCliente;
use App\Modelos\CRM\CategoriaPromo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoriaPromocionController extends Controller
{
    public function editarPromociones($id)
    {
        $categoria=CategoriaCliente::findOrFail($id);
        $otros_promociones=$this->getAllWhere($id);

        return view ('admin.CRM.categoria.promociones',compact('categoria','otros_promociones'));
    }

    public function getAllWhere($id)
    {
        return DB::select('SELECT promocion.id,promocion.nombre,promocion.fechaEmpieza,promocion.fechaTermina
                                    FROM promocion
                                    WHERE promocion.visible=1 and promocion.idEmpresa=? 
                                     and promocion.id not in
                                     (SELECT categoria_promo.promo from categoria_promo 
                                     WHERE categoria_promo.categoria=? and categoria_promo.visible=1  )',
            [Auth::user()->idEmpresa,$id]);
}
    public function agregarPromo(Request $request)
    {
        $promos=$request->promo;
        $categoria_id=$request->id;
        $i=0;
        foreach ($promos as $item){
            if(! CategoriaPromo::where('categoria', '=',$categoria_id)
                ->where('promo', '=',$item)
                ->update(['visible'=>1]))
            {
                $detalle=new CategoriaPromo;
                $detalle->categoria=$categoria_id;
                $detalle->promo=$item;
                $detalle->visible=1;
                $detalle->save();
            }
            $i++;
        }
        return redirect('admin/categoriaCliente/'.$categoria_id.'/promociones');
    }
    public function removerPromo(Request $request)
    {
        $promos=$request->promo;
        $categoria_id=$request->id;
        $i=0;
        foreach ($promos as $item){
            CategoriaPromo::where('categoria', '=',$categoria_id)
                ->where('promo', '=',$item)
                ->update(['visible'=>0]);

            $i++;
        }
        return redirect('admin/categoriaCliente/'.$categoria_id.'/promociones');
    }
}
