<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.index');
    }

    public function store(Request $req) {
        //Modificar el request
        $req->request->add(['username' => Str::slug($req->username)]);
        
        $req->validate([
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:edit-profile']
        ]);

        if ($req->image) {
            $image = $req->file('image');

            $fileName = Str::uuid() . "." . $image->extension();

            $fileServer = Image::make($image);
            $fileServer->fit(1000, 1000);

            $filePath = public_path('profiles') . '/' . $fileName;

            $fileServer->save($filePath);
        }

        $user = User::find(auth()->user()->id);
        $user->username = $req->username;
        $user->image = $fileName ?? auth()->user()->image ?? null;
        $user->save();

        return redirect()->route('posts.index', $user->username);
    }
}
