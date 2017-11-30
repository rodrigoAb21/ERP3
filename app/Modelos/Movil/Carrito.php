<?php
namespace App\Modelos\Movil;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito';



    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'producto_id',
        'cantidad',
        'pagado'

    ];

}