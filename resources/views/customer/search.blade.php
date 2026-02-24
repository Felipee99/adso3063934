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
         <a class="btn btn-outline btn-xs" href="{{ url('pets/' . $pet->id) }}">View</a>
     </td>
 </tr>
 @endforeach