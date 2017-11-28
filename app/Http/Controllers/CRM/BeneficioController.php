<?php

namespace App\Http\Controllers\CRM;

use App\Modelos\CRM\Beneficio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use DB;

class BeneficioController extends Controller
{

    public function index(Request $request)
    {
        if ($request){
            $query = trim($request -> get('searchText'));
            $beneficio=DB::table('beneficio')->where('nombre','LIKE','%'.$query.'%')
                ->orderBy('id','asc')
                ->where('visible','1')
                ->where('idEmpresa',Auth::user()->idEmpresa)
                ->paginate();
            return view('admin.CRM.beneficios.index',["beneficio" => $beneficio, "searchText" => $query]);
        }
    }

    public function create()
    {
        return view('admin.CRM.beneficios.create');
    }

    public function store(Request $request)
    {

        $beneficio=new Beneficio();
        $beneficio->nombre=$request->get('nombre');
        $beneficio->descripcion=$request->get('descripcion');
        $beneficio -> visible = '1';
        if($beneficio->save())
            return redirect('/admin/beneficios');
    }


    public function edit($id)
    {
        return view("admin.CRM.beneficios.edit",["beneficio"=>beneficio::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $beneficio = beneficio::findOrFail($id);
        $beneficio-> nombre = $request->get('nombre');
        $beneficio -> descripcion = $request->get('descripcion');
        $beneficio -> update();
        return Redirect::to('admin/beneficios');
    }
    public function destroy($id)
    {
        $beneficio = beneficio::findOrFail($id);
        $beneficio -> visible = '0';
        $beneficio -> update();
        return Redirect::to('admin/beneficios');
    }
}
