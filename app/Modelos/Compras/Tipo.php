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
}