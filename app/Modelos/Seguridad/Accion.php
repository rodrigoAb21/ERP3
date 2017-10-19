<?php

namespace App\Modelos\Seguridad;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    protected $table = 'accion';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'tabla',
        'tupla',
        'fecha',
        'bitacora_id',
        'accion'
    ];

}
