<?php

namespace App\Seguridad;

use Illuminate\Database\Eloquent\Model;

class Casouso extends Model
{
    protected $table = 'casousos';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'depto_id'
    ];
    public function depto()
    {
        return $this->belongsTo('App\Seguridad\Departamento', 'depto_id');
    }
}
