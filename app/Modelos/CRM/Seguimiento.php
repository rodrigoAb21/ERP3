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
    ];
}
