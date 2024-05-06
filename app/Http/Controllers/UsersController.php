<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        if($request->usuario == 'client'){
            $data['client'] = true;
            $data['admin'] = false;
        }
        else{
            $data['client'] = false;
            $data['admin'] = true;
        }
        // dd($data);
        $data['password'] = Hash::make($data['password']);

        $user = User::create([
            'name' => $data['name'],
            'email' =>  $data['email'],
            'password' => $data['password'],
            'client' => $data['client'],
            'admin' => $data['admin']
        ]);
        Auth::login($user);

        return to_route('produtos.index');
    }
}
