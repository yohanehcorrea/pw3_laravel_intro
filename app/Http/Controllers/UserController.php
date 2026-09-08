<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $busca = $request->input('busca');

        if ($busca){
            $usuarios = User::where('name', 'like', "%{$busca}%", 'and')
              ->oderBy('name' , 'ASC')
              ->get();
             //select * from user where name = 'ana'
             //select * from user where name like '%ana%'
        } else {
            $usuarios = User::orderBy('name', 'ASC')->get();
        }
       //Retorna a view do painel passando a coleçao de usuarios e o termo de pesquisa
        return view('admin.dashboard' , compact('usuarios', 'busca'));
    }
    
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
