<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    //
    protected $fillable = [
        'nro',
        'siaf',
        'periodo',
        'cheque',
        'monto',
        'estado',
        'observacion',
    ];
}
