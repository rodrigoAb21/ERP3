<?php

namespace App\Modelos\CRM;

use Illuminate\Database\Eloquent\Model;

class CategoriaCliente extends Model
{
    protected $table = 'categoria_cliente';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'puntosRequeridos',
        'frecuenciaRequerida',
        'montoRequerido',
        'cantDiasReserva',
        'cantProdReserva',
        'idEmpresa',
        'visible'
    ];

    public function beneficios()
    {
        return $this->belongsToMany('App\Modelos\CRM\Beneficio',
            'categoria_beneficio','categoria', 'beneficio')
            ->where('categoria_beneficio.visible','=',1);
    }
    public function promociones()
    {
        return $this->belongsToMany('App\Modelos\CRM\Promocion',
            'categoria_promo','categoria', 'promo')
            ->where('categoria_promo.visible','=',1);
    }
}
