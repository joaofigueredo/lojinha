<x-layout tittle="Categorias">
    @foreach($categorias as $categoria)
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a style="Text-decoration: none;" href="{{ route('categorias.show', $categoria->id) }}">{{ $categoria->nome }}</a><span class="d-flex">
                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary btn-sm">
                    E
                </a>
                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">X</button>
                </form>
            </span></li>
    </ul>
    @endforeach

</x-layout>