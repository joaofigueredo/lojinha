<x-layout tittle="Criar produto">
    <form class="form-group" action="{{ route('produtos.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-4 mt-3">
            <label for="nome" class="form-label">Nome do produto</label>
            <input type="text" class="form-control bg-light" id="nome" name="nome" autofocus>
        </div>
        <div class="row">
            <div class="col">
                <label for="preco" class="form-label">Preço do produto:</label>
                <input type="text" class="form-control" id="preco" name="preco">
            </div>
            <div class="col mb-1">
            <label for="categorias_id" class="form-label">Categoria do produto:</label>
                <select class="form-select" aria-label="Default select example" id="categoria_id" name="categoria_id">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{$categoria->nome}}</option>
                @endforeach
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="2"></textarea>
        </div>

        <div class="row mb-3">
          <div class="col-12">
               <label for="cover" class="form-label">Imagem do produto:</label>
               <input type="file" id="cover" name="cover" class="form-control" accept="image/gif, image/jpeg, image/png">
          </div>
    </div>
        <button type="submit" class="btn btn-primary mt-2">Criar</button>
    </form>
</x-layout>