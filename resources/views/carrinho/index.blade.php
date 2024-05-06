<x-layout tittle="Carrinho">

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
        <div class="card">
            <h5 class="card-header">Produtos do carrinho </h5>
            <div class="card-body">
                @forelse ($pedidos as $pedido)
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title">Pedido : {{ $pedido->id}}</h5>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="card-title">Criado em : {{ $pedido->created_at->format('d/m/Y H:i')}}</h5>
                    </div>
                </div>
                <div class="row">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Produto</th>
                                <th scope="col">Qtd</th>
                                <th scope="col">Valor Unit.</th>
                                <th scope="col">Desconto(s)</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_pedido = 0;
                            @endphp
                            @foreach ($pedido->pedido_produtos as $pedidosProdutos )
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $pedidosProdutos->produto->cover) }}" alt="" width="100" height="100">
                                </td>
                                <td class="center-align">
                                    <div class="center-align">
                                        <a style="text-decoration:none;" href="#" class="col 14 m4 s4" onclick="carrinhoRemoverProduto(
                                          {{ $pedido->id }},
                                          {{$pedidosProdutos->produto_id}},
                                          1)">
                                            <i class="fa fa-plus-circle" aria-hidden="true">-</i>
                                        </a>
                                        <span class="col-lg-4">{{ $pedidosProdutos->qtd }}</span>
                                        <a style="text-decoration:none;" href="#" onclick="carrinhoAdicionarProduto(
                                          {{ $pedidosProdutos->produto_id }})">
                                            <i class="fa fa-plus-circle" aria-hidden="true">+</i>
                                        </a>
                                    </div>
                                    <a style="text-decoration:none;" href="#" onclick="carrinhoRemoverProduto(
                                          {{ $pedido->id }},
                                          {{$pedidosProdutos->produto_id}},
                                          0)" class="tooltiped" data-position="right" data-delay="50" data-tooltip="Retirar produto do carrinho?">Retirar produto</a>

                                    </th>
                                <th>
                                    {{$pedidosProdutos->produto->preco}}
                                </th>
                                <th>
                                    R$: {{number_format($pedidosProdutos->descontos, 2, ',', '.')}}
                                </th>
                                @php
                                $total_produto = $pedidosProdutos->valores - $pedidosProdutos->descontos;
                                $total_pedido += $total_produto;
                                @endphp
                                <th>
                                    R$: {{number_format($total_produto, 2, ',', '.')}}
                                </th>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    </div>
                    <hr>
                    <div class="container">
                        <div class="">
                            <div>
                                <div class="row">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td>
                                                <a style="text-decoration:none;"  href="{{ route('produtos.index') }}" class="btn btn-info">CONTINUAR COMPRANDO</a>
                                            </td>
                                            <th>
                                                <form action="{{ route('carrinho.desconto') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                                                    Cupom de desconto: <input type="text" name="cupom">
                                                    <button class="btn btn-info">Validar</button>
                                                </form>
                                            </th>
                                            <th>
                                                <p class="fs-3">R$ {{number_format($total_pedido, 2, ',', '.')}}</p>
                                            </th>
                                            @php
                                            $total_produto = $pedidosProdutos->valores - $pedidosProdutos->descontos;
                                            $total_pedido += $total_produto;
                                            @endphp
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div>
                            <form method="post" action="{{ route('carrinho.concluir') }}">
                                @csrf
                                <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                                <button type="submit" class="btn btn-success">CONCLUIR COMPRA</button>
                            </form>
                            </div>
                        </div>

                        @empty
                        <h5>Não há nenhum pedido no carrinho</h5>
                        <div class="col-lg-4">
                            <a href="{{ route('produtos.index') }}" class="btn btn-block btn-info">Ver produtos</a>
                        </div>
                        @endforelse
                    </div>
                </div>
            

            <form method="post" id="form-remover-produto" action="{{ route('carrinho.remover') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="pedido_id">
                <input type="hidden" name="produto_id">
                <input type="hidden" name="item">
            </form>

            <form method="post" action="{{ route('carrinho.adicionar') }}" id="form-adicionar-produto">
                @csrf
                <input type="hidden" name="id">
            </form>

            <script src="{{ asset('js/controlador.js') }}"></script>
            <script src="{{ asset('js/jquery-3.7.1.js') }}"></script>

</x-layout>