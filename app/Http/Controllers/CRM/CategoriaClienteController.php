<?php

namespace App\Http\Controllers;

use App\CategoriaBeneficio;
use App\CategoriaCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaClienteController extends Controller
{
    public function index()
    {
        $categorias = DB::table('categoria_cliente')
            ->where('visible','=',1)
            ->get();
        return view('categoria.index',compact('categorias'));
    }
    public function beneficios($id)
    {
        $categoria = CategoriaCliente::findOrfail($id);
        $otros=DB::select('SELECT * 
FROM beneficio 
WHERE beneficio.id NOT IN (SELECT categoria_beneficio.beneficio 
FROM categoria_beneficio
WHERE categoria_beneficio.categoria=? and categoria_beneficio.visible=1)',[$id]);
        return view('categoria.beneficios', compact('categoria','otros'));
    }
    public function agregar(Request $request,$id)
    {
        $beneficios=$request->beneficio;
        $catg_id=$request->id;
        foreach ($beneficios as $beneficio)
        {
            if(! CategoriaBeneficio::where('categoria', '=',$catg_id)
                    ->where('beneficio', '=',$beneficio)
                    ->update(['visible'=>1]))
            {
                    $detalle=new CategoriaBeneficio;
                    $detalle->categoria=$catg_id;
                    $detalle->beneficio=$beneficio;
                    $detalle->visible=1;
                    $detalle->save();
            }

        }
        return redirect('/admin/categoria/'.$id.'/beneficios');
    }
    public function remover(Request $request,$id)
    {
        $beneficios=$request->beneficio;
        $catg_id=$request->id;
        foreach ($beneficios as $beneficio)
        {
            if(! CategoriaBeneficio::where('categoria', '=',$catg_id)
                ->where('beneficio', '=',$beneficio)
                ->update(['visible'=>0]))
            {
                dd('error');
            }

        }
        return redirect('/admin/categoria/'.$id.'/beneficios');
    }
public function create()
{
    return view('categoria.create');
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria=new CategoriaCliente;
        $categoria->nombre=$request->nombre;
        $categoria->descripcion=$request->descripcion;
        if($categoria->save())
            return redirect('/admin/categoria');
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

    public function destroy($id)
    {
        $categoria = CategoriaCliente::findOrfail($id);

        if(!$categoria->delete())
        return redirect('/admin/categoria');
    }
}
