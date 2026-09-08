<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LivroController;

Route::get('/', function () {
    return view('home');
});

Route::view('/landing' , 'landing');
Route::view('/admin' , 'admin.dashboard');

Route::get('/usuarios/novo', [UserController::class, 'create']);

Route::post('/usuarios', [UserController::class, 'store']);

Route::get('/produtos', [ProdutoController::class , 'index']);
Route::post('/produtos', [ProdutoController::class , 'store']);


Route::get('/teste-orm' , function(){
  User::create([
    'name' => 'Yohane Heleonora Correa',
    'email' => 'Yohane.Correa@escola.sp.gov.br',
    'password' => '12345',
  ]);

  return User::all();
});

Route::post('/livros', [LivroController::class , 'index'])
  -> name('livros.index');

Route::post('/livros', [LivroController::class , 'store'])
  -> name('livros.store');