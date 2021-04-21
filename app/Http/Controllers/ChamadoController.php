<?php

namespace equipac\Http\Controllers;

use Illuminate\Http\Request;
use equipac\models\problema;
use equipac\models\Chamados;
use equipac\models\Bolsista;
use equipac\models\Usuario;
use equipac\models\Status_chamado;
use Illuminate\Support\Facades\Mail;
use equipac\Mail\EnviarEmailUsuarioProblema;
use equipac\Mail\EnviarEmailUsuarioProblemaConcluido;

class ChamadoController extends Controller
{
    public function __construct()
    {
        //auth()->setDefaultDriver('usuario');


        $this->middleware('auth:bolsista');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Chamados $prob)
    {
        $chamado = $prob::all();
        return view('bolsista.chamados', compact('chamado'));
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
    public function store(Request $request, Chamados $cham)
    {
        //dd($dados->all());
        $ext = array('criacao' => date('Y-m-d H:i:s'),
                    'usuario_id' => auth()->user()->id);
        $result = array_merge($request->all(), $ext);
        $insert = $cham->create($result);

        if ($insert) {
            return redirect()
                    ->route('index')
                    ->with('success', 'Chamado criado com sucesso!');
        }

    // Redireciona de volta com uma mensagem de erro
        return redirect()
                ->back()
                ->with('error', 'Falha ao Criar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function alterarStatus(Request $request, Status_chamado $status, Chamados $cham, Bolsista $bolsista)
    {
        $bol     = $bolsista::find($request->idb);
        $chamado = $cham::find($request->id);
        $sts     = $status::find($request->status);

        $chamado->status()->associate($sts);

        if ($bol->chamado->contains($chamado) == false) {
            $chamado->bolsista()->attach($bol);
        }

        if ($chamado->save()) {
             Mail::to($chamado->problema->usuario->email)
            ->send(new EnviarEmailUsuarioProblema($chamado->problema->usuario, $chamado->bolsista, $chamado));
            return redirect()
            ->route('index-chamado')
            ->with('success', 'Chamado alterado com sucesso!');
        }
        return redirect()
        ->back()
        ->with('error', 'Falha ao Cadastrar');
    }

    public function solucaoChamadoIndex(int $id, Chamados $chamado)
    {
        $cham = $chamado::find($id);
        return view('bolsista.solucao-chamado', compact('cham'));
    }

    public function solucaoChamado(int $id, Request $request, Chamados $chamado, Status_chamado $status, Usuario $usuario, Bolsista $bolsista)
    {
        $bol   = $bolsista::find($request->idb);

        $cham = $chamado::find($id);
        $cham['solucao'] = $request->get('solucao');
        $sts = $status::find(4);
        $cham->status()->associate($sts);

        if (!$bol->chamado->contains($cham)) {
            $cham->bolsista()->attach($bol);
        }

        if ($cham->save()) {
            Mail::to($cham->problema->usuario->email)
            ->send(new EnviarEmailUsuarioProblemaConcluido($cham->problema->usuario, $cham->bolsista, $cham));
            return  redirect()->route('index-chamado')->with('success', 'Solucão cadastrada com sucesso!');
        } else {
            return  redirect()->route('index-chamado')->with('error', 'Solucão não foi cadastrada!');
        }
    }
}
