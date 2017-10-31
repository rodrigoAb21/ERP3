<?php

namespace App\Http\Controllers\Seguridad;


use App\Modelos\Seguridad\AsignacionPermisos\Casouso;
use App\Modelos\Seguridad\AsignacionPermisos\Departamento;
use App\Modelos\Seguridad\AsignacionPermisos\Permiso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CasousoController extends Controller
{
    public function index()
    {

        $deptoSeach=0;
        $casousoSearch='';
        $cus=Casouso::all();
        $deptos=Departamento::all();
        return view('admin.Seguridad.casouso.index',
            compact('cus','deptos',
                'deptoSeach','casousoSearch'));
    }
    public function buscar(Request $request)
    {
        $deptoSeach=$request->depto;
        $casousoSearch=$request->casouso;
        $cus=null;
        $deptos=Departamento::all();
        if($deptoSeach>0)
        {
            $cus=Casouso::where([
                ['depto_id','=',$deptoSeach],
                ['nombre','like','%'.$casousoSearch.'%']
            ])->get();
        }else
        {
            $cus=Casouso::where('nombre','like','%'.$casousoSearch.'%')->get();
        }
        return view('admin.Seguridad.casouso.index',
            compact('cus','deptos',
                'deptoSeach','casousoSearch'));
    }


}
