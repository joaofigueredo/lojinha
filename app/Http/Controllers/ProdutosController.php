<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutosRequest;
use App\Models\Categoria;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produtos::with(['categoria'])->orderBy('nome', 'asc')->paginate(3);
        return view('produtos.index')->with('produtos', $produtos);
    }

    public function show(Produtos $produto)
    {
        return view('produtos.show')->with('produto', $produto);
    }

    public function create()
    {
        $categorias = DB::table('categorias')->get();
        return view('produtos.create')->with(['categorias' => $categorias]);
    }

    public function store(ProdutosRequest $request, Produtos $produtos)
    {
            
        $caminhoArquivo = $request->file('cover')->store('produtos_cover', 'public');
        $request->cover = $caminhoArquivo;
        
        $produtos = Produtos::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'descricao' => $request->descricao,
            'cover' => $request->cover,
            'categoria_id' => $request->categoria_id
        ]);

        return to_route('produtos.index')->with('mensagem.sucesso', 'produto criado com sucesso');
    }

    public function edit(Produtos $produto)
    {
        // dd($produto)
        return view('produtos.edit')->with('produto', $produto);
    }

    public function update(Produtos $produto, Request $request)
    {
        Produtos::where('id', $produto->id)
            ->update([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'descricao' => $request->descricao
        ]);
        return to_route('produtos.index');
    }

    public function destroy(Produtos $produto)
    {
        $produto->delete();
        return to_route('produtos.index');
    }

    public function buscar()
    {
        $req = Request();
        $nome = $req->input('nome');
        $nome = ucwords($nome);

        $produto = Produtos::where('nome', $nome)->first();
        
        if($produto != null) {
            return view('produtos.show')->with('produto', $produto);
        }
        else {
            return to_route('home.index');
        }

    }
}