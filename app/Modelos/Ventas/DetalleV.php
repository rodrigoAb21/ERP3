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

    public function scopegetDetalle($query, $id){
        $detalles = $query -> join('producto', 'producto.id', '=', 'detallev.idProducto')
            -> select('producto.nombre', 'detallev.cantidad', 'producto.precioActual', 'detallev.subtotal')
            -> where('detallev.idPago','=', $id)->get();
        return $detalles;
    }

}
