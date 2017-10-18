<?php

namespace App\Http\Controllers\Seguridad;

use App\Seguridad\Casouso;
use App\Seguridad\Permiso;
use App\Seguridad\Rol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RolController extends Controller
{

    public function index()
    {
        $roles = Rol::all();
        $rolSearch = Rol::where('nombre', '=', 'ADMINISTRADOR')->firstOrFail();
        return view('admin.seguridad.rol.index',
            compact('roles', 'rolSearch'));
    }

    public function buscar(Request $request)
    {

        $depto_id = $request->depto;
        if (!is_null($depto_id)) {
            $rolSearch = Rol::where('id', '=', $depto_id)->firstOrFail();
        } else {
            return Redirect::to('/admin/rol');
        }
        $roles = Rol::all();
        return view('admin.seguridad.rol.index',
            compact('roles', 'rolSearch'));
    }
    //id1=casouso_id
    //id2=rol_id
    public function editarAcciones($id1, $id2)
    {
        $rol = Rol::where('id', '=', $id2)->firstOrFail();
        if (!is_null($rol)) {

            foreach ($rol->casousos as $cu) {
                if ($cu->id == $id1) {
                    return view('admin.seguridad.rol.edit-acciones',
                        compact('rol', 'cu'));
                }
            }
        }
        return Redirect::to('/admin/rol');
    }

    public function actualizarAcciones(Request $request)
    {
        $rol = $request->rol;
        $cu = $request->cu;
        $leer = $crear = $editar = $eliminar = 0;
        if ($request->leer == 'on')
            $leer = 1;
        if ($request->crear == 'on')
            $crear = 1;
        if ($request->editar == 'on')
            $editar = 1;
        if ($request->eliminar == 'on')
            $eliminar = 1;

        Permiso::where('casouso_id', '=', $cu)
            ->where('rol_id', '=', $rol)
            ->update(['leer' => $leer,
                'crear' => $crear,
                'editar' => $editar,
                'eliminar' => $eliminar
            ]);
        return Redirect::to('/admin/rol');

    }
    public function listaRoles()
    {
        $roles = Rol::paginate(6);
        return view('admin.seguridad.rol.lista-rol',compact('roles'));
    }
    //guardar un rol
    public function guardar(Request $request)
    {
        $nombre=$request->nombre;
        if($nombre!='')
        {
            $rol=new Rol;
            $rol->nombre=$nombre;
            if($rol->save())
            {
                $roles=Rol::all();
                return view('admin.seguridad.rol.lista-rol',
                    compact('roles'));
            }


        }
        return Redirect::to('/admin/rol');
    }
    public function actualizarCus($id)
    {
        $rol=Rol::findOrFail($id);
        if(!is_null($rol))
        {
            $cuDisponibles=DB::select('SELECT casousos.id,casousos.nombre
FROM casousos 
WHERE casousos.id NOT IN (SELECT casousos.id
FROM roles,casousos,permisos
WHERE roles.id=?
and roles.id=permisos.rol_id
and casousos.id=permisos.casouso_id)',[$rol->id]);
          return view('admin.seguridad.rol.editar-rol',compact('rol','cuDisponibles'));
        }
    }
    public function removerCus(Request $request)
    {
        $rol=$request->rol;
        $cus=$request->remover;
        foreach ($cus as $cu){
            $permiso=Permiso::where([['casouso_id','=',$cu],['rol_id','=',$rol]])->firstOrFail();
            $permiso->delete();
        }
        return Redirect::to('/admin/rol/actualizar-cu/'.$rol);
    }
    public function agregarCus(Request $request)
    {
        $rol=$request->rol;
        $cus=$request->agregar;
        foreach ($cus as $cu){
            $permiso=new Permiso();
            $permiso->rol_id=$rol;
            $permiso->casouso_id=$cu;
            $permiso->save();
        }
        return Redirect::to('/admin/rol/actualizar-cu/'.$rol);
    }

}
