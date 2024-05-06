<?php

namespace App\Http\Controllers;

use GuzzleHttp\RetryMiddleware;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {
        $login = $request->only(['email', 'password']);
        
        if(!Auth::attempt($login)) {
            return to_route('login')->withErrors(['Usuário ou senha inválido!']);
        }

        return to_route('produtos.index');
    }
    public function destroy()
    {
            Auth::logout();
    
            return to_route('login');
    }
}