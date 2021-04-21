<?php

namespace equipac\Http\Controllers;

use equipac\models\Manutencao;
use equipac\models\Equipamento;
use equipac\models\Usuario;
use equipac\models\Bolsista;
use equipac\models\Status_manutencao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use equipac\Mail\EnviarEmailUsuarioEquipamento;
use equipac\Mail\EnviarEmailUsuarioEquipamentoConcluido;

class ManutencaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:bolsista');
    }

    public function index(Manutencao $ma, Equipamento $equip)
    {
        $manutencao = $ma::all();
        return view('bolsista.manutencao', compact('manutencao'));
    }

    public function store(Request $request, Equipamento $eqp, Manutencao $manut)
    {
        $eqpp = $eqp::find($request->get('id'));
        $ext = array('dataAtribuida' => date('Y-m-d H:i:s'));
        $ext2 = array('status_id' => '1');
        $result = array_merge($ext2, $ext);
        $insert = $manut->create($result);
        if ($insert) {
            $eqpp->manutencao()->attach($insert, ['equipamento_usuario_id' => $eqp::find($request->get('id'))->usuario->id]);
            return redirect()
            ->route('equipamento.index')
            ->with('success', 'Equipamento inserida com sucesso!');
        }
        return redirect()
        ->back()
        ->with('error', 'Falha ao inserir');
    }

    public function alterarStatus(Request $request, Status_manutencao $status, Manutencao $ma, Usuario $usuario, Bolsista $bolsista)
    {
        $bol   = $bolsista::find($request->idb);
        $manut = $ma::find($request->id);
        $sts   = $status::find($request->status);

        $manut->status()->associate($sts);

        if (!$bol->manutencao->contains($manut)) {
            $manut->bolsista()->attach($bol);
        }
        
        if ($manut->save()) {
            Mail::to($manut->equipamento->usuario->email)
            ->send(new EnviarEmailUsuarioEquipamento($manut->equipamento->usuario, $manut->bolsista, $manut));
            return redirect()
            ->route('index-manutencao')
            ->with('success', 'Manutenção Cadastrada com sucesso!');
        }
        return redirect()
        ->back()
        ->with('error', 'Falha ao Cadastrar');
    }

    public function solucaoManutencaoIndex(int $id, Manutencao $manutencao)
    {
        $manut = $manutencao::find($id);
        return view('bolsista.solucao-manutencao', compact('manut'));
    }

    public function solucaoManutencao(int $id, Request $request, Manutencao $manutencao, Status_manutencao $status, Usuario $usuario, Bolsista $bolsista)
    {
        $bol   = $bolsista::find($request->idb);

        $manut = $manutencao::find($id);
        $manut['solucao'] = $request->get('solucao');
        $sts = $status::find(4);
        $manut->status()->associate($sts);

        if (!$bol->manutencao->contains($manut)) {
            $manut->bolsista()->attach($bol);
        }
        
        if ($manut->save()) {
            Mail::to($manut->equipamento->usuario->email)
            ->send(new EnviarEmailUsuarioEquipamentoConcluido($manut->equipamento->usuario, $manut->bolsista, $manut));
            return  redirect()->route('index-manutencao')->with('success', 'Atividade atualizadas com sucesso!');
        } else {
            return  redirect()->route('index-manutencao')->with('error', 'Atividades não foram atualizadas!');
        }
    }
}
