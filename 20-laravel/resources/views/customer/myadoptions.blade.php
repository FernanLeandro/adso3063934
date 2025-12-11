@extends('layouts.dashboard')

@section('title', 'My adoptions: Larapets 🐶')

@section('content')


<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
<svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256"><path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z"></path></svg>
    My adoptions
</h1>


@csrf
<div class="datalist flex flex-col gap-4 items-center justify-center">
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
    <a href="{{ url('myadoptions/'.$adopt->id) }}" class="btn bg-[#000a] text-white rounded-full px-6 py-2 shadow-md hover:bg-[#000a] transition-transform flex items-center gap-3">
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#111] text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </span>
        <span class="font-medium">Más info</span>
    </a>
    <span class="border-b-1 border-dashed mt-8 border-[#fff] h-2 w-12/12"></span>
    @empty
    <p class="text-center my-20">No Adoptions yet!</p>
    @endforelse
</div>

@endsection

@section('js')
<script>
    // Modal
    $(document).ready(function() {
        const modal_message = document.getElementById('modal_message');
        @if(session('message'))
        modal_message.showModal();
        @endif


        // Delete ----------------
        $('table').on('click', '.btn-delete', function() {
            $fullname = $(this).data('fullname')
            $('.fullname').text($fullname);
            $fsm = $(this).next()
            modal_delete.showModal();

        })
        $('.btn-confirm').on('click', function(e) {
            e.preventDefault()
            $fsm.submit()
        })


        // Search ----------------
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

            $token = $('input[name=_token]').val()

            $.post("search/adoptions", {
                    'q': query,
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

            $('.datalist').html(`
                                        <div colspan="7" class="text-center py-18">
                                            <span class="loading loading-spinner loading-xl"></span>
                                        </div>
                                    `)
            if (query != '') {
                search(query)
            } else {
                setTimeout(() => {
                    window.location.replace('adoptions')
                }, 500);
            }
        })

    })
</script>
@endsection