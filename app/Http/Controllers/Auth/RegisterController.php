<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    //
    public function index() {
        return view('auth.register');
    }

    //
    public function store(Request $req) {

        //Modificar el request
        $req->request->add(['username' => Str::slug($req->username)]);

        // Validacion
        $req->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:8'
        ]);

        User::create([
            'name' => $req->name,
            'username' => $req->username,
            'email' => $req->email,
            'password' => $req->password
        ]);

        // Autenticar usuario
        // auth()->attempt([
        //     'email' => $req->email,
        //     'password' => $req->password
        // ]);

        // Otra forma de autenticar
        auth()->attempt($req->only('email', 'password'));

        // Redireccionar
        return redirect()->route('posts.index');
    }
}
