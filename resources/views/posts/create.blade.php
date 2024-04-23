@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('title')
    Crea una nueva Publicacion
@endsection

@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form 
                action="{{ route('images.store') }}" 
                method="POST"
                enctype="multipart/form-data"
                id="dropzone" 
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-lg mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">Title</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        placeholder="title"
                        class="border p-3 w-full rounded-lg @error('title') border-red-500 @enderror"
                        value="{{ old('title') }}"
                    />
                    @error('title')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">Description</label>
                    <textarea 
                        type="text" 
                        id="description" 
                        name="description" 
                        placeholder="description"
                        class="border p-3 w-full rounded-lg @error('description') border-red-500 @enderror"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input 
                        id="hdn_image"
                        name="image"
                        type="hidden"
                        value="{{old('image')}}"
                    >
                    @error('image')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <input 
                    type="submit"
                    value="Post"
                    class="bg-purple-600 hover:bg-purple-700 transition-colors cursor-pointer rounded-lg uppercase font-bold w-full p-3 text-white"
                />
            </form>
        </div>
    </div>
@endsection