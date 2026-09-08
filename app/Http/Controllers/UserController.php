<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Exibe o formulario de cadastro de usuarios
     */
    public function create()
    {
        return view('users.create');
    
    }
    /**
     * Salvar o novo usuariono banco de dados com validaçao
     */
    public function store(Request $request)
    {
        //Validação dos campos de formulario

        $dadosValidados = $request->validate([
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|unique:users, email',
        'password' => 'required|min:6'
        ]);

        //Persistencia no banco de dados usando o ORM Eloquent
         User::create($dadosValidados);

        //Redirecionar para o o painel administrativo com mensagem de sucesso
        return redirect('/admin')->with('sucesso','Usuario cadastrado com sucesso');
    }
}
