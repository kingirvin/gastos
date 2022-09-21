<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','apaterno','amaterno','telefono','oficina','tipo_id','estado','user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function gastos()
    {
        return $this->hasMany('App\Giro', 'user_id');
    } 
    public function cuentas()
    {
        return $this->hasMany('App\Conciliacion', 'user_id');
    } 
    public function ro_comprobantes()
    {
        return $this->hasMany('App\Ro_comprobante', 'user_id');
    } 
    public function rdr_comprobantes()
    {
        return $this->hasMany('App\Rdr_comprobante', 'user_id');
    } 
    public function gar_comprobantes()
    {
        return $this->hasMany('App\Gar_comprobante', 'user_id');
    } 
}
