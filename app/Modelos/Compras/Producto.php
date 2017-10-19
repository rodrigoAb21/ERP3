<?php

namespace App\Modelos\Compras;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'producto';
    public $timestamps = false;

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'especificacion',
        'garantia', 'puntosEquivale', 'puntosPorVenta',
        'precioUCompra', 'precioUVenta',
        'precioActual', 'categoria_id', 'visible'];


}

