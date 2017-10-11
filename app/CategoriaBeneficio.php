<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaBeneficio extends Model
{
    protected $table = 'categoria_beneficio';

    protected $primaryKey = 'categoria';

    public $timestamps = false;

    protected $fillable = [
        'categoria',
        'beneficio'
    ];
}
