<?php

namespace App\Http\Controllers\CRM;

use App\Modelos\CRM\CategoriaBeneficio;
use App\Modelos\CRM\CategoriaCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                ->where('idEmpresa',Auth::user()->idEmpresa)
                ->paginate(25);
            return view('admin.CRM.categoria.index',["categorias" => $categorias, "searchText" => $query]);
        }
    }

    public function create()
    {
        return view('admin.CRM.categoria.create');
    }

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
        $categoria->idEmpresa= Auth::user()->idEmpresa;
        $categoria->visible= '1';
        if($categoria->save())
            return redirect('/admin/categoria');
    }

    public function edit($id)
    {
        return view("admin.CRM.categoria.edit",["categoria"=>CategoriaCliente::findOrFail($id)]);
    }

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



}
