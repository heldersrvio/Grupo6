<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;

class Status_manutencao extends Model
{
    protected $table = 'status_manutencao';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    public function manutencao()
    {
        return $this->hasMany('equipac\models\manutencao', 'status_id');
    }
}
