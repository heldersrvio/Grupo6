<?php

namespace equipac\Http\Controllers;

use Illuminate\Http\Request;
use equipac\models\Equipamento;
use equipac\models\Manutencao;
use equipac\models\Usuario;
use equipac\models\Status_manutencao;
use Illuminate\Support\Facades\Schema;

use Auth;

class EquipamentoController extends Controller
{
    public function __construct()
    {
        //auth()->setDefaultDriver('usuario');


        $this->middleware('auth:usuario', ['only' => 'index', 'create', 'store', 'update', 'destroy']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Equipamento $eqp, Usuario $usuario)
    {
        //dd(Auth::guard()->user()->id);
        $equipamento = $usuario::find(auth()->user()->id)->equipamento;

        return view('usuarios.equipamento', compact('equipamento'));
    }

    public function indexLista(Equipamento $eqp, Usuario $usuario)
    {
        dd(Auth::guard()->user()->id);
        //$equipamento = $usuario::find(auth()->user()->id)->equipamento;

        return view('usuarios.lista-equipamento', compact('equipamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios/equipamento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Equipamento $eqp)
    {
        $ext = array('criacao' => date('Y-m-d H:i:s'),
                     'usuario_id' => auth()->guard('usuario')->user()->id
                    );
        $result = array_merge($request->all(), $ext);
        $insert = $eqp->create($result);
        if ($insert) {
            return redirect()->route('equipamento.index')->with('success', 'Equipamento inserida com sucesso!');
        }
        return redirect()->back()->with('error', 'Falha ao inserir');
    }

    public function delete(Request $request, Equipamento $eqp)
    {
        $eqpp = $eqp::find($request->get('id'));
        $check = $eqpp->delete();
        dd($check);
        if ($check) {
            return redirect()->route('lista-equipamento-index')->with('success', 'Equipamento excluido com sucesso!');
        }

        // Redireciona de volta com uma mensagem de erro
        return redirect() ->back() ->with('error', 'Falha ao excluir equipamento!');
    }

    public function manutencao(Request $request, Equipamento $eqp, Manutencao $manut, Status_manutencao $status)
    {
        $eqpp = $eqp::find($request->get('id'));
        $sts = $status::find(1);
        $manut->dataAtribuida = date('Y-m-d H:i:s');
        $manut->status()->associate($sts);
        $manut->equipamento()->associate($eqpp);
        $manut->equipamento_usuario_id = $eqp::find($request->get('id'))->usuario->id;
        if ($manut->save()) {
            return redirect()
            ->route('lista-equipamento-index')
            ->with('success', 'Manutenção Cadastrada com sucesso!');
        }
        return redirect()
        ->back()
        ->with('error', 'Falha ao Cadastrar');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
    public function destroy(int $id, Equipamento $eqp)
    {
        Schema::disableForeignKeyConstraints();
        $eqp::find($id)->delete();
        Schema::enableForeignKeyConstraints();
        return redirect()->route('lista-equipamento-index')->with('success', 'Equipamento excluido com sucesso!');
    }
}
