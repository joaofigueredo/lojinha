<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produtos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produtos = Produtos::with(['categoria'])->orderBy('id', 'desc')->take(4)->get();
        
        return view('home.index')->with('produtos', $produtos);
    }
}