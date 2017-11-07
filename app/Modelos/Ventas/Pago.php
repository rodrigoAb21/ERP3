<?php

namespace App\Modelos\Ventas;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'montoTotal',
        'fecha',
        'nombre',
        'tipo',
        'nit',
        'estado',
        'idEmpresa',
        'idPuntoVenta',
        'idCliente',
        'idEmpleado',
    ];
}
