<?php

namespace App\Modelos\CRM;

use Illuminate\Database\Eloquent\Model;

class DetallePromo extends Model
{
    protected $table = 'detalle_promo';

    protected $primaryKey = 'promo';

    public $timestamps = false;

    protected $fillable = [
        'precio',
        'producto',
        'promo'
    ];
}
