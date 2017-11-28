<?php
namespace App\Modelos\Compras;

use Illuminate\Database\Eloquent\Model;

class LoteProducto extends Model
{
    protected $table = 'lote_producto';

    protected $primaryKey = 'idNotaCompra';

    public $timestamps = false;

    protected $fillable = [
        'idNotaCompra',
        'idProducto',
        'cantidad',
        'precioU',
        'subtotal'
    ];

}