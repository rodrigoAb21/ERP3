<?php

namespace App\Http\Controllers\Movil;

use App\Modelos\CRM\CategoriaCliente;
use App\Modelos\Seguridad\Bitacora;
use App\Http\Controllers\Controller;
use App\Modelos\Seguridad\empresa;
use App\Modelos\Ventas\Cliente;
use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
{
    public function create()
    {
        $empresas=Empresa::all();
        return view ('movil.clientes.create',compact('empresas'));
    }


    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente -> ci = $request->get('ci');
        $cliente -> nombre = $request->get('nombre');
        $cliente -> puntosAcumulados = 0;
        $cliente -> direccion = $request->get('direccion');
        $cliente -> telefono = $request->get('telefono');
        $cliente -> email = $request->get('email');
        $cliente -> tipo = 'Cliente';
        $cliente -> idEmpresa = Session::get('empresa_id');
        $cliente -> visible = 1;
        $categorias=CategoriaCliente::where('idEmpresa','=',Session::get('empresa_id'))
                        ->get();
        $cliente -> idCategoria = $categorias[0]->id;
       $cliente -> save();

        $empresas=Empresa::all();

        return view('movil.login.login',compact('empresas','email'));
    }



}
