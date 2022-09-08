<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giro extends Model
{
    //
    protected $fillable = [
        'nro',
        'reg_siaf',
        'periodo',
        'cheque',
        'monto',
        'estado',
        'observacion',
        'user_id',
        'conciliacion_id'
    ];    
    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function conciliacion()
    {
        return $this->belongsTo('App\Conciliacion', 'conciliacion_id');
    }
}
