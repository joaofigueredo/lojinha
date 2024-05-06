<?php

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\CupomDesconto;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Autenticador;
use App\Http\Middleware\Client;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/home.index');
}); 

Route::middleware(Client::class)->group(function () {
    Route::get('/categorias', [CategoriasController::class, 'index'])
        ->name('categorias.index');
    Route::get('/categorias/{categoria}/show',[CategoriasController::class, 'show'])
        ->name('categorias.show');
    Route::get('/carrinho', [CarrinhoController::class, 'index'])
        ->name('carrinho.index');
    Route::get('/produtos/{produto}/show',[ProdutosController::class, 'show'])
    ->name('produtos.show');
    Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionar'])
        ->name('carrinho.adicionar');
    Route::delete('/carrinho/remover', [CarrinhoController::class, 'remover'])
        ->name('carrinho.remover');
    Route::post('/carrinho/concluir', [CarrinhoController::class, 'concluir'])
        ->name('carrinho.concluir');
    Route::get('/compras', [CarrinhoController::class, 'compras'])
        ->name('carrinho.compras');
    Route::post('/carrinho/cancelar', [CarrinhoController::class, 'cancelar'])
        ->name('carrinho.cancelar');
    Route::get('/cupom', [CupomDesconto::class, 'index'])
        ->name('cupom.index');
    Route::post('/carrinho/desconto', [CarrinhoController::class, 'desconto'])
        ->name('carrinho.desconto');
});


Route::middleware(Admin::class)->group(function () {
    route::get('/produtos/create',[ProdutosController::class, 'create'])
    ->name('produtos.create');
    route::post('/produtos/store',[ProdutosController::class, 'store'])
    ->name('produtos.store');
    route::get('/produtos/{produto}/edit',[ProdutosController::class, 'edit'])
    ->name('produtos.edit');
    Route::put('/produtos/{produto}', [ProdutosController::class, 'update'])
    ->name('produtos.update');
    route::delete('/produtos/{produto}/destroy',[ProdutosController::class, 'destroy'])
        ->name('produtos.destroy');

    Route::get('/categorias/create',[CategoriasController::class, 'create'])
        ->name('categorias.create');
    
    Route::post('/categorias/store',[CategoriasController::class, 'store'])
        ->name('categorias.store');
    Route::get('/categorias/{categoria}/edit',[CategoriasController::class, 'edit'])
        ->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriasController::class, 'update'])
        ->name('categorias.update');
    Route::delete('/categorias/{categoria}/destroy',[CategoriasController::class, 'destroy'])
        ->name('categorias.destroy');
    
    Route::get('/cupom/create', [CupomDesconto::class, 'create'])
        ->name('cupom.create')->middleware(Admin::class);
    Route::post('/cupom/store', [CupomDesconto::class, 'store'])
        ->name('cupom.store');
    Route::get('/cupom/{cupom}/edit', [CupomDesconto::class, 'edit'])
        ->name('cupom.edit');
    Route::put('/cupom/{cupom}', [CupomDesconto::class, 'update'])
        ->name('cupom.update');
    Route::delete('/cupom/{cupom}/destroy', [CupomDesconto::class, 'destroy'])
        ->name('cupom.destroy');
});

//ROTAS LOGIN/LOGOUT
Route::get('/login', [LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->name('login.store');
Route::get('/logout', [LoginController::class, 'destroy'])
    ->name('logout');

// ROTAS DE REGISTRO USUÁRIO
Route::get('/register', [UsersController::class, 'create'])
    ->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');

//Rota que convidados podem acessar
Route::get('/produtos', [ProdutosController::class, 'index'])
    ->name('produtos.index');

Route::get('/home', [HomeController::class, 'index'])
    ->name('home.index');

Route::post('/produtos/buscar', [ProdutosController::class, 'buscar'])
    ->name('produtos.buscar');