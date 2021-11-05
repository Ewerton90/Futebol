<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogador;
use App\Models\Clube;
use App\Models\Posicao;
use Illuminate\Support\Facades\DB;

class JogadorController extends Controller
{
	public function listaJogadores(){
		$jogadores = DB::table('jogador AS j')
							->join('posicao AS p',
							'j.posicao', '=', 'p.id')
							->join('clube AS c', 'j.clube',
							'=', 'c.id')
							->select('j.id', 'j.nome',
							'j.possui','p.descricao AS posicao',
							'c.escudo')
							->get();
		return $jogadores;
	}
	
    public function index(){
		$jogador = new Jogador();
		$jogadores = $this->listaJogadores();
		$clubes = Clube::All();
		$posicoes = Posicao::All();
		return view("jogador.index", [
			"jogador" => $jogador,
			"jogadores" => $jogadores,
			"clubes" => $clubes,
			"posicoes" => $posicoes
		]);
	}
	
	public function store(Request $request){
		$request->validate([
			"nome" => "required",
			"nascimento" => "required|before_or_equal:today",
			"clube" => "required",
			"posicao" => "required"
		],[
			"nome.required" => "Nome é Obrigatório!",
			"nascimento.required" => "Data Nascimento é Obrigatório!",
			"clube.required" => "Clube é Obrigatório!",
			"posicao.required" => "Posição é Obrigatório!",
			"nascimento.before_or_equal" => "Data de Nascimento
			tem de ser menor que a data atual!"
		]);
		
		if($request->get("id") != 0){
			$jogador = Jogador::Find($request->get("id"));
		}else{
			$jogador = new Jogador();
		}
		$jogador->nome = $request->get("nome");
		$jogador->nascimento = $request->get("nascimento");
		$jogador->clube = $request->get("clube");
		$jogador->posicao = $request->get("posicao");
		
		if($request->get("possui") == 1){
			$jogador->possui = 1;
		}else{	
			$jogador->possui = 0;
		}
		$jogador->save();
		$request->session()->flash("status", "Salvo com sucesso!");
		return redirect("/jogador");
	}
	
	public function edit($id){
			
		$jogador = Jogador::Find($id);
		$jogadores = $this->listaJogadores();
		$clubes = Clube::All();
		$posicoes = Posicao::All();
		return view("jogador.index", [
			"jogador" => $jogador,
			"jogadores" => $jogadores,
			"clubes" => $clubes,
			"posicoes" => $posicoes
		]);
		
	}
	
	public function destroy(Request $request, $id){
		Jogador::Destroy($id);
		$request->session()->flash("status", "Deletado com sucesso!");
		return redirect("/jogador");
	}
	
	public function Adquirir(Request $request, $id){
		$jogador = Jogador::Find($id);
		$jogador->possui = 1;
		$jogador->save();
		$request->session()->flash("status", "Adquirido com sucesso!");
		return redirect("/jogador");
	}
	
}
