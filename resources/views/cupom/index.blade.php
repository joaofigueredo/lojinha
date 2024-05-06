<x-layout tittle="Cupom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Cadastro</li>
                <li class="breadcrumb-item active" aria-current="page">Cupom Desconto</li>
            </ol>
        </nav>
        
        <div class="card">
            @if(auth()->user()->admin)
            <div class="card-header">
                <a href="{{ route('cupom.create') }}" class="btn btn-info">Novo</a>
            </div>
            @endif    
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">localizador</th>
                            <th scope="col">desconto</th>
                            @if(auth()->user()->admin)
                            <th scope="col">Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cupomDescontos as $cupomDesconto)
                        <tr>
                            <th scope="row">{{$cupomDesconto->id}}</th>
                            <td>{{$cupomDesconto->nome}}</td>
                            <td>{{$cupomDesconto->localizador}}</td>
                            <td>{{$cupomDesconto->desconto}}</td>
                            @if(auth()->user()->admin)
                            <td>
                                <div class="row">
                                    
                                        <div class="col">
                                            <a href="{{ route('cupom.edit', $cupomDesconto->id) }}" class="btn btn-primary">
                                                Update
                                            </a>
                                        </div>
                                        <div class="col">
                                            <form action="{{ route('cupom.destroy', $cupomDesconto->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <h2>Não há cupom cadastrado!</h2>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>