<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosicaoController;
use App\Http\Controllers\ClubeController;
use App\Http\Controllers\JogadorController;

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
    return redirect('/posicao');
});

Route::get('/', function () {
    return redirect('/clube');
});

Route::get('/', function () {
    return redirect('/jogador');
});

Route::resources([
		"posicao" => PosicaoController::Class,
		"clube" => ClubeController::Class,
		"jogador" => JogadorController::Class
]);

Route::Get("/posicao/{id}/delete",[
	"as" => "posicao.destroy",
	"uses" => "PosicaoController@destroy"
	
]);

Route::Get("/clube/{id}/delete",[
	"as" => "clube.destroy",
	"uses" => "ClubeController@destroy"
	
]);

Route::Get("/jogador/{id}/delete",[
	"as" => "jogador.destroy",
	"uses" => "JogadorController@destroy"
]);

Route::Get("/jogador/{id}/adquirir",
	"JogadorController@adquirir");