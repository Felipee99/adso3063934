@extends('layouts.dashboard')

@section('title', 'Show Pet: Larapets 🐾')

@section('content')
<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutra-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
        <path d="M176,128a48,48,0,1,1-48-48A48.05,48.05,0,0,1,176,128Zm48-88H176l-16-32H96L80,40H32A16,16,0,0,0,16,56V200a16,16,0,0,0,16,16H224a16,16,0,0,0,16-16V56A16,16,0,0,0,224,40Z"/>
    </svg>
    Show Pet
</h1>

{{-- Breadcrumbs --}}
<div class="breadcrumbs text-sm text-white bg-[#0009] rounded-box px-4 py-2">
    <ul>
        <li>
            <a href="{{ url('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Z"/>
                </svg>
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ url('pets') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M208,96a32,32,0,1,1-32-32A32,32,0,0,1,208,96Z"/>
                </svg>
                Pets Module
            </a>
        </li>

        <li>
            <span class="inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor"
                     viewBox="0 0 256 256">
                    <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/>
                </svg>
                Show Pet
            </span>
        </li>
    </ul>
</div>

{{-- Card --}}
<div class="bg-[#0009] p-10 rounded-sm">

    {{-- Pet Image --}}
    <div class="avatar flex flex-col cursor-pointer gap-1 hover:scale-110 transition ease-in justify-center items-center">
        <div class="mask mask-squircle w-60">
            <img src="{{ asset('image/' . $pet->image) }}" alt="Pet image"/>
        </div>
    </div>

    {{-- Data --}}
    <div class="flex gap-2 flex-col md:flex-row">

        {{-- Column 1 --}}
        <ul class="list bg-[#0009] mt-4 text-white rounded-box shadow-md">
            <li class="list-row">
                <span class="font-semibold">ID</span>
                <span class="text-[#fff9]">{{ $pet->id }}</span>
            </li>

            <li class="list-row">
                <span class="font-semibold">Name</span>
                <span class="text-[#fff9]">{{ $pet->name }}</span>
            </li>

            <li class="list-row">
                <span class="font-semibold">Kind</span>
                <span class="text-[#fff9]">{{ $pet->kind }}</span>
            </li>

            <li class="list-row">
                <span class="font-semibold">Age</span>
                <span class="text-[#fff9]">{{ $pet->age }} years</span>
            </li>

            <li class="list-row">
                <span class="font-semibold">Weight</span>
                <span class="text-[#fff9]">{{ $pet->weight }} kg</span>
            </li>
        </ul>

        {{-- Column 2 --}}
        <ul class="list bg-[#0009] mt-4 text-white rounded-box shadow-md">
            <li class="list-row">
                <span class="font-semibold">Breed</span>
                <span class="text-[#fff9]">{{ $pet->breed }}</span>
            </li>
            <ul class="list bg-[#0009] mt-4 text-white rounded-box shadow-md">
            <li class="list-row">
                <span class="font-semibold">Location</span>
                <span class="text-[#fff9]">{{ $pet->location }}</span>
            </li>

            <li class="list-row">
                <span class="font-semibold">Description</span>
                <span class="text-[#fff9]">{{ $pet->description }}</span>
            </li>

            <li class="list-row">
                <span class="font-semibold">Active</span>
                <span class="text-[#fff9]">
                    @if ($pet->active == 1)
                        <div class="badge badge-outline badge-success">Active</div>
                    @else
                        <div class="badge badge-outline badge-error">Inactive</div>
                    @endif
                </span>
            </li>

            <li class="list-row">
                <span class="font-semibold">Status</span>
                <span class="text-[#fff9]">
                    <div class="badge badge-outline">
                        {{ $pet->status }}
                    </div>
                </span>
            </li>

            <li class="list-row">
                <span class="font-semibold">Created At</span>
                <span class="text-[#fff9]">{{ $pet->created_at }}</span>
            </li>
        </ul>
    </div>

</div>
@endsection
