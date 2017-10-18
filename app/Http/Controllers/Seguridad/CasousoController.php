<?php

namespace App\Http\Controllers\Seguridad;

use App\Seguridad\Casouso;
use App\Seguridad\Departamento;
use App\Seguridad\Permiso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

    public function guardar(Request $request)
    {
        $nombreCU=$request->nombre;
        $depto_id=$request->depto;
        if($nombreCU!='' && $depto_id!=0)
        {
            $casouso=new Casouso;
            $casouso->nombre=$nombreCU;
            $casouso->depto_id=$depto_id;
            if($casouso->save())
            {
                $permiso= new Permiso;
                $permiso->casouso_id=$casouso->id;
                $permiso->rol_id=1;//rol Administrador
                $permiso->leer=1;
                $permiso->crear=1;
                $permiso->editar=1;
                $permiso->eliminar=1;
                $permiso->save();
            }
        }
        return Redirect::to('/admin/casouso');
    }

}
