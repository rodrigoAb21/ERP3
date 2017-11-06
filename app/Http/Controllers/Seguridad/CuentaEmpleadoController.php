<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use DB;
use App\Modelos\Seguridad\Bitacora;
use App\Utils;
class CuentaEmpleadoController extends Controller
{

    public function index(Request $request)
    {
        if ($request){
            $query = trim($request -> get('searchText'));
            $usuario=DB::table('users')->where('name','LIKE','%'.$query.'%')
                ->where('tipo','!=','Administrador')
                ->orderBy('id','asc')
                ->paginate(25);
            return view('admin.Seguridad.cuentaEmpleados.index',["usuario" => $usuario, "searchText" => $query]);
        }
    }
    public function edit($id)
    {
        return view("admin.Seguridad.cuentaEmpleados.edit",["usuario"=>User::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        $user4 = User::findOrFail($id);
        $user4 -> email = $request -> get('email');
        $user4 -> password = bcrypt($request->get('password'));
        if($user4 -> update())
        {
            Bitacora::registrarUpdate( Utils::$TABLA_CUENTA_EMPLEADO,$user4->id,'se actualizo el acceso a la cuenta del empleado '. $user4->empleado->nombre);

        }
        return Redirect::to('admin/cuentaEmpleados');
    }

}