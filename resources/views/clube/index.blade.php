@extends("layout.master")

@section("titulo", "Clube")

@section("cadastro")
	<h1>Cadastro</h1>
	<form action="/clube" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-6 form-group">
				<label for="nome">Nome:</label>
				<input type="text" id="nome" name="nome" value="{{$clube->nome}}" class="form-control"/>
				@if ($errors->get("nome"))
					<small class="text-danger">{{$errors->first("nome")}}</small>
					<script>$("#nome").addClass("is-invalid");</script>
				@endif
			</div>
			<div class="col-4 form-group">
				<label for="escudo">Escudo:</label>
				<input type="file" id="escudo" name="escudo" class="form-control"/>
				@if ($errors->get("escudo"))
					<small class="text-danger">{{$errors->first("escudo")}}</small>
					<script>$("#escudo").addClass("is-invalid");</script>
				@endif
			</div>
			<div class="col-2 form-group">
				<input type="hidden" name="id" value="{{$clube->id}}"/>
				<button type="submit" class="btn btn-success botoes"><i class="fa fa-save"></i>Salvar</button>
				<a class="btn btn-primary botoes" href="/clube"><i class="fa fa-plus"></i>Novo</a>
			</div>
		</div>
	</form>

@stop

@section("listagem")
	<h1>Listagem</h1>
	<table class="table table-striped">
		<colgroup>
			<col width="300">
			<col width="120">
			<col width="50">
			<col width="50">
			
		</colgroup>
		<tr>
			<th>Nome</th>
			<th>Escudo</th>
			<th>Editar</th>
			<th>Excluir</th>
		</tr>
		@foreach ($clubes as $c)
			<tr>
				<td>{{$c->nome}}</td>
					<td>
						<img src="{{Storage::Url($c->escudo)}}" width="100"/>
					</td>
					<td>
						<a href="/clube/{{$c->id}}/edit" class="btn btn-warning"><i class="fa fa-edit"></i>Editar</a>
					</td>
				<td>
					<a href="/clube/{{$c->id}}/delete" class="btn btn-danger" onclick="return confirm ('Tem certeza?');"><i class="fa fa-trash"></i>Excluir</a>
				</td>
			</tr>
		@endforeach
	</table>

@stop