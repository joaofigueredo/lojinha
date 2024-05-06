<x-layout tittle="Produto">

    <!-- Carrossel com imagens dos produtos -->
    <!-- <div class="container-fluid">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($produtos as $indice => $produto)
                <li data-target="#myCarousel" data-slide-to="{{ $indice }}" class="{{ $indice === 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>

            <div class="carousel-inner">
                @foreach($produtos as $indice => $produto)
                <div class="carousel-item {{ $indice === 0 ? 'active' : '' }}">
                    <img style="height: 200px; width:100%" src="{{ asset('storage/' . $produto->cover) }}" alt="Produto {{ $indice + 1 }}">
                </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>
    </div> -->

    @foreach($produtos as $produto)
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="{{ asset('storage/' . $produto->cover) }}" data-holder-rendered="true">
                        <div class="card-body">
                            <p class="card-text">{{ $produto->nome }}</p>
                            <p class="card-text">{{ $produto->descricao }}</p>
                            <p class="card-text">R${{ $produto->preco }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Links de paginação -->
    {{$produtos->links()}}
</x-layout>