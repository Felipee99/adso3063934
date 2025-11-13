@extends('layouts.dashboard')
@section('title', 'dashboard ADMIN: Larapets')

@section('content')

    <h1>Dashboard</h1>
    <h2>{{ Auth::user()->fullname }}</h2>
    <h3>You're logged in!</h3>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="route('logout')" onclick="event.preventDefault();
                                            this.closest('form').submit();">
            Log out
        </a>
    </form>
   
@endsection