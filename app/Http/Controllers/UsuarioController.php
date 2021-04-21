<?php

namespace equipac\Http\Controllers;

use equipac\models\Usuario;
use Illuminate\Http\Request;
use Auth;
use Validator;

class UsuarioController extends Controller
{

    public function __construct()
    {
        //auth()->setDefaultDriver('usuario');
        $this->middleware('auth:usuario', ['only' => 'index']);
    }

    public function index()
    {
        return view('usuario');
    }

    public function registerIndex()
    {
        return view('usuarios.auth.register');
    }

    public function login()
    {
        return view('usuarios.auth.login');
    }

    public function postLogin(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
      // Attempt to log the user in
        if (Auth::guard('usuario')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
            return redirect()->intended(route('usuario'));
        }
      // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function registerUsuario(Request $request)
    {
        $validacao = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:3|max:150|unique:Usuario',
            'cpf' => 'required|max:15'
        ]);

        if ($validacao->fails()) {
            dd($validacao);
            return redirect('/')
            ->withErrors(['errors' => 'Problema']);
        }

        $user = new Usuario();
        $user->nome = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cpf = $request->cpf;
        $user->nivel = 3;
        $user->save();
        
        return redirect()->route('login-usuario');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \equipac\models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \equipac\models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \equipac\models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \equipac\models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
