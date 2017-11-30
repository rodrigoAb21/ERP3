<?php

namespace App\Http\Controllers\Movil;
use App\Http\Controllers\Controller;
use App\Modelos\Seguridad\empresa;
use App\Modelos\Ventas\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        $empresas=Empresa::all();
        return view('movil.login.login',compact('empresas'));
    }
    public function empresa($id)
    {
        $empresa=Empresa::find($id);
        Session::put('empresa',$empresa->nombre);
        Session::put('empresa_id',$id);
        return redirect('movil/login/');
    }

    public function ingresar(Request $request)
    {
        $email=$request->email;
        $cliente=$this->findORFail($email);
        if(isset($cliente))
        {
            return $this->guardarSession($cliente);
        }
        else
        {

            $empresas=Empresa::all();
            return view('movil.login.login',
                compact('empresas','email'));
        }




    }

    public function salir()
    {

    }

    public function findORFail($email)
    {
        return   Cliente::where('email','=',$email)->first();

    }

    /**
     * @param $cliente
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function guardarSession($cliente)
    {
        Session::put('puntos', $cliente->puntosAcumulados);
        Session::put('cliente_id', $cliente->id);
        return redirect('movil/catalogo');
    }
}
