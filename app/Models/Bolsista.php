<?php

namespace equipac\models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Bolsista extends Authenticatable
{
    protected $table = 'bolsista';
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

    protected $guard = 'bolsista';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *bolsista tem muitas manutenções: bolongsToMany()
     *
     */
    public function manutencao()
    {
        return $this->belongsToMany('equipac\models\Manutencao', 'bolsista_has_manutencao', 'bolsista_id', 'manutencao_id');
    }

    public function chamado()
    {
        return $this->belongsToMany('equipac\models\Chamados', 'bolsista_has_chamado', 'bolsista_id', 'chamado_id');
    }
}
