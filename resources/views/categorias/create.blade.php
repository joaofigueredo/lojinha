<x-layout tittle="Criar Categoria">
<form class="form-group" action="{{ route('categorias.store') }}" method="post">
    @csrf
        <div class="mb-4 mt-3">
            <label for="nome" class="form-label">Nome da categoria</label>
            <input type="text" class="form-control bg-light" id="nome" name="nome" autofocus>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Criar</button>
    </form>
</x-layout>