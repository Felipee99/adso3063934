@extends('layouts.dashboard')

@section('title', 'My profile: Larapets 🙀')

@section('content')
<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutra-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="currentColor" viewBox="0 0 256 256">
        <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
    </svg>
    My profile
</h1>
{{-- Breadcrumbs --}}
<div class="breadcrumbs text-sm text-white bg-[#0009] rounded-box px-4 py-2">
    <ul>
        <li>
            <a href="{{ url('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z">
                    </path>
                </svg>
                Dashboard
            </a>
        </li>
        <li>
            <span class="inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
                </svg>
                My profile
            </span>
        </li>
    </ul>
</div>
<div class="w-full md:w-[720px] w-[320px]">
    <form method="POST" action="{{ url('myprofile/'.$user->id) }}" class="flex flex-col md:flex-row gap-4 mt-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="w-full md:w-[320px]">
            <div class="avatar flex flex-col cursor-pointer gap-1 hover:scale-110 transition ease-in justify-center items-center">
                <div id="upload" class="mask mask-squircle w-48">
                    <img id="preview" src="{{ asset('images/'.$user->photo) }}" />
                </div>
                <small class="pb-0 border-white border-b flex text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="#fff" viewBox="0 0 256 256">
                        <path d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32Zm0,176H48V48H208ZM90.34,125.66a8,8,0,0,1,0-11.32l32-32a8,8,0,0,1,11.32,0l32,32a8,8,0,0,1-11.32,11.32L136,107.31V168a8,8,0,0,1-16,0V107.31l-18.34,18.35A8,8,0,0,1,90.34,125.66Z"></path>
                    </svg>
                    Upload Photo
                </small>
                @error('photo')
                <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                @enderror
            </div>
            <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
            <input type="hidden" name="originphoto" value="{{ $user->photo }}">
        </div>
        <div class="w-full md:w-[320px]">
            {{-- Document --}}
            <label class="label text-white">Document</label>
            <input type="number" class="input bg-[#fff]" name="document" placeholder="123456789"
                value="{{ old('document', $user->document) }}" />
            @error('document')
            <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            {{-- Fullname --}}
            <label class="label text-white">Full Name</label>
            <input type="text" class="input bg-[#fff]" name="fullname" placeholder="Jeremias Springfield"
                value="{{ old('fullname', $user->fullname) }}" />
            @error('fullname')
            <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            {{-- Gender --}}
            <label class="label text-white">Gender</label>
            <select name="gender" class="select bg-[#fff] outline-0">
                <option value="">Select...</option>
                <option value="Female" @if (old('gender', $user->gender) == 'Female') selected @endif>Female</option>
                <option value="Male" @if (old('gender', $user->gender) == 'Male') selected @endif>Male</option>
            </select>
            @error('gender')
            <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
            @enderror


        </div>

        <div class="w-full md:w-[320px]">
            {{-- phone --}}
            <label class="label text-white">Phone</label>
            <input type="number" class="input bg-[#fff]" name="phone" placeholder="3204456321"
                value="{{ old('phone', $user->phone) }}" />
            @error('phone')
            <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Email</label>
            <input type="text" class="input bg-[#fff]" name="email" placeholder="Email" value="{{ old('email', $user->email) }}" />
            @error('email')
            <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
            @enderror
            {{-- Birthdate --}}
            <label class="label text-white">Birthdate</label>
            <input type="date" class="input bg-[#fff]" name="birthdate" placeholder="1983-06-16"
                value="{{ old('birthdate', $user->birthdate) }}" />
            @error('birthdate')
            <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
            @enderror
            <button class="btn btn-outline btn-success hover:text-white mt-4 w-full">Edit</button>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#upload').click(function(e) {
            e.preventDefault();
            $('#photo').click();
        });

        $('#photo').change(function(e) {
            e.preventDefault();
            $('#preview').attr('src', window.URL.createObjectURL($(this).prop('files')[0]));
        });
    });
</script>
@endsection