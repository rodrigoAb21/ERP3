<?php

namespace App\Modelos\Ventas;

use Illuminate\Database\Eloquent\Model;

class Garante extends Model
{
    protected $table = 'garante';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'ci',
        'nombre',
        'direccion',
        'telefono',
        'documento',
        'idEmpresa',
        'visible',
        'idCredito',
    ];

    public function scopegetGarante($query, $id){
        $garante = $query -> join('pago', 'pago.id', '=', 'garante.idCredito')
            -> select('garante.ci','garante.nombre', 'garante.direccion', 'garante.telefono', 'garante.documento')
            -> where('garante.idCredito','=', $id)->get();
        return $garante;
    }
}
