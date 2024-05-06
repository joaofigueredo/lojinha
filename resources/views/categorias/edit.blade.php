<x-layout tittle="Editar Categoria">
<form class="form-group" action="{{ route('categorias.update', $categoria->id) }}" method="post">
    @csrf
    @method('PUT')
        <div class="mb-4 mt-3">
            <label for="nome" class="form-label">Nome da categoria</label>
            <input type="text" class="form-control bg-light" value="{{$categoria->nome}}" id="nome" name="nome" autofocus>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Salvar</button>
    </form>
</x-layout>