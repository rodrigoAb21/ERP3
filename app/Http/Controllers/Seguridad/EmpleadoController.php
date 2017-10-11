<?php

namespace App\Http\Controllers\Seguridad;

use App\Bitacora;
use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Modelos\Seguridad\Empleado;
use App\User;
use DB;

class EmpleadoController extends Controller
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
            $empleado=DB::table('empleado')->where('nombre','LIKE','%'.$query.'%')
                ->where('tipo','!=','Administrador')
                ->orderBy('id','asc')
                ->paginate(25);

            return view('admin.Seguridad.empleados.index',["empleado" => $empleado, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.Seguridad.empleados.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user2 = new User();
        $user2 -> name = $request -> get('nombre');
        $user2 -> email = $request -> get('email');
        $user2 -> password = bcrypt($request->get('password'));
        $user2 -> tipo = 'Empleado';
        //$empleado -> idEmpresa = Auth::user()->idEmpresa;
        //
        if($user2 -> save())
        {
            $empleado = new Empleado();
            $empleado -> ci = $request -> get('ci');
            $empleado -> nombre = $request -> get('nombre');
            $empleado -> direccion = $request -> get('direccion');
            $empleado -> ocupacion = $request -> get('ocupacion');
            $empleado -> telefono = $request -> get('telefono');
            $empleado -> tipo = 'Empleado';
            $empleado -> idEmpresa = Auth::user()->idEmpresa;
            if($empleado -> save())
            {
                $user2 -> idEmpleado = $empleado->id;
                $user2->save();
                Bitacora::registrarCreate(Utils::$TABLA_EMPLEADO,$empleado->id);
            }

        }
        else{

        }

        return Redirect::to('admin/empleados');
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
        return view("admin.Seguridad.empleados.edit",["empleado"=>empleado::findOrFail($id)]);
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
        $ultimo2 = DB::table('users')
        ->where('idEmpleado', '=', $id)
        ->first();

        $user4 = User::findOrFail($ultimo2->id);
        $user4->name = $request->get('nombre');
        if($user4->update())
        {
            $empleado = Empleado::findOrFail($id);
            $empleado -> ci = $request -> get('ci');
            $empleado -> nombre = $request -> get('nombre');
            $empleado -> direccion = $request -> get('direccion');
            $empleado -> ocupacion = $request -> get('ocupacion');
            $empleado -> telefono = $request -> get('telefono');
            $empleado -> tipo = 'Empleado';

            $empleado -> update();
            Bitacora::registrarUpdate(Utils::$TABLA_EMPLEADO,$empleado->id);
        }
        return Redirect::to('admin/empleados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bitacora::registrarDelete(Utils::$TABLA_EMPLEADO,$id);
    }
}