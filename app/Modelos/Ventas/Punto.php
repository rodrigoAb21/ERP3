<?php

namespace App\Modelos\Ventas;

use Illuminate\Database\Eloquent\Model;

class Punto extends Model
{
    protected $table = 'punto';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'ubicacion',
        'visible',
        'idEmpresa'
    ];
}
