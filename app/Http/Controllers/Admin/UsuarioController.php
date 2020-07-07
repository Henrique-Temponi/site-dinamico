<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    public function login(Request $request)
    {
        $dados = $request->all();
        // dd($dados);

        if(Auth::attempt([
            'email' => $dados['email'],
            'password' => $dados['password']
        ])) {

            Session::flash('mensagem', [
                'msg' => 'login realizado com sucesso',
                'class' => 'green white-text'
            ]);

            return redirect()->route('admin.principal');
        }

        Session::flash('mensagem', [
            'msg' => 'Erro confira seus dados',
            'class' => 'red white-text'
        ]);

        return redirect()->route('admin.login');
    }

    public function sair()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}