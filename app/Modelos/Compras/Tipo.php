<?php
namespace App\Modelos\Compras;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipo';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'visible',
        'idEmpresa',
        'idCategoriaProd'
    ];

    public function scopegetTipos($query){
        $tipos = $query -> where('visible', '=', '1') -> get();
        return $tipos;
    }
}