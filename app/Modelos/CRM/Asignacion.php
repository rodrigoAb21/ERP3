<?php

namespace App\Modelos\CRM;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'asignacion';

    protected $primaryKey = 'tarea';

    public $timestamps = false;

    protected $fillable = [
        'tarea',
        'seguimiento',
        'fecha',
        'nota',
        'hora_inicio',
        'hora_final'
    ];



}
