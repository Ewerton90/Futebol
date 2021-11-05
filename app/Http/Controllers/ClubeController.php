<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Clube;

class ClubeController extends Controller
{
    
    public function index()
    {
        $clube = new Clube();
		$clubes = Clube::All();
		return view("clube.index",[
			"clube" => $clube,
			"clubes" => $clubes
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
			"nome" => "required"
		],[
			"nome.required" => "Nome é Obrigatório!"
		]);
		
        if($request->get("id") != 0){
			$clube = Clube::Find($request->get("id"));
		}else{
			$clube = new Clube();
			
			$request->validate([
			"escudo" => "required|mimes:jpeg,jpg,bmp,gif,png"
		],[
			"escudo.required" => "Escudo é Obrigatório!", 
			"escudo.mimes" => "Somente imagens são permitidas!"
		]);
			
		}
		$clube->nome = $request->get("nome");
		$clube->save();
		
		if($request->hasFile("escudo")){
			
			if($request->get("id") != 0){
				Storage::delete($clube->escudo);
			}
			
			$nome = $clube->id . "." . $request->file("escudo")->extension();
		
			$clube->escudo = $request->file("escudo")->storeAs("public", $nome);
		
			$clube->save();
		}
		
		$request->session()->flash("status", "Salvo com sucesso!");
		return redirect("/clube");
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
        $clube = Clube::Find($id);
		$clubes = Clube::All();
		return view("clube.index",[
			"clube" => $clube,
			"clubes" => $clubes
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
    public function destroy( Request $request, $id)
    {
		$clube = Clube::Find($id);
		Storage::delete($clube->escudo);
        Clube::Destroy($id);
		$request->session()->flash("status", "Excluido com sucesso!");
		return redirect("/clube");
    }
}
