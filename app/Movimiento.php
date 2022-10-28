<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    //
    protected $fillable = [        
        'origen',
        'destino',
        'estado', //0:pendiente, 1:recepcionado , 2 Derivado
        'user_id', 
        'tramite_id',
    ];   
    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }  
    public function garantia()
    {
        return $this->belongsTo('App\Tramite', 'tramite_id');
    }  
    public function garantia_forestal()
    {
        return $this->belongsTo('App\Garantia_forestal', 'garantia_id');
    } 
    public function tramite()
    {
        return $this->belongsTo('App\Tramite', 'tramite_id');
    } 
}
