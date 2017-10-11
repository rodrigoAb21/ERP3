<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use App\Modelos\Seguridad\Empleado;
use App\Modelos\Seguridad\Empresa;
use App\User;
use DB;
use Illuminate\Support\Facades\Redirect;


class AdminController extends RegisterController
{
    function crear(Request $request){
        $admin = new Empleado();
        $admin -> ci = $request -> get('ci');
        $admin -> nombre = $request -> get('nombre');
        $admin -> direccion = $request -> get('direccion');
        $admin -> ocupacion = 'Administrador';
        $admin -> telefono = $request -> get('telefono');
        $admin -> tipo = 'Administrador';
        $admin -> idEmpresa = null;
        $admin -> save();

        $user2 = new User();
        $user2 -> name = $request -> get('nombre');
        $user2 -> email = $request -> get('email');
        $user2 -> password = bcrypt($request->get('password'));
        $user2 -> remember_token = null;
        $user2 -> tipo = 'Administrador';
        $user2 -> idEmpleado = $admin->id;
        $user2 -> idCliente = null;
        $user2 -> save();

        $empresa = new Empresa();
        $empresa -> nit = $request -> get('nit');
        $empresa -> nombre = $request -> get('empresa');
        $empresa -> direccion = $request -> get('dEmpresa');
        $empresa -> telefono = $request -> get('tEmpresa');
        $empresa -> email = $request -> get('eEmpresa');
        $empresa -> idEmpleado = $admin->id;
        $empresa -> save();

        $admin -> idEmpresa = $empresa -> id;
        $admin -> update();

        $user2 -> idEmpresa = $empresa -> id;
        $user2 -> update();

        return Redirect::to('login');
    }
}
