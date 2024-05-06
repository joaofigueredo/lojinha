<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Categoria;
use App\Models\CupomDesconto;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\Flysystem\ChecksumAlgoIsNotSupported;

class CarrinhoController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $pedidos = Pedido::where([
            'status' => 'RE',
            'user_id' => Auth::id()
        ])->get();
        // dd($pedidos[0]->pedido_produtos[0]->produto->cover);
        
        return view('carrinho.index')->with('pedidos', $pedidos);
    }

    public function adicionar(Request $request)
    {       
        
        $req = Request();
        $idProduto = $req->input('id');
        
        $produto = Produtos::find($idProduto);
        // dd($produto);
        if(empty($produto->id)) {
            return to_route('carrinho.index')->with('mensagem.falha', 'Produto não encontrado!');
        }

        $idUsuario = Auth::id();

        $idPedido = Pedido::consultaId([
            'user_id' => $idUsuario,
            'status' => 'RE'
        ]);

        if(empty($idPedido)) {
            $pedidoNovo = Pedido::create([
                'user_id' => $idUsuario,
                'status' => 'RE'
            ]);
            $idPedido = $pedidoNovo->id;
        }

        PedidoProduto::create([
            'pedido_id' => $idPedido,
            'produto_id' => $idProduto,
            'valor' => $produto->preco,
            'status' => 'RE'
        ]);

        return redirect()->route('carrinho.index')->with('mensagem.sucesso', 'Produto adicionado ao carrinho!');
    }

    public function remover()
    {
        $req = Request();
        $idPedido = $req->input('pedido_id');
        $idProduto = $req->input('produto_id');

        $removeApenasItem = (boolean)$req->input('item');
        
        $idUsuario = Auth::id();
        

        $idPedido = Pedido::consultaId([
            'id' => $idPedido,
            'user_id' => $idUsuario,
            'status' => 'RE'
        ]);
        // dd($idPedido);
        if(empty($idPedido)) {
            return to_route('carrinho.index')->with('mensagem.falha', 'Produto não encontrado!');
        }

        $whereProduto = [
            'pedido_id' => $idPedido,
            'produto_id' => $idProduto
        ];

        // dd($whereProduto);

        $produto = PedidoProduto::where($whereProduto)->orderBy('id', 'desc')->first();
        // dd($produto);
        if(empty($produto->id)) {
            return to_route('carrinho.index')->with('mensagem.falha', 'Produto não encontrado!');
        }

        if($removeApenasItem) {
            $whereProduto['id'] = $produto->id;
        }
        PedidoProduto::where($whereProduto)->delete();

        $checkPedido = PedidoProduto::where([
            'pedido_id' => $produto->pedido_id
        ])->exists();

        if(!$checkPedido) {
            Pedido::where([
                'id' => $produto->pedido_id
            ])->delete();
        }

        return to_route('carrinho.index')->with('mensagem.sucesso', 'Produto removido do carrinho com sucesso!');
    }

    public function concluir()
    {
        $req = Request();
        $idPedido = $req->input('pedido_id');
        $idUsuario = Auth::id();

        $checkPedido = Pedido::where([
            'id' => $idPedido,
            'user_id' => $idUsuario,
            'status' => 'RE',
        ])->exists();

        if(!$checkPedido) {
            return to_route('carrinho.index')->with('mensagem.falha', 'Pedido não encontrado!');
        }

        $checkProdutos = PedidoProduto::where([
            'pedido_id' => $idPedido
        ])->exists();

        if(!$checkProdutos) {
            return to_route('carrinho.index')->with('mensagem.falha', 'Produtos do pedido não econtrado!');
        }

        PedidoProduto::where([
            'pedido_id' => $idPedido
        ])->update([
            'status' => 'PA'
        ]);

        Pedido::where([
            'id' => $idPedido
        ])->update([
            'status' => 'PA'
        ]);

        return to_route('carrinho.compras')->with('mensagem.sucesso', 'Compra concluida com sucesso!');
    }

    public function compras()
    {

        $compras = Pedido::where([
            'status' => 'PA',
            'user_id' => Auth::id()
        ])->orderBy('created_at', 'desc')->get();



        $cancelados = Pedido::where([
            'status' => 'CA',
            'user_id' => Auth::id()
        ])->orderBy('updated_at', 'desc')->get();
        
        return view('carrinho.compras')
            ->with('compras', $compras)
            ->with('cancelados', $cancelados);
    }

    public function cancelar()
    {
        
        $req = Request();
        $idPedido = $req->input('pedido_id');
        $idsPedidoProd = $req->input('id');
        $idUsuario = Auth::id();

        if(empty($idsPedidoProd)) {
            return to_route('carrinho.index')->with('mensagem.erro', 'Nenhum item selecionado para cancelamento!');
        }

        $checkPedido = Pedido::where([
            'id' => $idPedido,
            'user_id' =>$idUsuario,
            'status' => 'PA'
        ])->exists();

        if(!$checkPedido) {
            return to_route('compras')->with('mensagem.falha', 'Produtos do pedido não encontrado!');
        }

        $checkProdutos = PedidoProduto::where([
            'pedido_id' => $idPedido,
            'status' => 'PA'
        ])->whereIn('id', $idsPedidoProd)->exists();

        if(!$checkProdutos) {
            return to_route('carrinho.compras')->with('mensagem.falha', 'Produtos do pedido não encontrado');
        }

        PedidoProduto::where([
            'pedido_id' => $idPedido,
            'status' => 'PA'
        ])->whereIn('id', $idsPedidoProd)->update([
            'status' => 'CA'
        ]);

        $checkPedidoCancel = PedidoProduto::where([
            'pedido_id' => $idPedido,
            'status' => 'PA'
        ])->exists();

        if(!$checkPedidoCancel) {
            Pedido::where([
                'id' => $idPedido
            ])->update([
                'status' => 'CA'
            ]);

            $mensagemSucesso = 'compra cancelada com sucesso!';
        }
        else{
            $mensagemSucesso = 'Item(ns) da compra cancelado com sucesso';
        }

        return to_route('carrinho.compras')->with('mensagem.sucesso', $mensagemSucesso);
    }

    public function desconto()
    {
        $req = Request();
        $idPedido = $req->input('pedido_id');
        $cupom = $req->input('cupom');
        $idUsuario = Auth::id();

        if(empty($cupom)) {
            return to_route('carrinho.index')->with('mensagem.falha', 'Cupom invalido!');
        }

        $cupom = CupomDesconto::where([
            'localizador' => $cupom,
            'ativo' => 'S'
        ])->where('dthr_validade', '>', date('Y-m-d H:i:s'))->first();

        if(empty($cupom->id)) {
            return to_route('carrinho.index')->with('Cupom de desconto não encontrado!');
        }

        $checkPedido = Pedido::where([
            'id' => $idPedido,
            'user_id' => $idUsuario,
            'status' => 'RE'
        ])->exists();

        if(!$checkPedido) {
            return to_route('carrinho.index')->with('mensagem.falha', 'Pedido não encontrado para validação!');
        }

        $pedidoProdutos = PedidoProduto::where([
            'pedido_id' => $idPedido,
            'status' => 'RE'
        ])->get();

        if(empty($pedidoProdutos)) {
            return to_route('carrinho.index')->with('mensagem.falha', 'Produtos do pedido não encontrado!');
        }

        $aplicouDesconto = false;
        foreach($pedidoProdutos as $pedidoProduto) {
            switch($cupom->modo_desconto) {
                case 'porc':
                    $valor_desconto = ($pedidoProduto->valor * $cupom->desconto) / 100;
                    break;
                default:
                    $valor_desconto = $cupom->desconto;
                    break;
            }

            $valor_desconto = ($valor_desconto > $pedidoProduto->valor) ? $pedidoProduto->valor : number_format($valor_desconto, 2);

            switch($cupom->modo_limite) {
                case 'qtd':
                    $qtdPedido = PedidoProduto::whereIn('status', ['PA', 'RE'])->where([
                        'cupom_desconto_id' => $cupom->id
                    ])->count();

                    if($qtdPedido >= $cupom->limite) {
                        continue 2;
                    }
                    break;

                default:
                    $valor_ckc_descontos = PedidoProduto::whereIn('status', ['PA', 'RE'])->where([
                            'cupom_desconto_id' => $cupom->id
                    ])->sum('desconto');

                if(($valor_ckc_descontos + $valor_desconto) > $cupom->limite) {
                    continue 2;
                }
                break;
            }

            $pedidoProduto->cupom_desconto_id = $cupom->id;
            $pedidoProduto->desconto = $valor_desconto;
            $pedidoProduto->update();

            $aplicouDesconto = true;
        }

        if($aplicouDesconto) {
            $mensagem = 'Cupom aplicado com sucesso!';
        }
        else {
            $mensagem = 'Cupom esgotado';
        }

        return to_route('carrinho.index')->with('mensagem', $mensagem);
    }   
}