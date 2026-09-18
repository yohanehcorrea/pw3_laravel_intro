<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $eventos = Evento::query()
            ->when($busca, function ($query, $busca) {
                $query->where(function ($q) use ($busca) {
                    $q->where('titulo', 'like', "%{$busca}%")
                      ->orWhere('local', 'like', "%{$busca}%");
                });
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('eventos.index', compact('eventos', 'busca'));
    }

    public function create()
    {
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'titulo' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'vagas' => 'required|integer|min:1',
            'preco_inscricao' => 'required|numeric|min:0',
        ]);

        Evento::create($dadosValidados);

        return redirect('/eventos')
            ->with('success', 'Evento cadastrado com sucesso!');
    }
}