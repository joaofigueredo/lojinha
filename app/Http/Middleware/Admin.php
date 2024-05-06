<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() and (auth()->user()->admin)) {
            return $next($request);
        }elseif(Auth::check() and (auth()->user()->client)){
            return to_route('produtos.index');
        }
        throw new AuthenticationException();
        
    }
}