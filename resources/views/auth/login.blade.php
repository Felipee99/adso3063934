@extends('layouts.home')

@section('title', 'login: Larapets 🐶')

@section('content')
    <section class=" bg-[#0006] rounded-lg w-4/16 p-6 flex flex-col gap-4 items-center justify-center">
        <h1 class="flex gap-4 justify-center items-center text-4-x1">
            <svg xmlns="http://www.w3.org/2000/svg" size-12 fill="currentColor" viewBox="0 0 256 256"><path d="M208,80H176V56a48,48,0,0,0-96,0V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80ZM96,56a32,32,0,0,1,64,0V80H96ZM208,208H48V96H208V208Zm-68-56a12,12,0,1,1-12-12A12,12,0,0,1,140,152Z"></path></svg>
            Login
        </h1>
            <div class="card w-full max-w-sm">
            <form method="POST" action="{{ route('login') }}" class="card-body">
                @csrf
                <label class="label">Email:</label>
                <input type="text" class="input bg-[#0006]" name="email" placeholder="Email" value="{{ old('email') }}" />
                @error('email')
                    <small class="badge badge-error w-full mt-1 py-6">{{ $message }}</small>
                @enderror

                <label class="label">Password</label>
                <input type="password" class="input bg-[#0006]" name=password placeholder="Password" />
                @error('password')
                    <small class="badge badge-error w-full mt-1 py-6">{{ $message }}</small>
                @enderror

                <button class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-4">Login</button>

                <p class="text-sm text-center mt-4">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="link link-default">
                        Sign up
                    </a>
                </p>

                 <p class="text-sm text-center mt-2">
                    <a  class="link link-default" href="{{ route('password.request') }}">
                        forgot your password?
                    </a>
                </p>
            </form>
        </div>
    </section>
@endsection
    