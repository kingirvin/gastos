<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $fillable = [
        'nombre',
        'ruc',
        'estado',
        'user_id',
    ]; 
    protected $table='proveedores';  
    
    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function comprobantes()
    {
        return $this->hasMany('App\Comprobante', 'proveedor_id');
    }
}
