@extends('layouts.dashboard')

@section('title', 'Add Pet: Larapets 🐾')

@section('content')
    <h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutra-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path
                d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z">
            </path>
        </svg>
        Add Pet
    </h1>

    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm text-white bg-[#0009] rounded-box px-4 py-2">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ url('pets') }}">Pets Module</a>
            </li>
            <li>
                <span class="inline-flex items-center gap-2">Add Pet</span>
            </li>
        </ul>
    </div>

    <div class="w-full md:w-[720px]">
        <form method="POST" action="{{ url('pets') }}" class="flex flex-col md:flex-row gap-4 mt-4" enctype="multipart/form-data">
            @csrf

            {{-- IMAGE --}}
            <div class="w-full md:w-[320px]">
                <div class="avatar flex flex-col cursor-pointer gap-1 hover:scale-110 transition ease-in justify-center items-center">
                    <div id="upload" class="mask mask-squircle w-48">
                        <img id="preview" src="{{ asset('image/pet.png') }}" />
                    </div>
                    <small class="pb-0 border-white border-b flex text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="#fff" viewBox="0 0 256 256">
                            <path d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32Zm0,176H48V48H208ZM90.34,125.66a8,8,0,0,1,0-11.32l32-32a8,8,0,0,1,11.32,0l32,32a8,8,0,0,1-11.32,11.32L136,107.31V168a8,8,0,0,1-16,0V107.31l-18.34,18.35A8,8,0,0,1,90.34,125.66Z"></path>
                        </svg>
                        Upload Pet Photo
                    </small>
                    @error('image')
                    <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                </div>
                <input type="file" id="image" name="image" class="hidden" accept="image/*">
            </div>

            {{-- LEFT COLUMN --}}
            <div class="w-full md:w-[320px]">

                <label class="label text-white">Pet Name</label>
                <input type="text" class="input bg-[#fff]" name="name" placeholder="Milo"
                       value="{{ old('name') }}" />
                @error('name')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                <label class="label text-white">Kind</label>
                <select name="kind" class="select bg-[#fff] outline-0">
                    <option value="">Select...</option>
                    <option value="cat" @if(old('kind')=='cat') selected @endif>Cat</option>
                    <option value="dog" @if(old('kind')=='dog') selected @endif>Dog</option>
                    <option value="dog" @if(old('kind')=='bird') selected @endif>bird</option>
                    <option value="dog" @if(old('kind')=='rabbit') selected @endif>rabbit</option>
                </select>
                @error('kind')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                <label class="label text-white">Weight (kg)</label>
                <input type="number" step="0.1" class="input bg-[#fff]" name="weight"
                       value="{{ old('weight') }}" placeholder="3.5" />
                @error('weight')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                <label class="label text-white">Age</label>
                <input type="number" class="input bg-[#fff]" name="age"
                       value="{{ old('age') }}" placeholder="2" />
                @error('age')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="w-full md:w-[320px]">

                <label class="label text-white">Breed</label>
                <input type="text" class="input bg-[#fff]" name="breed"
                       value="{{ old('breed') }}" placeholder="Siamese" />
                @error('breed')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                <label class="label text-white">Location</label>
                <input type="text" class="input bg-[#fff]" name="location"
                       value="{{ old('location') }}" placeholder="Shelter A - Room 2" />
                @error('location')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                <label class="label text-white">Status</label>
                <select name="status" class="select bg-[#fff] outline-0">
                    <option value="0" @if(old('status')=='0') selected @endif>Available</option>
                    <option value="1" @if(old('status')=='1') selected @endif>Adopted</option>
                </select>
                @error('status')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                <label class="label text-white">Active</label>
                <select name="active" class="select bg-[#fff] outline-0">
                    <option value="1" @if(old('active')=='1') selected @endif>Active</option>
                    <option value="0" @if(old('active')=='0') selected @endif>Inactive</option>
                </select>

                <label class="label text-white mt-2">Description</label>
                <textarea name="description" class="textarea bg-[#fff]">{{ old('description') }}</textarea>

                <button class="btn btn-outline btn-success hover:text-white mt-4 w-full">Add Pet</button>
            </div>

        </form>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#upload').click(function(e) {
            e.preventDefault();
            $('#image').click();
        });

        $('#image').change(function(e) {
            e.preventDefault();
            $('#preview').attr('src', window.URL.createObjectURL($(this).prop('files')[0]));
        });
    });
</script>
@endsection
