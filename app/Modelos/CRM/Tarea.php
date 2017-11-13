<?php

namespace App\Modelos\CRM;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tarea';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'estado_id',
        'visible',
        'color',
    ];
    public function estado()
    {
        return $this->belongsTo('App\Modelos\CRM\Estado','estado_id');
    }

    public function scopegetTareas($query){
        $tareas = $query -> where('visible', '=', '1') -> get();
        return $tareas;
    }
}
