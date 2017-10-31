<?php

namespace App\Modelos\CRM;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimiento';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'fechaInicio',
        'idCliente',
        'idEstado',
        'idEmpleado',
        'visible',
        'proposito'
    ];

    public function empleado()
    {
        return $this->belongsTo('App\Modelos\Seguridad\Empleado','idEmpleado');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Modelos\Ventas\Cliente','idCliente');
    }
    public function estado()
    {
        return $this->belongsTo('App\Modelos\CRM\Estado','idEstado');
    }

    public function tareas()
    {
        return $this->belongsToMany('App\Modelos\CRM\Tarea', 'asignacion', 'seguimiento', 'tarea')
            ->withPivot('fecha','nota', 'hora_inicio','hora_final');
    }
}
