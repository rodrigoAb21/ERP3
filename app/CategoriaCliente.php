<?php

namespace App;

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
    ];

    public function beneficios()
    {
        return $this->belongsToMany('App\Beneficio',
            'categoria_beneficio','categoria', 'beneficio')
            ->where('categoria_beneficio.visible','=',1);
    }
}
