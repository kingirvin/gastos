<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conciliacion extends Model
{
    //
    protected $fillable = [
        'exp_siaf',
        'oc_os',
        'proveedor',
        'voucher',
        'siaf',
        'registro',
        'monto',
        'mes',
        'recibo',
        'estado',
        'user_id',
    ]; 
    
    protected $table='conciliaciones';  
    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function giros()
    {
        return $this->hasMany('App\Giro', 'conciliacion_id');
    }
}
