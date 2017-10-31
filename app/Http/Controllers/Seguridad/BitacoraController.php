<?php

namespace App\Http\Controllers\Seguridad;

use App\Modelos\Seguridad\Bitacora;
use App\Http\Controllers\Controller;

class BitacoraController extends Controller
{


    public function index()
    {
        $bitacoras = Bitacora::all();
        return view('admin.Seguridad.bitacora.index',
            compact('bitacoras','empleados','tiempo','user_id'));
    }
    public function show($id)
    {
        $bitacora=Bitacora::findOrFail($id);
        return view('admin.Seguridad.bitacora.show',compact('bitacora'));
    }

    public function getFecha($tiempo)
    {
        $desde='';
        switch ($tiempo) {
            case 1://hoy
                $desde = '2017-10-18';
                break;
            case 2://ayer
                $desde = '2017-10-17';
                break;
            case 3://1semana
                $desde = '2017-10-11';
                break;
            case 4://1 mes
                $desde = '2017-9-28';
                break;
        }
        return $desde;
    }
}
