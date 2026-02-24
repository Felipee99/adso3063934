@extends('layouts.dashboard')
@section('title', 'dashboard ADMIN: Larapets')

@section('content')

<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
  <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="currentColor" viewBox="0 0 256 256">
    <path d="M224,40V216a8,8,0,0,1-16,0V40a8,8,0,0,1,16,0ZM192,64v40a16,16,0,0,1-16,16H80a16,16,0,0,1-16-16V64A16,16,0,0,1,80,48h96A16,16,0,0,1,192,64Zm-16,0H80v40h96Zm16,88v40a16,16,0,0,1-16,16H40a16,16,0,0,1-16-16V152a16,16,0,0,1,16-16H176A16,16,0,0,1,192,152Zm-16,0H40v40H176Z"></path>
  </svg>
  Dashboard
</h1>

<!-- Cards -->
<div class="flex flex-wrap gap-4 items-center justify-center">
  @if(Auth::user()->role == 'administrator')
  {{-- module user --}}
  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img class="w-full h-full object-cover" src="images/1.png" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">Module Users</h2>
      {{-- stats --}}
      <ul class="list bg-[#0003] rounded-box shadow-md">

        <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Statistics:</li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Total users:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\User::count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path d="M152,80a8,8,0,0,1,8-8h88a8,8,0,0,1,0,16H160A8,8,0,0,1,152,80Zm96,40H160a8,8,0,0,0,0,16h88a8,8,0,0,0,0-16Zm0,48H184a8,8,0,0,0,0,16h64a8,8,0,0,0,0-16Zm-96.25,22a8,8,0,0,1-5.76,9.74,7.55,7.55,0,0,1-2,.26,8,8,0,0,1-7.75-6c-6.16-23.94-30.34-42-56.25-42s-50.09,18.05-56.25,42a8,8,0,0,1-15.5-4c5.59-21.71,21.84-39.29,42.46-48a48,48,0,1,1,58.58,0C129.91,150.71,146.16,168.29,151.75,190ZM80,136a32,32,0,1,0-32-32A32,32,0,0,0,80,136Z"></path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Customer:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\User::where('role', 'customer')->count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Active</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\User::where('active', 1)->count() }}
          </button>
        </li>
      </ul>
      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('users') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>

  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img class="w-full h-full object-cover" src="images/2.png" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">Module Pets</h2>
      {{-- stats --}}
      <ul class="list bg-[#0003] rounded-box shadow-md">

        <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Statistics:</li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z"></path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Total Pets:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Pet::count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path d="M239.71,125l-16.42-88a16,16,0,0,0-19.61-12.58l-.31.09L150.85,40h-45.7L52.63,24.56l-.31-.09A16,16,0,0,0,32.71,37.05L16.29,125a15.77,15.77,0,0,0,9.12,17.52A16.26,16.26,0,0,0,32.12,144,15.48,15.48,0,0,0,40,141.84V184a40,40,0,0,0,40,40h96a40,40,0,0,0,40-40V141.85a15.5,15.5,0,0,0,7.87,2.16,16.31,16.31,0,0,0,6.72-1.47A15.77,15.77,0,0,0,239.71,125ZM32,128h0L48.43,40,90.5,52.37Zm144,80H136V195.31l13.66-13.65a8,8,0,0,0-11.32-11.32L128,180.69l-10.34-10.35a8,8,0,0,0-11.32,11.32L120,195.31V208H80a24,24,0,0,1-24-24V123.11L107.92,56h40.15L200,123.11V184A24,24,0,0,1,176,208Zm48-80L165.5,52.37,207.57,40,224,128ZM104,140a12,12,0,1,1-12-12A12,12,0,0,1,104,140Zm72,0a12,12,0,1,1-12-12A12,12,0,0,1,176,140Z"></path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Dogs:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Pet::where('kind', 'dog')->count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path d="M96,140a12,12,0,1,1-12-12A12,12,0,0,1,96,140Zm76-12a12,12,0,1,0,12,12A12,12,0,0,0,172,128Zm60-80v88c0,52.93-46.65,96-104,96S24,188.93,24,136V48A16,16,0,0,1,51.31,36.69c.14.14.26.27.38.41L69,57a111.22,111.22,0,0,1,118.1,0L204.31,37.1c.12-.14.24-.27.38-.41A16,16,0,0,1,232,48Zm-16,0-21.56,24.8A8,8,0,0,1,183.63,74,88.86,88.86,0,0,0,168,64.75V88a8,8,0,1,1-16,0V59.05a97.43,97.43,0,0,0-16-2.72V88a8,8,0,1,1-16,0V56.33a97.43,97.43,0,0,0-16,2.72V88a8,8,0,1,1-16,0V64.75A88.86,88.86,0,0,0,72.37,74a8,8,0,0,1-10.81-1.17L40,48v88c0,41.66,35.21,76,80,79.67V195.31l-13.66-13.66a8,8,0,0,1,11.32-11.31L128,180.68l10.34-10.34a8,8,0,0,1,11.32,11.31L136,195.31v20.36c44.79-3.69,80-38,80-79.67Z"></path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Cats:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Pet::where('kind', 'cat')->count() }}
          </button>
        </li>
      </ul>
      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('pets') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>

  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img src="images/3.png" class="w-full h-full object-cover" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">Module Adoptions</h2>
      {{-- stats --}}
      <ul class="list bg-[#0003] rounded-box shadow-md">

        <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Statistics:</li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path d="M240,184h-8V57.9l9.67-2.08a8,8,0,1,0-3.35-15.64l-224,48A8,8,0,0,0,16,104a8.16,8.16,0,0,0,1.69-.18L24,102.47V184H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM40,99,216,61.33V184H192V128a8,8,0,0,0-8-8H72a8,8,0,0,0-8,8v56H40Zm136,53H80V136h96ZM80,168h96v16H80Z"></path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Total Adoptions:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Adoption::count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path d="M128,136a8,8,0,0,1-8,8H72a8,8,0,0,1,0-16h48A8,8,0,0,1,128,136Zm-8-40H72a8,8,0,0,0,0,16h48a8,8,0,0,0,0-16Zm112,65.47V224A8,8,0,0,1,220,231l-24-13.74L172,231A8,8,0,0,1,160,224V200H40a16,16,0,0,1-16-16V56A16,16,0,0,1,40,40H216a16,16,0,0,1,16,16V86.53a51.88,51.88,0,0,1,0,74.94ZM160,184V161.47A52,52,0,0,1,216,76V56H40V184Zm56-12a51.88,51.88,0,0,1-40,0v38.22l16-9.16a8,8,0,0,1,7.94,0l16,9.16Zm16-48a36,36,0,1,0-36,36A36,36,0,0,0,232,124Z"></path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Dog Adopted:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Pet::where('status', 1)->where('kind', 'dog')->count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path d="M128,136a8,8,0,0,1-8,8H72a8,8,0,0,1,0-16h48A8,8,0,0,1,128,136Zm-8-40H72a8,8,0,0,0,0,16h48a8,8,0,0,0,0-16Zm112,65.47V224A8,8,0,0,1,220,231l-24-13.74L172,231A8,8,0,0,1,160,224V200H40a16,16,0,0,1-16-16V56A16,16,0,0,1,40,40H216a16,16,0,0,1,16,16V86.53a51.88,51.88,0,0,1,0,74.94ZM160,184V161.47A52,52,0,0,1,216,76V56H40V184Zm56-12a51.88,51.88,0,0,1-40,0v38.22l16-9.16a8,8,0,0,1,7.94,0l16,9.16Zm16-48a36,36,0,1,0-36,36A36,36,0,0,0,232,124Z"></path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Cat Adopted:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Pet::where('status', 1)->where('kind', 'cat')->count() }}
          </button>
        </li>
      </ul>
      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('adoptions') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>

  @endif
</div>
<!-- customer -->

@if(Auth::user()->role == 'Customer')

<div class="flex flex-wrap gap-6 justify-center">

  {{-- CARD 1 --}}
  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img class="w-full h-full object-cover" src="images/1.png" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">My Profile </h2>
      <ul class="list bg-[#0003] rounded-box shadow-md p-3">
      </ul>
      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('myprofile') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>

  {{-- CARD 2 --}}
  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img class="w-full h-full object-cover" src="images/2.png" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">Make Adoptions</h2>
      <ul class="list bg-[#0003] rounded-box shadow-md p-3">
      </ul>
      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('makeadoptions') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>

  {{-- CARD 3 --}}
  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img class="w-full h-full object-cover" src="images/3.png" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">My Adoptions</h2>
      <ul class="list bg-[#0003] rounded-box shadow-md p-3">
      </ul>
      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('myadoptions') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>

</div>

@endif
@if(session('error'))
<dialog id="modal_error" class="modal">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Error</h3>
    <div role="alert" class="alert alert-error alert-soft">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-6 w-6 shrink-0 stroke-current">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <span>{{ session('error') }}</span>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button id="btn_close_error">close</button>
  </form>
</dialog>
@endif

@if(session('message'))
<dialog id="modal_message" class="modal">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Congratulations!</h3>
    <div role="alert" class="alert alert-success">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span>{{ session('message') }}</span>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button id="btn_close_message">close</button>
  </form>
</dialog>
@endif
@endsection
@section('js')
<script>
  $(document).ready(function() {
    // Modal: open if session provided, but check element exists
    const modal_error = document.getElementById('modal_error');
    if (modal_error) {
      @if(session('error'))
      try { modal_error.showModal(); } catch(e) { console.warn('modal_error.showModal failed', e); }
      @endif
      // allow explicit close
      const btnCloseError = document.getElementById('btn_close_error');
      if (btnCloseError) btnCloseError.addEventListener('click', () => { try { modal_error.close(); } catch(e){} });
    }

    const modal_message = document.getElementById('modal_message');
    if (modal_message) {
      @if(session('message'))
      try { modal_message.showModal(); } catch(e) { console.warn('modal_message.showModal failed', e); }
      @endif
      const btnCloseMsg = document.getElementById('btn_close_message');
      if (btnCloseMsg) btnCloseMsg.addEventListener('click', () => { try { modal_message.close(); } catch(e){} });
    }
  });
</script>
@endsection