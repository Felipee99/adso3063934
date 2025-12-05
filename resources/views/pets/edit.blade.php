@extends('layouts.dashboard')

@section('title', 'Edit Pet: Larapets 🐾')

@section('content')
<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutra-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="currentColor" viewBox="0 0 256 256">
        <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63Z"></path>
    </svg>
    Edit Pet
</h1>

{{-- Breadcrumbs --}}
<div class="breadcrumbs text-sm text-white bg-[#0009] rounded-box px-4 py-2">
    <ul>
        <li>
            <a href="{{ url('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Z"></path>
                </svg>
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ url('pets') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M208,96a32,32,0,1,1-32-32A32,32,0,0,1,208,96Z"></path>
                </svg>
                Pets Module
            </a>
        </li>

        <li>
            <span class="inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor"
                     viewBox="0 0 256 256">
                    <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63Z"></path>
                </svg>
                Edit Pet
            </span>
        </li>
    </ul>
</div>

{{-- Form --}}
<div class="w-full md:w-[720px] w-[320px]">
    <form method="POST" action="{{ url('pets/' . $pet->id) }}"
          class="flex flex-col md:flex-row gap-4 mt-4"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- PHOTO --}}
        <div class="w-full md:w-[320px]">
            <div class="avatar flex flex-col cursor-pointer gap-1 hover:scale-110 transition ease-in justify-center items-center">
                <div id="upload" class="mask mask-squircle w-48">
                    <img id="preview" src="{{ asset('image/' . $pet->image) }}" alt="Pet Photo">
                </div>
                <small class="pb-0 border-white border-b flex text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="#fff" viewBox="0 0 256 256">
                        <path d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32Z"></path>
                    </svg>
                    Upload Photo
                </small>
                @error('image')
                <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                @enderror
            </div>

            <input type="file" id="image" name="image" class="hidden" accept="image/*">
            <input type="hidden" name="origin_image" value="{{ $pet->image }}">
        </div>

        {{-- COLUMN 1 --}}
        <div class="w-full md:w-[320px]">
            <label class="label text-white">Name</label>
            <input type="text" class="input bg-[#fff]" name="name"
                   value="{{ old('name', $pet->name) }}" />
            @error('name')
            <small class="badge badge-error w-full text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Kind</label>
            <input type="text" class="input bg-[#fff]" name="kind"
                   value="{{ old('kind', $pet->kind) }}" />
            @error('kind')
            <small class="badge badge-error w-full text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Breed</label>
            <input type="text" class="input bg-[#fff]" name="breed"
                   value="{{ old('breed', $pet->breed) }}" />
            @error('breed')
            <small class="badge badge-error w-full text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Location</label>
            <input type="text" class="input bg-[#fff]" name="location"
                   value="{{ old('location', $pet->location) }}" />
            @error('location')
            <small class="badge badge-error w-full text-xs py-4">{{ $message }}</small>
            @enderror
        </div>

        {{-- COLUMN 2 --}}
        <div class="w-full md:w-[320px]">

            <label class="label text-white">Age</label>
            <input type="number" class="input bg-[#fff]" name="age"
                   value="{{ old('age', $pet->age) }}" />
            @error('age')
            <small class="badge badge-error w-full text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Weight (kg)</label>
            <input type="number" class="input bg-[#fff]" name="weight"
                   value="{{ old('weight', $pet->weight) }}" />
            @error('weight')
            <small class="badge badge-error w-full text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Status</label>
            <select name="status" class="select bg-[#fff]">
                <option value="">Select...</option>
                <option value="0" @selected(old('status', $pet->status) == 'available')>Available</option>
                <option value="1" @selected(old('status', $pet->status) == 'adopted')>Adopted</option>
            </select>
            @error('status')
            <small class="badge badge-error w-full text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Active</label>      
            <select name="active" class="select bg-[#fff]">
                <option value="1" @selected(old('active', $pet->active) == 1)>Active</option>
                <option value="0" @selected(old('active', $pet->active) == 0)>Inactive</option>
            </select>

            <label class="label text-white mt-2">Description</label>
            <textarea class="textarea bg-[#fff]" name="description">{{ old('description', $pet->description) }}</textarea>

            <button class="btn btn-outline btn-success hover:text-white mt-4 w-full">
                Update Pet
            </button>
        </div>

    </form>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#upload').click(function () {
            $('#image').click();
        });

        $('#image').change(function () {
            $('#preview').attr('src', window.URL.createObjectURL(this.files[0]));
        });
    });
</script>
@endsection
