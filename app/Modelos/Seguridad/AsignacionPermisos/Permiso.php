<?php

namespace App\Modelos\Seguridad\AsignacionPermisos;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';

    protected $primaryKey = 'casouso_id';
    public $timestamps = false;

    protected $fillable = [
        'casouso_id',
        'rol_id',
        'leer',
        'crear',
        'editar',
        'eliminar'
    ];
}
