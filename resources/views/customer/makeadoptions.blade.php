@extends('layouts.dashboard')

@section('title', 'Module Pets: Larapets 🐶')

@section('content')

<h1 class="text-4x1 text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
        <path d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"></path>
    </svg>
    Module Pets
</h1>

{{-- Search --}}
<label class="input text-white bg-[#0009] outline-none mb-10">
    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.3-4.3"></path>
        </g>
    </svg>
    <input type="search" required placeholder="Search" name="qsearch" id="qsearch" />
</label>

<div class="overflow-x-auto text-white rounded-box bg-[#fff9]">
    <table class="table bg-[#0009]">
        <thead class="text-white bg-[#000]">
            <tr>
                <th class="hidden md:table-cell">Id</th>
                <th>Photo</th>
                <th>Name</th>
                <th class="hidden md:table-cell">Kind</th>
                <th class="hidden md:table-cell">Breed</th>
                <th class="hidden md:table-cell">Age</th>
                <th class="hidden md:table-cell">Weight</th>
                <th class="hidden md:table-cell">Active</th>
                <th class="hidden md:table-cell">Actions</th>
            </tr>
        </thead>
        <tbody class="datalist">
            @foreach ($pets as $pet)
            <tr @if ($pet->id % 2 == 0) class="bg-[#0006]"@endif>
                <th class="hidden md:table-cell">{{ $pet->id }}</th>
                <td>
                    <div class="avatar">
                        <div class="rounded-full w-16">
                            <img src="{{ asset('image/' . $pet->image) }}" />
                        </div>
                    </div>
                </td>
                <td>{{ $pet->name }}</td>
                <td class="hidden md:table-cell">{{ $pet->kind }}</td>
                <td class="hidden md:table-cell">{{ $pet->breed }}</td>
                <td class="hidden md:table-cell">{{ $pet->age }}</td>
                <td class="hidden md:table-cell">{{ $pet->weight }}</td>
                <td class="hidden md:table-cell">
                    @if ($pet->active == 1)
                    <div class="badge badge-outline badge-success">Active</div>
                    @else
                    <div class="badge badge-outline badge-error">Inactive</div>
                    @endif
                </td>
                <td>
                    <a class="btn btn-outline btn-xs" href="{{ url('makeadoptions/' . $pet->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="#ffffffff" viewBox="0 0 256 256"><path d="M223,57a58.07,58.07,0,0,0-81.92-.1L128,69.05,114.91,56.86A58,58,0,0,0,33,139l89.35,90.66a8,8,0,0,0,11.4,0L223,139a58,58,0,0,0,0-82Zm-11.35,70.76L128,212.6,44.3,127.68a42,42,0,0,1,59.4-59.4l.2.2,18.65,17.35a8,8,0,0,0,10.9,0L152.1,68.48l.2-.2a42,42,0,1,1,59.36,59.44Z"></path></svg>
                    </a>
                </td>
            </tr>
            @endforeach
            <tr class="bg-[#0009]">
                <td colspan="9">{{ $pets->links('layouts.pagination') }}</td>
            </tr>
        </tbody>
    </table>
</div>

{{-- Modal --}}
<dialog id="modal_message" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Congratulations!</h3>
        <div role="alert" class="alert alert-success">
            <span>{{ session('message') }}</span>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<dialog id="modal_delete" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Are you sure!</h3>
        <div role="alert" class="alert alert-error alert-soft">
            <span>You want to delete: <strong class="pet-name"></strong></span>
        </div>
        <div>
            <button class="btn btn-default btn-sm btn-confirm">Confirm</button>
            <button class="btn btn-default btn-sm">Cancel</button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>cancel</button>
    </form>
</dialog>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        //Modal
        const modal_message = document.getElementById('modal_message');
        @if(session('message'))
        try { modal_message.showModal(); } catch(e){}
        @endif
        // Search
        function debounce(func, wait) {
            let timeout
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout)
                    func(...args)
                };
                clearTimeout(timeout)
                timeout = setTimeout(later, wait)
            }
        }
        const search = debounce(function(query) {

            $token = $('meta[name=csrf-token]').attr('content')

            $.post("{{ url('search/makeadoptions') }}", {
                    'qsearch': query,
                    '_token': $token
                },
                function(data) {
                    $('.datalist').html(data).hide().fadeIn(1000)
                }
            )
        }, 500)
        $('body').on('input', '#qsearch', function(event) {
            event.preventDefault()
            const query = $(this).val()

            $('.datalist').html(`<tr>
                                        <td colspan="9" class="text-center py-18">
                                            <span class="loading loading-spinner text-warning"></span>
                                        </td>
                                    </tr>`)

            if (query != '') {
                search(query)
            } else {
                setTimeout(() => {
                    window.location.replace('makeadoptions')
                }, 500)
            }
        })
    })
</script>
@endsection