<?php

namespace equipac\models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use equipac\models\Equipamento;
use equipac\models\Problema;

class Usuario extends Authenticatable
{

    protected $table = 'usuario';
    protected $primarykey = 'id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'email', 'password','cpf'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guard = 'usuario';


    public function equipamento()
    {
        return $this->hasMany('equipac\models\Equipamento', 'usuario_id', 'id');
    }

    public function problema()
    {
        return $this->hasMany('equipac\models\Problema', 'usuario_id', 'id');
    }
}
