@extends('layouts.app')

@section('title')
    {{$post->title}}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{asset('uploads') . '/' . $post->image}}" alt="Post image {{ $post->title }}">
            <div class="p-3 flex items-center gap-3">
                @auth
                    <livewire:like-post :post="$post">
                @endauth
            </div>
            <div>
                <p class="font-bold">{{$post->user->username}}</p>
                <p class="text-sm text-gray-500">
                    {{$post->created_at->diffForHumans()}}
                </p>
                <p class="mt-5">
                    {{$post->description}}
                </p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @method('DELETE')
                        @csrf
                        <input 
                        type="submit"
                        value="Delete Post"
                        class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"    
                        />
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                <p class="text-xl font-bold text-center mb-4">Comments</p>
                @if (session('msg'))
                    <div class="bg-green-500 p-2 rounded mb-6 text-white text-center uppercase font-bold">{{session('msg')}}</div>
                @endif
                <form action="{{route('comments.store', ['post' => $post, 'user' => $user])}}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">Comment</label>
                        <textarea 
                            type="text" 
                            id="comment" 
                            name="comment" 
                            placeholder="Add comment"
                            class="border p-3 w-full rounded-lg @error('comment') border-red-500 @enderror"
                        >{{ old('comment') }}</textarea>
                        @error('comment')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                        @enderror
                    </div>

                    <input 
                        type="submit"
                        value="Comment"
                        class="bg-purple-600 hover:bg-purple-700 transition-colors cursor-pointer rounded-lg uppercase font-bold w-full p-3 text-white"
                    />
                </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll">
                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{route('posts.index', $comment->user)}}" class="font-bold">
                                    {{$comment->user->username}}
                                </a>
                                <p>{{$comment->comment}}</p>
                                <p class="text-sm text-gray-500">{{$comment->created_at->diffForHumans()}}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection