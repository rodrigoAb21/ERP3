<?php
namespace App\Modelos\Compras;

use Illuminate\Database\Eloquent\Model;

class StockPuntoVenta extends Model
{
    protected $table = 'stock_puntoVenta';

    protected $primaryKey = ['idProducto','idPuntoVenta'];

    public $timestamps = false;

    protected $fillable = [
        'idPuntoVenta',
        'idProducto',
        'stock',
        'stock_minimo'
    ];

}