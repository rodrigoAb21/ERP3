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

    public function scopegetPago($query, $id){
        $pago = $query -> join('cliente', 'cliente.id', '=', 'pago.idCliente')
            -> join('punto', 'punto.id', '=', 'pago.idPuntoVenta')
            -> join('empleado', 'empleado.id', '=', 'pago.idEmpleado')
            -> select('pago.id', 'pago.fecha', 'empleado.nombre as empleado', 'pago.montoTotal', 'pago.nit', 'pago.nombre', 'cliente.nombre as cliente', 'punto.nombre as punto', 'pago.nroCuotas', 'pago.interes','pago.plazo','pago.montoCuota')
            -> where('pago.id', '=', $id)
            -> first();
        return $pago;
    }

}
