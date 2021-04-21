<?php

namespace equipac\Http\Controllers;

use Illuminate\Http\Request;
use equipac\models\Equipamento;
use equipac\models\Manutencao;
use equipac\models\Usuario;

use Auth;

class ListarEquipamentoController extends Controller
{
    public function __construct()
    {
        //auth()->setDefaultDriver('usuario');


        $this->middleware('auth:usuario', ['only' => 'index']);
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

        return view('usuarios.lista-equipamento', compact('equipamento'));
    }

    public function deletaEquipamento(Request $request, Equipamento $eqp)
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
}
