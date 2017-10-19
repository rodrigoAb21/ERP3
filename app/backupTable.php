<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class backupTable extends Model
{
    protected $table = 'backup';
    
        protected $primaryKey = 'id';
    
        public $timestamps = false;
    
        protected $fillable = [
            'nombre'
        ];
}
