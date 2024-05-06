<?php

namespace App\Http\Controllers;

use App\Models\CupomDesconto as ModelsCupomDesconto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CupomDesconto extends Controller
{
    public function index()
    {
        $cupomDescontos = DB::table('cupom_descontos')->get();
        return view('cupom.index')->with('cupomDescontos', $cupomDescontos);
    }

    public function create()
    {
        return view('cupom.create');
    }

    public function store(Request $request)
    {
        ModelsCupomDesconto::create([
            'nome' => $request->nome,
            'localizador' => $request->localizador,
            'desconto' => $request->desconto,
            'modo_desconto' => $request->modo_desconto,
            'limite' => $request->limite,
            'modo_limite' => $request->modo_limite,
            'dthr_validade' => $request->dthr_validade,
            'ativo' => $request->ativo
        ]);

        return to_route('cupom.index');
    }

    public function edit(ModelsCupomDesconto $cupom)
    {
        return view('cupom.edit')->with('cupom', $cupom);
    }

    public function update(ModelsCupomDesconto $cupom, Request $request)
    {
        ModelsCupomDesconto::where('id', $cupom->id)
        ->update([
            'nome' => $request->nome,
            'desconto' => $request->desconto,
            'modo_desconto' => $request->modo_desconto,
            'limite' => $request->limite,
            'modo_limite' => $request->modo_limite,
            'dthr_validade' => $request->dthr_validade,
            'ativo' => $request->ativo
        ]);

        return to_route('cupom.index');
    }

    public function destroy(ModelsCupomDesconto $cupom)
    {
        $cupom->delete();
        return to_route('cupom.index');
    }
}