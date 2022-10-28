<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    //
    protected $fillable = [
        'tabla',
        'garantia_id', 
        'user_id', 
    ];   
    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }  
    public function garantia()
    {
        return $this->belongsTo('App\Garantia', 'garantia_id');
    }  
    public function garantia_forestal()
    {
        return $this->belongsTo('App\Garantia_forestal', 'garantia_id');
    }
    public function movimiento()
    {
        return $this->hasMany('App\Movimiento', 'tramite_id');
    }
}

