@extends('layouts.app')

@section('title')
    Login in DevStagram
@endsection

@section('content')
    <div class="md:flex justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Login image">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form method="POST" action="{{route('login')}}" novalidate>
                @csrf
                @if (session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('message')}}</p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email"
                        placeholder="email@email.com"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        placeholder="*******"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember"> <label for="remember" class="text-sm inline-block text-gray-500">Keeping the session open</label>
                </div>

                <input 
                    type="submit"
                    value="Login"
                    class="bg-purple-600 hover:bg-purple-700 transition-colors cursor-pointer rounded-lg uppercase font-bold w-full p-3 text-white"
                />
            </form>
        </div>
    </div>
@endsection