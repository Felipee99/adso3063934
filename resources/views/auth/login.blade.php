{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('layouts.home')

@section('title', 'login: Larapets 🐶')

@section('content')
    <section class=" bg-[#0006] rounded-lg w-70 p-6 flex flex-col gap-4 items-center justify-center">
        <h1 class="flex gap-4 justify-center items-center text-4-x1">
            <svg xmlns="http://www.w3.org/2000/svg" size-12 fill="currentColor" viewBox="0 0 256 256"><path d="M208,80H176V56a48,48,0,0,0-96,0V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80ZM96,56a32,32,0,0,1,64,0V80H96ZM208,208H48V96H208V208Zm-68-56a12,12,0,1,1-12-12A12,12,0,0,1,140,152Z"></path></svg>
            Login
        </h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="card w-full max-w-sm">
            <form method="POST" action="{{ route('login') }}" class="card-body">
                @csrf
                <label class="label">Email:</label>
                <input type="text" class="input bg-[#0006]" name="email" placeholder="Email" value="{{ old('email') }}" />
                @error('email')
                    <small class="text-error text-sm mt-1">{{ $message }}</small>
                @enderror

                <label class="label">Password</label>
                <input type="password" class="input bg-[#0006]" name=password placeholder="Password" />
                @error('password')
                    <small class="text-error text-sm mt-1">{{ $message }}</small>
                @enderror

                <button class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-4">Login</button>

                <p class="text-sm text-center mt-4">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="link link-default">
                        Sign up
                    </a>
                </p>
            </form>
        </div>
        </form>
        
    </section>
@endsection
    