<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Bitacora extends Model
{
    protected $table = 'bitacora';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'fechaEntrada'
    ];

    public static function ingreso()
    {
        $bitacora= new Bitacora;
        $bitacora->user_id=Auth::user()->id;
        $bitacora->fechaEntrada= Carbon::now();
        if($bitacora->save())
            Session::put(Utils::$BITACORA_ID_SESSION,$bitacora->id);
        else
            dd('Error en bitacora');
    }

    public static function registrarUpdate($tabla,$tupla)
    {
        $accion1=new Accion;
        $accion1->accion=Utils::$ACTION_UPDATE;
        $accion1->bitacora_id=Session::get(Utils::$BITACORA_ID_SESSION);
        $accion1->fecha=Carbon::now();
        $accion1->tabla=$tabla;
        $accion1->tupla=$tupla;
        if(!$accion1->save())
            dd('Error en bitacora accion');
    }
    public static function registrarCreate($tabla,$tupla)
    {
        $accion1=new Accion;
        $accion1->accion=Utils::$ACTION_CREATE;
        $accion1->bitacora_id=Session::get(Utils::$BITACORA_ID_SESSION);
        $accion1->fecha=Carbon::now();
        $accion1->tabla=$tabla;
        $accion1->tupla=$tupla;
        if(!$accion1->save())
            dd('Error en bitacora accion');
    }
    public static function registrarDelete($tabla,$tupla)
    {
        $accion1=new Accion;
        $accion1->accion=Utils::$ACTION_DELETE;
        $accion1->bitacora_id=Session::get(Utils::$BITACORA_ID_SESSION);
        $accion1->fecha=Carbon::now();
        $accion1->tabla=$tabla;
        $accion1->tupla=$tupla;
        if(!$accion1->save())
            dd('Error en bitacora accion');
    }




}