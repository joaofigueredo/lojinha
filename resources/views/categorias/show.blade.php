<x-layout tittle="{{$categoria->nome}}">
    @foreach($categoria->produtos as $produto)
    <div class="d-flex justify-content-center container mt-5">
        <div class="card p-3 bg-white">
            <div class="about-product text-center mt-2"><img src="{{ asset('storage/' . $produto->cover) }}" width="300">
                <div>
                    <h4><a style="text-decoration:none" href="{{ route('produtos.show', $produto->id) }}">{{$produto->nome}}</a></h4>
                    <h6 class="mt-0 text-black-50"></h6>
                </div>
            </div>
            <div class="stats mt-2">
                <div class="d-flex justify-content-between p-price"><span>Preço</span><span>R${{$produto->preco}}</span></div>
                <div class="d-flex justify-content-center p-price"><span>{{$produto->descricao}}</span></div>
            </div>
        </div>
    </div>
    @endforeach

</x-layout>