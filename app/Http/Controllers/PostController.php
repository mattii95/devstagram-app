<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    public function index(User $user) {

        $posts = Post::where('user_id', $user->id)->paginate(20);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create() {
        return view('posts.create');
    }
    
    public function store(Request $req) {
        $req->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required'
        ]);

        // Post::create([
        //     'title' => $req->title,
        //     'description' => $req->description,
        //     'image' => $req->image,
        //     'user_id' => auth()->user()->id,
        // ]);

        // $post = new Post;
        // $post->title = $req->title;
        // $post->description = $req->description;
        // $post->image = $req->image;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        $req->user()->posts()->create([
            'title' => $req->title,
            'description' => $req->description,
            'image' => $req->image,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post) {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post) {
        if (!Gate::allows('delete', $post)) {
            abort(403);
        }

        // Eliminar la imagen
        $pathImage = public_path('uploads/' . $post->image);

        if (File::exists($pathImage)) {
            unlink($pathImage);
        }

        $post->delete();

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
