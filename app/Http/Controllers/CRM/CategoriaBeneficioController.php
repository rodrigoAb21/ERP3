<?php

namespace App\Http\Controllers\CRM;

use App\Modelos\CRM\CategoriaBeneficio;
use App\Modelos\CRM\CategoriaCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoriaBeneficioController extends Controller
{
    public function editarBeneficios($id)
    {
        $categoria=CategoriaCliente::findOrFail($id);
        $otros_beneficios=DB::select('SELECT beneficio.id,beneficio.nombre
                                    FROM beneficio
                                    WHERE beneficio.visible=1 and beneficio.idEmpresa=?
                                     and beneficio.id not in
                                     (SELECT categoria_beneficio.beneficio from categoria_beneficio 
                                     WHERE categoria_beneficio.categoria=? and categoria_beneficio.visible=1)',
            [Auth::user()->idEmpresa,$id]);

        return view ('admin.CRM.categoria.beneficios',compact('categoria','otros_beneficios'));
    }

    public function agregar(Request $request)
    {
        $beneficios=$request->beneficio;
        $categoria_id=$request->id;
        $i=0;
        foreach ($beneficios as $beneficio){
            if(! CategoriaBeneficio::where('categoria', '=',$categoria_id)
                ->where('beneficio', '=',$beneficio)
                ->update(['visible'=>1]))
            {
                $detalle=new CategoriaBeneficio;
                $detalle->categoria=$categoria_id;
                $detalle->beneficio=$beneficio;
                $detalle->visible=1;
                $detalle->save();
            }
            $i++;
        }
        return redirect('admin/categoriaCliente/'.$categoria_id.'/beneficios');
    }
    public function remover(Request $request)
    {
        $beneficios=$request->beneficio;
        $categoria_id=$request->id;
        $i=0;
        foreach ($beneficios as $beneficio){
            if(! CategoriaBeneficio::where('categoria', '=',$categoria_id)
                ->where('beneficio', '=',$beneficio)
                ->update(['visible'=>0]))
            {

            }
            $i++;
        }
        return redirect('admin/categoriaCliente/'.$categoria_id.'/beneficios');
    }
}
