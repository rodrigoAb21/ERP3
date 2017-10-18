<?php

namespace App\Modelos\Seguridad\AsignacionPermisos;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre'
    ];
}
