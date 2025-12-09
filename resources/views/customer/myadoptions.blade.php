@extends('layouts.dashboard')

@section('title', 'Module Adoptions: Larapets 🐶')

@section('content')

<h1 class="text-4x1 text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
        <path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z"></path>
    </svg>
    Module Adoptions
</h1>
</div>
{{-- Options --}}
<label class="input text-white bg-[#0009] outline-none mb-10">
    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <g
            stroke-linejoin="round"
            stroke-linecap="round"
            stroke-width="2.5"
            fill="none"
            stroke="currentColor">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.3-4.3"></path>
        </g>
    </svg>
    <input type="search" required placeholder="Search" name="qsearch" id="qsearch" />
</label>

<!-- CSRF token for AJAX search -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">

@csrf

<div class="datalist flex flex-col gap-10">

    @forelse($adopts as $adopt)
    <div class="avatar-group mt-8 -space-x-6">
        <div class="avatar">
            <div class="w-36">
                <img src="{{ asset('images/' . $adopt->user->photo) }}" />
            </div>
        </div>
        <div class="avatar">
            <div class="w-36">
                <img src="{{ asset('image/' . ($adopt->pet->image )) }}" />
            </div>
        </div>
    </div>
    <h4 class="text-white">
        <span class="underline font-bold">{{ $adopt->pet->name }}</span>
        was adopted by
        <span class="underline font-bold">{{ $adopt->user->fullname }}</span>
    {{ optional($adopt->created_at)->diffForHumans() ?? '' }}
    </h4>
    <a href="{{ url('showadoptions/'.$adopt->id) }}" class="btn btn outline text-black hover:bg-[#0009] hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"></path>
        </svg>
        Show more
    </a>

    <span class="border-b-1 border-dashed mt-2 border-[#fff6] h-2 w12/12"></span>
    @empty
        <p class="text-lg font-semibold">You have not made any adoptions yet.</p>
    @endforelse
</div>

@endsection