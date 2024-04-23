<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function store(Request $req) {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($req->only('email', 'password'), $req->remember)) {
            return back()->with('message', 'Incorrect credencials');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
