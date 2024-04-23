<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $req, User $user, Post $post) {
        $req->validate([
            'comment' => 'required|max:255'
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comment' => $req->comment
        ]);

        return back()->with('msg', 'Comentario realizaco con exito');
    }
}
