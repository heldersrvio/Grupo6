<?php

namespace equipac\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use equipac\models\Usuario;
use equipac\models\Bolsista;
use equipac\models\Manutencao;

class EnviarEmailUsuarioEquipamentoConcluido extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $bols;
    public $manu;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Usuario $usuario, $bolsistas, Manutencao $manutencao)
    {
        $this->user = $usuario;
        $this->bols = $bolsistas;
        $this->manu = $manutencao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.emailEquipamentoConcluido')
                    ->subject("Finalização de Equipamento")
                    ->with([
                    'user' => $this->user,
                    'bols' => $this->bols,
                    'manu' => $this->manu
                    ]);
    }
}
