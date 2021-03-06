<?php

namespace App\Modelos\Ventas;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    protected $table = 'cuota';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'monto',
        'idEmpleado',
        'idEmpresa',
        'visible',
        'estado',
        'idCredito',
    ];

    public function scopegetCuotas($query, $id){
        $cuotas = $query -> where('idCredito',$id)->paginate(25);
        return $cuotas;
    }

}
