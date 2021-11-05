@extends("layout.master")

@section("titulo", "Jogador")

@section("cadastro")
	<h1>Cadastro</h1>
	<form action="/jogador" method="POST">
		@csrf
		<div class="row">
			<div class="col-6 form-group">
				<label for="nome">Nome:</label>
				<input type="text" id="nome" name="nome" value="{{$jogador->nome}}" class="form-control"/>
				@if ($errors->get("nome"))
					<small class="text-danger">{{$errors->first("nome")}}</small>
					<script>$("#nome").addClass("is-invalid");</script>
				@endif
			</div>
			<div class="col-3 form-group">
				<label for="nascimento">Dt. Nascimento</label>
				<input type="date" id="nascimento" name="nascimento" value="{{$jogador->nascimento}}" class="form-control"/>
				@if ($errors->get("nascimento"))
					<small class="text-danger">{{$errors->first("nascimento")}}</small>
					<script>$("#nascimento").addClass("is-invalid");</script>
				@endif
			</div>
			<div class="col-3 form-group">
				<br/>
				@if($jogador->possui == 1)
					<input type="checkbox" id="possui" name="possui" value="1" checked="checked" class="form-group"/>
				@else
					<input type="checkbox" id="possui" name="possui" value="1" />
				@endif
				<label for="possui">Possui</label>
			</div>
			<div class="col-3 form-group">
				<label for="clube">Clube:</label>
				<!--<input type="text" id="clube" name="clube" value="{{$jogador->clube}}" class="form-control"/>-->
				<select id="clube" name="clube" class="form-control">
					<option value=""></option>
					@foreach($clubes as $c)
						@if ($c->id == $jogador->clube)
							<option value="{{$c->id}}" selected="selected">{{$c->nome}}</option>
						@else
							<option value="{{$c->id}}">{{$c->nome}}</option>
						@endif
					@endforeach
				</select>
				@if ($errors->get("clube"))
					<small class="text-danger">{{$errors->first("clube")}}</small>
					<script>$("#clube").addClass("is-invalid");</script>
				@endif
			</div>
			<div class="col-3 form-group">
				<label for="posicao">Posição:</label>
				<!--<input type="text" id="posicao" name="posicao" value="{{$jogador->posicao}}" class="form-control"/>-->
				<select id="posicao" name="posicao" class="form-control">
					<option value=""></option>
					@foreach($posicoes as $p)
						@if ($p->id == $jogador->posicao)
							<option value="{{$p->id}}" selected="selected">{{$p->descricao}}</option>
						@else
							<option value="{{$c->id}}">{{$p->descricao}}</option>
						@endif
					@endforeach
				</select>
				@if ($errors->get("posicao"))
					<small class="text-danger">{{$errors->first("posicao")}}</small>
					<script>$("#posicao").addClass("is-invalid");</script>
				@endif
			</div>
			<!--<div class="col-4 form-group">
				<label for="escudo">Escudo:</label>
				<input type="file" id="escudo" name="escudo" class="form-control"/>
				@if ($errors->get("escudo"))
					<small class="text-danger">{{$errors->first("escudo")}}</small>
					<script>$("#escudo").addClass("is-invalid");</script>
				@endif
			</div>-->
			<div class="col-3 form-group">
				<input type="hidden" name="id" value="{{$jogador->id}}"/>
				<button type="submit" class="btn btn-success botoes"><i class="fa fa-save"></i>Salvar</button>
				<a class="btn btn-primary botoes" href="/jogador"><i class="fa fa-plus"></i>Novo</a>
			</div>
		</div>
	</form>

@stop

@section("listagem")
	<h1>Listagem</h1>
	<table class="table table-striped">
		<colgroup>
			<col width="200">
			<col width="120">
			<col width="120">
			<col width="50">
			<col width="50">
			<col width="50">

		</colgroup>
		<tr>
			<th>Nome</th>
			<th>Posição</th>
			<th>Clube</th>
			<th>Editar</th>
			<th>Excluir</th>
			<th>Possui</th>
		</tr>
		@foreach ($jogadores as $j)
			<tr>
				<td>{{$j->nome}}</td>
				<td>{{$j->posicao}}</td>
					<td>
						<img src="{{Storage::Url($j->escudo)}}" width="100"/>
					</td>
					<td>
						<a href="/jogador/{{$j->id}}/edit" class="btn btn-warning"><i class="fa fa-edit"></i>Editar</a>
					</td>
				<td>
					<a href="/jogador/{{$j->id}}/delete" class="btn btn-danger" onclick="return confirm ('Tem certeza?');"><i class="fa fa-trash"></i>Excluir</a>
				</td>
				<td>
					@if($j->possui)
						Sim
					@else 
						<a href="/jogador/{{$j->id}}/adquirir" class="btn btn-success"><i class="fa fa-plus"></i>Adquirir</a>
					@endif
				</td>
			</tr>
		@endforeach
	</table>

@stop