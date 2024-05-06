<x-layout tittle="Produto {{ $produto->nome }}">
    <div class="container">
        <div>
            <h3>{{ $produto->nome }}</h3>
            <div class="section col s12 m6 l4">
                <div class="card-body">
                    <img class="img-fluid" width="200" data-caption="{{ $produto->nome }}" src="{{ asset('storage/' . $produto->cover) }}" alt="{{ $produto->nome }}" title="{{ $produto->nome }}">
                    <p class="fs-4">
                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                    </p>
                    <p>
                        {!! $produto->descricao !!}
                    </p>
                </div>
            </div>
            <hr>
            <div class="container">
                <form method="POST" action="{{ route('carrinho.adicionar') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $produto->id }}">
                    <button class="btn btn-success" data-position="bottom" data-delay="50" data-tooltip="O produto será adicionado ao seu carrinho">Adicionar ao carrinho</button>
                </form>
                @if(auth()->user()->admin)
                <div class="col">
                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <a class="btn btn-danger" href="{{ route('produtos.edit', $produto->id) }}">Editar</a>

                @endif
            </div>
        </div>
</x-layout>