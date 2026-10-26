<?php

use App\Http\Controllers\ProdutoController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\BD;

Route::get('/', function () {
    return view('home');
});

Route::view('/landing' , 'landing');
Route::view('/admin' , 'admin.dashboard');

Route::get('/produtos', [ProdutoController::class , 'index']);
Route::post('/produtos', [ProdutoController::class , 'store']);

Route::post('/livros', [LivroController::class , 'index'])
  -> name('livros.index');

Route::post('/livros', [LivroController::class , 'store'])
  -> name('livros.store');

Route::get('/teste-orm' , function() {
  User::create([
   'name' => 'Ana Cara Santos',
   'email' => 'ana.santos@escola.sp.gov.br',
   'password' => '12345678',
  ]);

  return User::all();

});

Routte::get('/lab-seguranca', function (Request $request) {
    $termo = $request->query('busca', '');

    $resultadoVulneravel = [];
    $erroVulneravel = null;
    
    if ($termo !== '') {
        try{
            $resultadoVulneravel = DB::select("SELECT id, name, email FROM
            users WHERE name = '$termo'");
        } catch (\Exception $e) {
            $erroVulneravel = $e->getMessage();
        }
    }
});