<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rdr_comprobante extends Model
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
    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor', 'proveedor_id');
    }
}
