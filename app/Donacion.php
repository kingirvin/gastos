<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    //
    protected $fillable = [
        'siaf',
        'documento_tipo',
        'nro_doc',
        'importe',
        'estado',
        'user_id',
        'eliminar',
        'proveedor_id', 

    ];  
    protected $table='donaciones';  
    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor', 'proveedor_id');
    }
}
