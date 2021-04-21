<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;
use equipac\models\Problema;
use equipac\models\Bolsista;
use equipac\models\Status_chamado;

class Chamados extends Model
{
    protected $table = 'chamado';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['dataAtribuida'];


    public function status()
    {
        return $this->belongsTo('equipac\models\Status_chamado', 'status_chamado_id');
    }

    public function bolsista()
    {
        return $this->belongsToMany('equipac\models\Bolsista', 'bolsista_has_chamado', 'chamado_id', 'bolsista_id');
    }

    public function problema()
    {
        return $this->belongsTo('equipac\models\Problema', 'problema_id');
    }
}
