<?php

namespace App\Modelos\Compras;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{


    protected $table = 'producto';


    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['nombre',
        'especificacion', 'garantia',
        'puntosEquivale', 'puntosPorVenta',
        'precioUCompra', 'precioUVenta',
        'precioActual', 'imagen', 'tipo_id',
        'visible', 'idEmpresa'];

    public function scopegetProductos($query){
        $productos = $query ->select('id','nombre','precioActual') -> where('visible', '=', '1') -> get();
        return $productos;
    }
    public function promociones()
    {
        return $this->belongsToMany('App\Modelos\CRM\Promocion',
            'detalle_promo',
            'producto',
            'promo')
            ->withPivot('precio','visible');
    }

}

