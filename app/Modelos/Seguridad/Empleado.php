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
  public function rol()
    {
        return $this->belongsTo('App\Seguridad\Rol', 'rol_id','id');
    }
}
