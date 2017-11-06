<?php

namespace App\Modelos\Ventas;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'ci',
        'nit',
        'nombre',
        'puntosAcumulados',
        'direccion',
        'telefono',
        'email',
        'tipo',
        'idCategoria',
        'visible',
        'idEmpresa'
    ];
}
