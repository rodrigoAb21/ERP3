<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beneficio;
use Illuminate\Support\Facades\Redirect;
use DB;

class BeneficioController extends Controller
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
            $beneficio=DB::table('beneficio')->where('nombre','LIKE','%'.$query.'%')
                ->orderBy('id','asc')
                ->where('visible','1')
                ->paginate();
            return view('admin.beneficios.index',["beneficio" => $beneficio, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.beneficios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $beneficio=new Beneficio();
        $beneficio->nombre=$request->get('nombre');
        $beneficio->descripcion=$request->get('descripcion');
        $beneficio -> visible = '1';
        if($beneficio->save())
            return redirect('/admin/beneficios');
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
        return view("admin.beneficios.edit",["beneficio"=>beneficio::findOrFail($id)]);
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
        $beneficio = beneficio::findOrFail($id);
        $beneficio-> nombre = $request->get('nombre');
        $beneficio -> descripcion = $request->get('descripcion');
        $beneficio -> update();
        return Redirect::to('admin/beneficios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beneficio = beneficio::findOrFail($id);
        $beneficio -> visible = '0';
        $beneficio -> update();
        return Redirect::to('admin/beneficios');
    }
}
