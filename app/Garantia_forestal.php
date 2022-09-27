<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garantia_forestal extends Model
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
    
    protected $table='garantia_forestales';  

    
    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function devoluciones()
    {
        return $this->hasMany('App\Devolucion_forestal', 'garantia_id');
    }
}
