<?php

namespace equipac\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use equipac\models\Usuario;
use equipac\models\Bolsista;
use equipac\models\Chamados;

class EnviarEmailUsuarioProblema extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $bols;
    public $cham;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Usuario $usuario, $bolsistas, Chamados $chamados)
    {
        $this->user = $usuario;
        $this->bols = $bolsistas;
        $this->cham = $chamados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.emailProblema')
                    ->subject("Alteração de Status")
                    ->with([
                    'user' => $this->user,
                    'bols' => $this->bols,
                    'cham' => $this->cham
                    ]);
    }
}
