<?php

namespace App\Modelos\Compras;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'ci',
        'nombre',
        'direccion',
        'telefono',
        'empresa',
        'visible',
        'idEmpresa'
    ];
}
