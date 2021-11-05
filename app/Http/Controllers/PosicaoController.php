<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posicao;

class PosicaoController extends Controller
{
    public function index()
    {
        $posicao = new Posicao();
		$posicoes = Posicao::All();
		return view ("posicao.index", [
				"posicao" => $posicao,
				"posicoes" => $posicoes
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$request->validate([
			"descricao" => "required"
		],[
			"descricao.required" => "Descrição é obrigatório"
		]);
		
        if($request->get("id") != 0){
			$posicao = Posicao::Find($request->get('id'));
		}else{
			$posicao = new Posicao();
		}
		$posicao->descricao = $request->get("descricao");
		$posicao->save();
		$request->session()->flash("status", "Salvo com sucesso!");
		return redirect("/posicao");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posicao = Posicao::Find($id);
		$posicoes = Posicao::All();
		return view ("posicao.index", [
				"posicao" => $posicao,
				"posicoes" => $posicoes
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Posicao::destroy($id);
		$request->session()->flash("status", "Excluido com sucesso!");
		return redirect("/posicao");
    }
}
