<?php

namespace App\Modelos\Seguridad\AsignacionPermisos;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];
    public function casousos()
    {
        return $this->belongsToMany('App\Modelos\Seguridad\AsignacionPermisos\Casouso',
            'permisos',
            'rol_id',
            'casouso_id')
            ->withPivot('leer', 'crear','editar','eliminar');
    }
}
