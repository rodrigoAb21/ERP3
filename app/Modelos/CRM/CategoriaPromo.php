<?php

namespace App\Modelos\CRM;

use Illuminate\Database\Eloquent\Model;

class CategoriaPromo extends Model
{
    protected $table = 'categoria_promo';

    protected $primaryKey = 'categoria';

    public $timestamps = false;

    protected $fillable = [
        'categoria',
        'promo'
    ];
}
