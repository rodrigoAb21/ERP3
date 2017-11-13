<?php

namespace App\Modelos\Compras;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    protected $table = 'categoria_producto';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'visible',
        'idEmpresa'
    ];

    public function scopegetCategorias($query){
        $categorias = $query -> where('visible', '=', '1') -> get();
        return $categorias;
    }
}
