<?php

namespace equipac\Http\Controllers;

use equipac\models\Problema;
use equipac\models\Chamados;
use equipac\models\Usuario;
use equipac\models\Status_chamado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use equipac\Mail\EnviarEmailUsuarioProblema;
use equipac\Mail\EnviarEmailUsuarioProblemaConcluido;

class ProblemaController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('usuario');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Problema $prob)
    {
        $problema = $prob::all();
        return view('usuarios.problema', compact('problema'));
    }

    public function indexLista(Problema $prob)
    {
        $problema = $prob::all();
        return view('usuarios.lista-problemas', compact('problema'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Chamados $cham, Problema $prob, Status_chamado $status, Usuario $usuario)
    {
        $prob->criacao = date('Y-m-d H:i:s');
        $prob->descricao = $request->get('descricao');
        $prob->usuario()->associate($usuario::find(auth()->user()->id));

        if ($prob->save()) {
            $sts = $status::find(1);
            $cham->dataAtribuida = date('Y-m-d H:i:s');
            $cham->status()->associate($sts);
            $cham->problema_usuario_id = $prob->usuario->id;
            $cham->problema_id = $prob->id;
            if ($cham->save()) {
                $prob->chamado = $cham;
                return redirect()
                ->route('lista-problemas')
                ->with('success', 'Chamado e problema Cadastrados com sucesso!');
            } else {
                return redirect()
                ->back()
                ->with('error', 'Falha ao Cadastrar');
            }
        } else {
            return redirect()
            ->back()
            ->with('error', 'Falha ao Criar');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \equipac\models\problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function show(problema $problema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \equipac\models\problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function edit(problema $problema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \equipac\models\problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, problema $problema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \equipac\models\problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function excluirProblema(Request $request, problema $problema)
    {

        $problema::find($request->get('id'))->chamado->delete();
        $problema::find($request->get('id'))->delete();

        return redirect()->route('lista-chamados')->with('success', 'chamado excluido com sucesso!');
    }
}
