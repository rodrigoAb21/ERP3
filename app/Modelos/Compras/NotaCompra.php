<?php
namespace App\Modelos\Compras;

use Illuminate\Database\Eloquent\Model;

class NotaCompra extends Model
{
    protected $table = 'notaCompra';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'montoTotal',
        'idEmpresa',
        'idProveedor',
        'cantidadProductos',
        'finalizado'
    ];
    public function proveedor()
    {
        return $this->belongsTo('App\Modelos\Compras\Proveedor','idProveedor');
    }
    public function productos()
    {
        return $this->belongsToMany('App\Modelos\Compras\Producto',
            'lote_producto',
            'idNotaCompra',
            'idProducto')
            ->withPivot('cantidad', 'precioU','subtotal');
    }

}