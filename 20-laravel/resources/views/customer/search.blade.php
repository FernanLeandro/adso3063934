@forelse ($pets as $pet)

<tr class="{{ $pet->id % 2 == 0 ? 'bg-[#0006]' : '' }}">
    <th class="hidden md:table-cell">{{ $pet->id }}</th>
    <td>
        <div class="avatar">
            <div class="rounded w-16">
                <img src="{{ asset('images/' . $pet->image) }}" />
            </div>
        </div>
    </td>
    <td class="hidden md:table-cell">{{ $pet->name }}</td>
    <td>{{ $pet->kind }}</td>
    <td class="hidden md:table-cell">{{ $pet->age }}</td>
                <td class="hidden md:table-cell">
                    @if ($pet->status == 1)
                    <div class="badge badge-outline badge-success">Adopted</div>
                    @else
                    <div class="badge badge-outline badge-default">Available</div>
                    @endif
                </td>
    <td>
        <a class="btn btn-ghost btn-xs" href="{{ url('makeadoption/' . $pet->id) }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-red-400" viewBox="0 0 256 256" fill="currentColor">
                <path d="M128 218s-78-46-78-112a54 54 0 0 1 108 0 54 54 0 0 1 108 0c0 66-78 112-78 112z"/>
            </svg>
        </a>
    </td>
</tr>
@empty
<tr class="bg-[#0009]">
    <td colspan="7" class="text-center text-lg font-bold my-4">
        No results found!
    </td>
</tr>
@endforelse
<tr class="bg-[#0009]">
    <td colspan="7">{{ $pets->links('layouts.pagination') }}</td>
</tr>
