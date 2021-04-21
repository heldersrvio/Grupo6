<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    protected $table = 'Manutencao';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['dataAtribuida','solucao'];


    public function equipamento()
    {
        return $this->belongsTo('equipac\models\Equipamento');
    }

    public function bolsista()
    {
        return $this->belongsToMany('equipac\models\bolsista', 'bolsista_has_manutencao', 'manutencao_id', 'bolsista_id');
    }

    public function status()
    {
        return $this->belongsTo('equipac\models\Status_manutencao', 'status_id');
    }
}
