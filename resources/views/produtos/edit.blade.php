<x-layout tittle="Alterar">
    <form class="form-group" action="{{ route('produtos.update', $produto->id) }}" method="post">
        @csrf
        @method("PUT")
        <div class="mb-4 mt-3">
            <label for="nome" class="form-label">Nome do produto</label>
            <input type="text" class="form-control bg-light" id="nome" name="nome" autofocus value="{{$produto->nome}}">
        </div>
        <div class="row">
            <div class="col">
                <label for="preco" class="form-label">Nome do produto</label>
                <input type="text" class="form-control" id="preco" name="preco" value="{{ $produto->preco }}">
            </div>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" value="{{ $produto->descricao}}" id="descricao" name="descricao" rows="3">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Criar</button>
    </form>
</x-layout>