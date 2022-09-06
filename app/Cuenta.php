<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    //
    protected $fillable = [
        'nro',
        'd_s',
        'provvedor',
        'vaucher',
        'registro',
        'monto',
        'mes',
        'estado',
        'recibo',
    ];
}
