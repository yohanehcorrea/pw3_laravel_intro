<?php

use App\Http\Controllers\ProdutoController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;

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