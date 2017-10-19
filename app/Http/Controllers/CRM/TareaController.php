<?php

namespace App\Http\Controllers\CRM;

use App\Bitacora;
use App\Utils;
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
        if ($tarea -> save()){
            Bitacora::registrarCreate(Utils::$TABLA_TAREA, $tarea -> id);
        }
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
    public function update(Request $request)
    {
        $tarea = tarea::findOrFail($request -> id);
        $tarea -> nombre = $request->get('nombre');
        $tarea -> descripcion = $request->get('descripcion');
        if ($tarea -> update()){
            Bitacora::registrarUpdate(Utils::$TABLA_TAREA,$request -> id);
        }
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
        if ($tarea -> update()){
            Bitacora::registrarDelete(Utils::$TABLA_TAREA,$id);
        }
        return Redirect::to('admin/tareas');
    }
}
