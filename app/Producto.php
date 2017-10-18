<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'producto';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'garantia',
        'especificacion',
        'categoria_id',
        'precioActual',
        'precioUVenta',
        'precioUCompra',
        'puntosEquivale',
        'puntosPorVenta'
    ];
}

