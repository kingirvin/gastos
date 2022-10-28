<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    //
    protected $fillable = [
        'exp_siaf',
        'oc_os',
        'proveedor',
        'voucher',
        'siaf',
        'registro',
        'fecha',
        'monto',
        'mes',
        'recibo',
        'estado',
        'user_id',
        'eliminado',
        'estado_d',
    ]; 
    
    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function devoluciones()
    {
        return $this->hasMany('App\Devolucion', 'garantia_id');
    }
    public function tramite()
    {
        return $this->hasOne('App\Tramite', 'garantia_id');
    }
}
