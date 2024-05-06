<x-layout tittle="Home">

    <body>
        <main role="main">

            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">GraciellyStore</h1>
                    <p class="lead text-muted">Loja onde você pode encontrar seus produtos  geek preferidos.</p>
                    @auth
                    <p>
                        <a href="{{ route('categorias.index') }}" class="btn btn-primary my-2">Categorias</a>
                        <a href="{{ route('produtos.index') }}" class="btn btn-secondary my-2">Produtos</a>
                    </p>
                    @endauth
                </div>
            </section>

            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="{{ asset('storage/' . $produtos[0]->cover) }}" data-holder-rendered="true">
                                <div class="card-body">
                                    <p class="card-text">{{ $produtos[0]->nome }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        @auth
                                        <div class="btn-group">
                                            <a href="{{ route('produtos.show', $produtos[0]->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                                        </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="{{ asset('storage/' . $produtos[1]->cover) }}" data-holder-rendered="true">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                    <p class="card-text">{{ $produtos[1]->nome }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            @auth
                                            <a href="{{ route('produtos.show', $produtos[1]->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                                            @endauth
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="{{ asset('storage/' . $produtos[2]->cover) }}" data-holder-rendered="true">
                                <div class="card-body">
                                    <p class="card-text">{{$produtos[2]->nome}}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            @auth
                                            <a href="{{ route('produtos.show', $produtos[2]->id) }}" type="button" class="btn btn-sm btn-outline-secondary">Ver</a>
                                            @endauth
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </main>

        <!-- Principal JavaScript do Bootstrap
================================================== -->
        <!-- Foi colocado no final para a página carregar mais rápido -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script>
            window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
        </script>
        <script src="../../assets/js/vendor/popper.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <script src="../../assets/js/vendor/holder.min.js"></script>
</x-layout>