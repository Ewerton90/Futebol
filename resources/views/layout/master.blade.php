<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/botoes.css')}}"/>
		<script src="{{asset('js/jquery.js')}}"></script>
		<script src="{{asset('js/bootstrap.js')}}"></script>
		<link rel="stylesheet" href="{{asset('css/fa/css/all.css')}}"/>
		<title>@yield("titulo")</title>
    </head>
    <body class="antialiased">
        <nav class="navbar navbar-expand-sm bg-light">
			<ul class="navbar-nav">
				<li	class="nav-item">
					<a class="nav-link" href="/posicao">Posicao
					</a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li	class="nav-item">
					<a class="nav-link" href="/clube">Clube
					</a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li	class="nav-item">
					<a class="nav-link" href="/jogador">Jogador
					</a>
				</li>
			</ul>
		</nav>
        @if (Session::has("status"))
			<div class="alert alert-success">
			{{Session::get("status")}}
			</div>
		@endif
		<div class="container">
			<div id="cadastro">
				@yield("cadastro")
			</div>
			<div id="listagem">
				@yield("listagem")
			</div>
		</div>
    </body>
</html>
