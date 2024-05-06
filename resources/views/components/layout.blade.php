<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tittle }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <link rel="icon" href="{{ asset('/loja.png') }}">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark d-flex p-3" style="background-color:#271625">
            <div class="container-fluid" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                    </li>
                    @auth
                    @if(auth()->user()->admin)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('produtos.create') }}">Adicionar produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categorias.create') }}">Adicionar categoria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categorias.index') }}">Listar categoria</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('produtos.index') }}">Produtos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carrinho.compras') }}">Minhas compras</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cupom.index') }}">Cupons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carrinho.index') }}">Carrinho</a>
                    </li>
                </ul>

                <form action="{{ route('produtos.buscar') }}" class="form-inline" id="buscaProduto" method="POST">
                    @csrf
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="nome" name="nome">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                @endauth
                @guest
                <a class="nav-link link-light" href="{{ route('login') }}">Login</a>
                @endguest
                @auth
                <a class="nav-link link-light" href="{{ route('logout') }}">Logout</a>
                @endauth
            </div>
        </nav>
    </header>
    <main class="conteudo">
        @isset($mensagemSucesso)
        <div class="alert alert-success">
            {{ $mensagemSucesso }}
        </div>
        @endisset
        
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{ $slot }}
    </main>

    <footer>
        <div class="text-center p-2 m-0" style="background-color:#271625">
            <p class="text-light">
                © 2024 Copyright:
                <a class="text-light" href="https://github.com/joaofigueredo" target="_blank">
                    joaoFigueredo
                </a>
            </p>
        </div>
    </footer>
</body>

</html>