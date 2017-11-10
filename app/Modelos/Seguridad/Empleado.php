<?php

namespace App\Modelos\Seguridad;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{ 
    protected $table = 'empleado';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'ci',
        'nombre',
        'direccion',
        'ocupacion',
        'telefono',
        'tipo',
        'idEmpresa',
        'rol_id'
    ];

    public function scopegetEmpleado($query, $id){
        return $this->findOrFail($id);
    }

    public function scopegetEmpleados($query, $id){
        $empleados = $query -> where('visible', '=', '1') -> get();
        return $empleados;
    }

  public function rol()
    {
        return $this->belongsTo('App\Modelos\Seguridad\AsignacionPermisos\Rol', 'rol_id','id');
    }
    public function user()
    {
        return $this->hasOne('App\User','idEmpleado');
    }
}
