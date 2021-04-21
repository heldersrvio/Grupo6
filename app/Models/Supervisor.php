<?php

namespace equipac\models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Supervisor extends Authenticatable
{
    protected $table = 'supervisor';
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

    protected $guard = 'supervisor';
}
