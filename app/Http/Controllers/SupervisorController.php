<?php

namespace equipac\Http\Controllers;

use equipac\models\Supervisor;
use equipac\models\Bolsista;
use equipac\models\Manutencao;
use Illuminate\Http\Request;
use Auth;
use Validator;
use PDF;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supervisor')->except(['registerSupervisor', 'registerIndex']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('supervisor');
    }

    public function registerIndex()
    {
        return view('supervisor.auth.register');
    }

    public function indexListarBolsista(Bolsista $bolsista)
    {
        $bol = $bolsista::all();
        return view('supervisor.listar-bolsista', compact('bol'));
    }

    public function indexEditarBolsista()
    {
        $bol = null;
        return view('supervisor.editar-bolsista', compact('bol'));
    }

    public function postLogin(Request $request)
    {
        $credenciais = ['email' => $request->get('email'),
        'password' => $request->get('password')];
        
        if (auth()->guard('supervisor')->attempt($credenciais)) {
            config(['auth.defaults.guard' => 'supervisor']);
            return redirect('home');
        } else {
            return redirect('login-supervisor')
            ->withErrors(['errors' => 'nao existe']);
        }
    }

    public function registerSupervisor(Request $request)
    {
        $validacao = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:3|max:150|unique:supervisor',
            'cpf' => 'required|max:15'
        ]);

        if ($validacao->fails()) {
            dd($validacao);
            return redirect('/')
            ->withErrors(['errors' => 'problemas']);
        }

        $user = new supervisor();
        $user->nome = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cpf = $request->cpf;
        $user->nivel = 1;
        $user->save();

        return redirect()->route('login-supervisor');
    }

    public function registerBolsista(Request $request)
    {
        $validacao = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:3|max:150|unique:bolsista',
            'cpf' => 'required|max:15'
        ]);

        if ($validacao->fails()) {
            dd($validacao);
            return redirect('/')
            ->withErrors(['errors' => 'problemas']);
        }

        $user = new Bolsista();
        $user->nome = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cpf = $request->cpf;
        $user->nivel = 2;
        $user->save();

        return redirect()->route('supervisor-register-bolsista')->with('success', 'Bolsista cadastrado com sucesso!');
    }

    public function indexRegisterBolsista()
    {
        return view('supervisor.register-bolsista');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supervisor.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \equipac\models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function show(Supervisor $supervisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \equipac\models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function edit(Supervisor $supervisor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \equipac\models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supervisor $supervisor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \equipac\models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supervisor $supervisor)
    {
        //
    }

    public function indexEditarBolsistaInfo(int $id, Bolsista $bolsista)
    {
        $bol = $bolsista::find($id);
        return view('supervisor.editar-bolsista', compact('bol'));
    }

    public function updateBolsista(int $id, Request $request, Bolsista $bolsista)
    {
        $bol = $bolsista::find($id);
        $bol['nome'] = $request->get('nome');
        $bol['email'] = $request->get('email');
        if ($bol->save()) {
            return  redirect()->route('listar-bolsista-index')->with('success', 'Informações do Bolsista atualizadas com sucesso!');
        } else {
            return  redirect()->route('listar-bolsista-index')->with('error', 'Informações do Bolsista não foram atualizadas!');
        }
    }

    public function relatorioManutencaoIndex(int $id, Bolsista $bolsista)
    {
        $bol = $bolsista::find($id);
        // dd($manut);
        return view('supervisor.relatorio-manutencao', compact('bol'));
    }

    public function gerarPdfManutencao(Request $request, Bolsista $bolsista)
    {
        $bol = $bolsista::find($request->get('id'));

        $manut = $bol->manutencao;

        return PDF::loadView('supervisor.tamplate-pdf', compact('manut'))->download('relatorio.pdf');
    }

    public function relatorioChamadoIndex(int $id, Bolsista $bolsista)
    {
        $bol = $bolsista::find($id);
        // dd($manut);
        return view('supervisor.relatorio-chamado', compact('bol'));
    }

    public function gerarPdfChamado(Request $request, Bolsista $bolsista)
    {
        $bol = $bolsista::find($request->get('id'));

        $cham = $bol->chamado;

        return PDF::loadView('supervisor.tamplate-chamado-pdf', compact('cham'))->download('relatorio Chamado.pdf');
    }
}
