<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Modelos\CRM\Tarea;
use DB;

class TareaController extends Controller
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
            $tarea=DB::table('tarea')->where('nombre','LIKE','%'.$query.'%')
                ->where ('visible','=','1')
                ->orderBy('id','asc')
                ->paginate(25);
            return view('admin.CRM.tareas.index',["tarea" => $tarea, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.CRM.tareas.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tarea = new tarea;
        $tarea -> nombre = $request->get('nombre');
        $tarea -> descripcion = $request->get('descripcion');
        $tarea -> visible = '1';
        $tarea -> save();
        return Redirect::to('admin/tareas');
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
        return view("admin.CRM.tareas.edit",["tarea"=>tarea::findOrFail($id)]);
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
        $tarea = tarea::findOrFail($id);
        $tarea -> nombre = $request->get('nombre');
        $tarea -> descripcion = $request->get('descripcion');
        $tarea -> update();
        return Redirect::to('admin/tareas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarea = tarea::findOrFail($id);
        $tarea -> visible = '0';
        $tarea -> update();
        return Redirect::to('admin/tareas');
    }
}
