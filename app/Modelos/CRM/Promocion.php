<?php

namespace App\Modelos\CRM;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = 'promocion';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'fechaEmpieza',
        'fechaTermina'
    ];
    public function productos()
    {
        return $this->belongsToMany('App\Producto','detalle_promo',
            'promo', 'producto')->withPivot('cantidad')->where('detalle_promo.visible','=',1);
    }
}
