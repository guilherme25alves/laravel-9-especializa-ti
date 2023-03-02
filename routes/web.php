<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController
};
use App\Http\Controllers\Admin\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/users/{id}/comments', [CommentController::class, 'index'])->name('comments.index');

Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
/** 
 * WARNING: Importante colocar as rotas com parâmetros embaixo para que o Laravel não entenda 
 *  que uma outra rota seja parâmetro, exemplo da users/{id} e users/create, o Laravel poderia 
 *  entender que "create" era o valor do parâmetro, colocando a rota /create acima, evitamos esse problema
*/
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
