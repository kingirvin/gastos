<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
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
        'garantia_id'
    ];   
    protected $table='devoluciones';  

    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function conciliacion()
    {
        return $this->belongsTo('App\Garantia', 'garantia_id');
    }
}
