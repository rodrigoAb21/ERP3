<?php

namespace App\Http\Controllers\CRM;

use App\Modelos\CRM\CategoriaBeneficio;
use App\Modelos\CRM\CategoriaCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoriaClienteController extends Controller
{

    public function index(Request $request)
    {
        if ($request){
            $query = trim($request -> get('searchText'));
            $categorias=DB::table('categoria_cliente')->where('nombre','LIKE','%'.$query.'%')
                ->where ('visible','=','1')
                ->orderBy('id','asc')
                ->paginate(25);
            return view('admin.CRM.categoria.index',["categorias" => $categorias, "searchText" => $query]);
        }
    }

    public function create()
    {
        return view('admin.CRM.categoria.create');
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
        $categoria->puntosRequeridos=$request->puntosRequeridos;
        $categoria->frecuenciaRequerida=$request->frecuenciaRequerida;
        $categoria->montoRequerido=$request->montoRequerido;
        $categoria->cantDiasReserva=$request->cantDiasReserva;
        $categoria->cantProdReserva=$request->cantProdReserva;
        $categoria->idEmpresa= '12321';
        $categoria->visible= '1';
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
        return view("admin.CRM.categoria.edit",["categoria"=>CategoriaCliente::findOrFail($id)]);
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
        $categoria=CategoriaCliente::findOrFail($id);
        $categoria->nombre=$request->nombre;
        $categoria->descripcion=$request->descripcion;
        $categoria->puntosRequeridos=$request->puntosRequeridos;
        $categoria->frecuenciaRequerida=$request->frecuenciaRequerida;
        $categoria->montoRequerido=$request->montoRequerido;
        $categoria->cantDiasReserva=$request->cantDiasReserva;
        $categoria->cantProdReserva=$request->cantProdReserva;
        if($categoria->update())
            return redirect('/admin/categoria');
    }

    public function destroy($id)
    {
        $categoria = CategoriaCliente::findOrfail($id);
        $categoria->visible= '0';
        if($categoria->update())
            return redirect('/admin/categoria');
    }

    public function beneficios($id)
    {
        $categoria = CategoriaCliente::findOrfail($id);
        $otros=DB::select('SELECT * 
FROM beneficio 
WHERE beneficio.id NOT IN (SELECT categoria_beneficio.beneficio 
FROM categoria_beneficio
WHERE categoria_beneficio.categoria=? and categoria_beneficio.visible=1)',[$id]);
        return view('admin.CRM.categoria.beneficios', compact('categoria','otros'));
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
}
