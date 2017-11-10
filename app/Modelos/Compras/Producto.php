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

    public $timestamps = false;

    protected $fillable = ['nombre', 'especificacion', 'garantia', 'puntosEquivale', 'puntosPorVenta', 'precioUCompra', 'precioUVenta', 'precioActual', 'imagen', 'tipo_id', 'visible', 'idEmpresa'];

    public function scopegetProductos($query){
        $productos = $query ->select('id','nombre','precioActual') -> where('visible', '=', '1') -> get();
        return $productos;
    }
}

