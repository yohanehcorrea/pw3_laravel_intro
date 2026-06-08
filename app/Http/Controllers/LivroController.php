<?php

namespace App\Http\Controllers;
use App\Models\Livro;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(){
        $Livros = Livro::orderBy('id')->get();

        return View('livros.index',compact('livros'));
    }

public function store(Request $request){
    $dados = $request->validate([
        'titulo'=>'required|min:3',
        'autor'=>'required|numeric|min:0',
        'ano_publicacao'=>'required|integer|min:0'
    ]);
    Livro::create($dados);
    return redirect()->route('livros.index');
}
}