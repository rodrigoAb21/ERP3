<?php

namespace App\Seguridad;
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
        return $this->belongsToMany('App\Seguridad\Casouso',
            'permisos',
            'rol_id',
            'casouso_id')
            ->withPivot('leer', 'crear','editar','eliminar');
    }
}
