<?php

namespace equipac\Http\Controllers;

use equipac\models\Admin;
use equipac\models\Usuario;
use equipac\models\Supervisor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Schema;
use Auth;
use Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except(['registerAdmin', 'registerIndex']);
    }

    public function index()
    {
        return view('admin');
    }

    public function registerIndex()
    {
        return view('admin.auth.register');
    }

    public function registerAdminIndex()
    {
        return view('admin.register-admin');
    }

    public function postLogin(Request $request)
    {
        $credenciais = ['email' => $request->get('email'),
        'password' => $request->get('password')];
        
        if (auth()->guard('admin')->attempt($credenciais)) {
            config(['auth.defaults.guard' => 'admin']);
            return redirect('home');
        } else {
            return redirect('login-admin')
            ->withErrors(['errors' => 'nao existe']);
        }
    }

    public function registerAdmin(Request $request)
    {
        $validacao = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:3|max:150|unique:admin'
        ]);

        if ($validacao->fails()) {
            dd($validacao);
            return redirect('/')
            ->withErrors(['errors' => 'problemas']);
        }

        $user = new admin();
        $user->nome = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->nivel = 0;
        $user->save();

        return redirect()->route('login-admin');
    }

    public function adminRegisterAdmin(Request $request)
    {
        $validacao = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:3|max:150|unique:admin'
        ]);

        if ($validacao->fails()) {
            dd($validacao);
            return redirect('/')
            ->withErrors(['errors' => 'problemas']);
        }

        $user = new admin();
        $user->nome = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->nivel = 0;
        $user->save();

        return redirect()->route('listar-admin')->with('success', 'Admin cadastrado com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param  \equipac\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \equipac\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \equipac\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \equipac\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function listarAdminIndex(Admin $admin)
    {
        $adm = $admin::all();
        return view('admin.listar-admin', compact('adm'));
    }

    public function listarUsuarioIndex(Usuario $usuario)
    {
        $adm = $usuario::all();
        return view('admin.listar-usuario', compact('adm'));
    }

    public function listarSupervisorIndex(Supervisor $usuario)
    {
        $adm = $usuario::all();
        return view('admin.listar-supervisor', compact('adm'));
    }

    public function excluirAdmin(Request $request, Admin $admin)
    {
        Schema::disableForeignKeyConstraints();
        $admin::find($request->get('id'))->delete();
        Schema::enableForeignKeyConstraints();
        return redirect()->route('listar-admin')->with('success', 'Admin excluido com sucesso!');
    }

    public function excluirUsuario(Request $request, Usuario $usuario)
    {
        Schema::disableForeignKeyConstraints();
        $usuario::find($request->get('id'))->delete();
        Schema::enableForeignKeyConstraints();
        return redirect()->route('listar-usuario')->with('success', 'Usuário excluido com sucesso!');
    }

    public function excluirSupervisor(Request $request, Supervisor $usuario)
    {
        Schema::disableForeignKeyConstraints();
        $usuario::find($request->get('id'))->delete();
        Schema::enableForeignKeyConstraints();
        return redirect()->route('listar-supervisor')->with('success', 'Supervisor excluido com sucesso!');
    }

    public function indexEditarSupervisorInfo(int $id, Supervisor $supervisor)
    {
        $bol = $supervisor::find($id);
        return view('admin.editar-supervisor', compact('bol'));
    }


    public function updateSupervisor(int $id, Request $request, Supervisor $supervisor)
    {
        $bol = $supervisor::find($id);
        $bol['nome'] = $request->get('nome');
        $bol['email'] = $request->get('email');
        if ($bol->save()) {
            return  redirect()->route('listar-supervisor')->with('success', 'Informações do Supervisor atualizadas com sucesso!');
        } else {
            return  redirect()->route('listar-supervisor')->with('error', 'Informações do Supervisor não foram atualizadas!');
        }
    }

    public function indexEditarUsuarioInfo(int $id, Usuario $usuario)
    {
        $bol = $usuario::find($id);
        return view('admin.editar-usuario', compact('bol'));
    }

    public function updateUsuario(int $id, Request $request, Usuario $usuario)
    {
        $bol = $usuario::find($id);
        $bol['nome'] = $request->get('nome');
        $bol['email'] = $request->get('email');
        if ($bol->save()) {
            return  redirect()->route('listar-usuario')->with('success', 'Informações do Supervisor atualizadas com sucesso!');
        } else {
            return  redirect()->route('listar-usuario')->with('error', 'Informações do Supervisor não foram atualizadas!');
        }
    }
}
