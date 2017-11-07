<?php

namespace App\Modelos\Ventas;

use Illuminate\Database\Eloquent\Model;

class DetalleV extends Model
{
    protected $table = 'detallev';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'idPago',
        'idProducto',
        'cantidad',
        'subtotal',
        'detalle'
    ];
}
