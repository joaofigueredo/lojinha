<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoriasController extends Controller
{
    public function index(Request $request)
    {
        $categorias = DB::table('categorias')->get();
        return view('categorias.index')->with('categorias', $categorias);
    }
    public function create()
    {
        return view('categorias.create');
    }
    public function store(CategoriaRequest $request)
    {
        //dd($request->nome);
        $categoria = new Categoria();
        $categoria->nome = $request->nome;
        $categoria->save(); 
        
        return to_route('categorias.index')->with('mensagem.sucesso', "Categória '{$categoria->nome}' criada");
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit')->with('categoria', $categoria);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $categoria->fill($request->all());
        $categoria->save();

        return to_route('categorias.index');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return to_route('categorias.index');
    }

    public function show(Categoria $categoria)
    {
        $categoria = Categoria::with('produtos')->where('id', $categoria->id)->first();
        
        return view('categorias.show')->with('categoria', $categoria);
    }
}