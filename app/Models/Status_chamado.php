<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;

class Status_chamado extends Model
{
    protected $table = 'status_chamado';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    public function chamado()
    {
        return $this->hasMany('equipac\models\Chamados');
    }
}
