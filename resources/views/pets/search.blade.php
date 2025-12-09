@forelse ($pets as $pet)
<tr @if ($pet->id % 2 == 0) class="bg-[#0006]"@endif>

    <th class="hidden md:table-cell">{{ $pet->id }}</th>

    {{-- IMAGE --}}
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

    {{-- ACTIVE --}}
    <td class="hidden md:table-cell">
        @if ($pet->active == 1)
        <div class="badge badge-outline badge-success">Active</div>
        @else
        <div class="badge badge-outline badge-error">Inactive</div>
        @endif
    </td>

    {{-- ACTIONS --}}
    <td>
        <a class="btn btn-outline btn-xs" href="{{ url('pets/' . $pet->id) }}">View</a>
        <a class="btn btn-outline btn-xs" href="{{ url('pets/' . $pet->id . '/edit') }}">Edit</a>
        <a class="btn btn-outline btn-error btn-xs btn-delete" href="javascript:;" data-name="{{ $pet->name }}">Delete</a>
        <form class="hidden" id="deleteForm{{ $pet->id }}" action="{{ url('pets/' . $pet->id) }}" method="POST">
            @csrf
            @method('delete')
        </form>
    </td>

</tr>

@empty
<tr class="bg-[#0009]">
    <td colspan="9" class="text-center text-lg font-bold my-4">
        No results found!
    </td>
</tr>
@endforelse

<tr class="bg-[#0009]">
    <td colspan="9">{{ $pets->links('layouts.pagination') }}</td>
</tr>
