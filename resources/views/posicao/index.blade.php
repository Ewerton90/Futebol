@extends("layout.master")

@section("titulo", "Posicao")

@section("cadastro")
	<h1>Cadastro</h1>
	<form action="/posicao" method="POST">
		@csrf
		<div class="row">
			<div class="col-10 form-group">
				<label for="descricao">Descrição</label>
				<input type="text" id="descricao" name="descricao" value="{{$posicao->descricao}}" class="form-control"/>
				@if ($errors->get("descricao"))
					<small class="text-danger">{{$errors->first("descricao")}}</small>
					<script>$("#descricao").addClass("is-invalid");</script>
				@endif
			</div>
			<div class="col-2 form-group">
				<input type="hidden" name="id" value="{{$posicao->id}}"/>
				<button type="submit" class="btn btn-success botoes"><i class="fa fa-save"></i>Salvar</button>
				<a class="btn btn-primary botoes" href="/posicao"><i class="fa fa-plus"></i>Novo</a>
			</div>
		</div>
	</form>

@stop

@section("listagem")
	<h1>Listagem</h1>
	<table class="table table-striped">
		<colgroup>
			<col width="300">
			<col width="50">
			<col width="50">
			
		</colgroup>
		<tr>
			<th>Descrição</th>
			<th>Editar</th>
			<th>Excluir</th>
		</tr>
		@foreach ($posicoes as $p)
			<tr>
				<td>{{$p->descricao}}</td>
				<td>
					<a href="/posicao/{{$p->id}}/edit" class="btn btn-warning"><i class="fa fa-edit"></i>Editar</a>
				</td>
				<td>
					<a href="/posicao/{{$p->id}}/delete" class="btn btn-danger" onclick="return confirm ('Tem certeza?'); "><i class="fa fa-trash"></i>Excluir</a>
				</td>
			</tr>
		@endforeach
	</table>

@stop