<?php

namespace App\Http\Controllers;

use App\Modelos\Seguridad\Empleado;
use App\Modelos\Seguridad\Empresa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function vistaAdmin(){
        return view('admin');
    }

    public function editarPerfil($id){
        return view('admin.Seguridad.perfil.editarPerfil',["admin" => Empleado::findOrFail($id)]);
    }

    public function guardarPerfil(Request $request, $id){
        $empleado = empleado::findOrFail($id);
        $empleado -> ci = $request -> get('ci');
        $empleado -> nombre = $request -> get('nombre');
        $empleado -> direccion = $request -> get('direccion');
        $empleado -> telefono = $request -> get('telefono');
        $empleado -> tipo = 'Empleado';
        $empleado -> update();

        $user4 = User::findOrFail(Auth::user() -> id);
        $user4 -> name = $request -> get('nombre');
        $user4 -> update();

        return Redirect::to('admin');
    }




    public function editarCuenta(){
        return view('admin.Seguridad.perfil.editarCuenta',["usuario" => User::findOrFail(Auth::user()->id)]);
    }

    public function guardarCuenta(Request $request){
        $user4 = User::findOrFail(Auth::user()->id);
        $user4 -> email = $request -> get('email');
        $user4 -> password = bcrypt($request->get('password'));
        $user4 -> update();

        return Redirect::to('admin');
    }



    public function editarConf(){
        return view('admin.Seguridad.perfil.editarConfig',["usuario" => User::findOrFail(Auth::user()->id)]);
    }

    public function guardarConf(Request $request){
        $user4 = User::findOrFail(Auth::user()->id);
        $user4 -> color = $request -> get('color');
        $user4 -> fondo = $request -> get('fondo');
        $user4 -> fuente = $request -> get('fuente');
        $user4 -> update();

        return Redirect::to('admin');
    }


    public function editarEmpresa(){
        return view('admin.Seguridad.perfil.editarEmpresa',["empresa" => Empresa::findOrFail(Auth::user()->idEmpresa)]);
    }

    public function guardarEmpresa(Request $request){

        $empresa = Empresa::findOrFail(Auth::user()->idEmpresa);
        $empresa -> nit = $request -> get('nit');
        $empresa -> nombre = $request -> get('nombre');
        $empresa -> direccion = $request -> get('direccion');
        $empresa -> telefono = $request -> get('telefono');
        $empresa -> email = $request -> get('email');
        $empresa -> update();

        return Redirect::to('admin');
    }








}
