<x-layout tittle="Compras">
    <div class="container">
        @if(session()->has('success'))

        <div class="alert alert-info">
            <strong>{{session()->get('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif
        @if(session()->has('error'))

        <div class="alert alert-info">
            <strong>{{session()->get('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif
    </div>

    <div class="container">
        <h2>Minhas compras</h2>
        <hr>
        <div class="container">
            <div class="card-body">
                <h4 class="card-title">Compras concluídas</h4>
                @forelse ($compras as $pedido)
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <h5 class="card-title">Pedido : {{$pedido->id}} </h5>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="card-title">Criado em : {{$pedido->created_at->format('d/m/Y H:i')}} </h5>
                    </div>
                </div>
                <div class="row">
                    <form method="post" action="{{ route('carrinho.cancelar') }}">
                        @csrf
                        <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Produto</th>
                                    <th>Valor</th>
                                    <th>Desconsto(s)</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total_pedido = 0;
                                @endphp
                                @foreach ($pedido->pedido_produtos_itens as $pedido_produto)
                                @php
                                $total_produto = $pedido_produto->valor - $pedido_produto->desconto;
                                $total_pedido += $total_produto;
                                @endphp
                                <tr>
                                    <th class="center">
                                        @if($pedido_produto->status == 'PA')
                                        <p>
                                            <input type="checkbox" id="item-{{ $pedido_produto->id }}" name="id[]" value="{{ $pedido_produto->id }}" />
                                            <label for="item-{{ $pedido_produto->id }}">Selecionar</label>
                                        </p>
                                        @else
                                        <p>CANCELADO</p>
                                        @endif
                                    </th>
                                    <th>
                                        <img src="{{ asset('storage/' . $pedido_produto->produto->cover) }}" alt="" width="100" height="100">
                                    </th>
                                    <th>
                                        R$: {{number_format($pedido_produto->valor, 2, ',', '.')}}
                                    </th>
                                    <th>
                                        R$: {{number_format($pedido_produto->descontos, 2, ',', '.')}}
                                    </th>
                                    <th>
                                        R$: {{number_format($total_produto, 2, ',', '.')}}
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>
                                <td>
                                    <button type="submit" class="btn btn-block btn-info">
                                        cancelar
                                    </button>
                                </td>
                                </th>
                                <th>
                                    <p>
                                        Total do pedido R$: {{number_format($total_pedido, 2, ',', '.')}}
                                    </p>
                                </th>
                            </tfoot>
                    </form>
                    </table>
                    <hr>



                </div>
                @empty
                <h5 class="text-center">
                    @if ($compras->count() > 0)
                    Neste momento não há compras validas
                    @else
                    Você ainda não fez nenhuma compra.
                    @endif
                </h5>
                @endforelse
                <hr>
            </div>
            <div class="mt-4">
                <h4>Compras canceladas</h4>
                <div class="card-body">
                    @forelse ($cancelados as $pedido_cancelados)
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <h5 class="card-title">Pedido : {{$pedido_cancelados->id}} </h5>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="card-title">Criado em : {{$pedido_cancelados->created_at->format('d/m/Y H:i')}} </h5>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Valor Unit.</th>
                                    <th scope="col">Desconsto(s)</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total_pedido = 0;
                                @endphp
                                @foreach ($pedido_cancelados->pedido_produtos_itens as $pedido_produto_cancelados)

                                @php
                                $total_produto = $pedido_produto_cancelados->produto->preco - $pedido_produto->descontos;
                                $total_pedido += $total_produto;
                                @endphp

                                <tr>
                                    <th>
                                        {{ $pedido_produto_cancelados->produto->nome }}
                                    </th>
                                    <th>
                                        R$: {{number_format($pedido_produto_cancelados->produto->preco, 2, ',', '.')}}
                                    </th>
                                    <th>
                                        R$: {{number_format($pedido_produto_cancelados->descontos, 2, ',', '.')}}
                                    </th>

                                    <th>
                                        R$: {{number_format($total_produto, 2, ',', '.')}}
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="container">
                            <p class="fs-3">Total: R$ {{number_format($total_pedido, 2, ',', '.')}} </p>
                        </div>
                    </div>
                    @empty
                    <h5 class="text-center">
                        Nenhuma compra foi cancelada.
                    </h5>
                    @endforelse
                    <hr>
                </div>
            </div>
        </div>

    </div>
</x-layout>