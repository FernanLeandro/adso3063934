@forelse($adopts as $adopt)
<div class="avatar-group mt-8 -space-x-6">
    <div class="avatar">
        <div class="w-36">
            <img src="{{ asset('images/' . $adopt->user->photo) }}" />
        </div>
    </div>
    <div class="avatar">
        <div class="w-36">
            <img src="{{ asset('images/' . ($adopt->pet->image )) }}" />
        </div>
    </div>
</div>
<h4 class="text-white">
    <span class="underline font-bold">{{ $adopt->pet->name }}</span>
    was adopted by
    <span class="underline font-bold">{{ $adopt->user->fullname }}</span>
    {{$adopt->created_at->diffForHumans()}}
</h4>
<a href="{{ url('adoptions/'.$adopt->id) }}" class="btn bg-[#000a] text-white rounded-full px-6 py-2 shadow-md hover:bg-[#000a] transition-transform flex items-center gap-3">
    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#111] text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
    </span>
    <span class="font-medium">Más info</span>
</a>
<span class="border-b-1 border-dashed mt-8 border-[#fff] h-2 w-4/12"></span>
@empty
<div class="py-10">
    No results found.
</div>
@endforelse