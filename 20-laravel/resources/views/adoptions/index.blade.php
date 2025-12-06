@extends('layouts.dashboard')

@section('title', 'Module Adoptions: Larapets 🐶')

@section('content')


<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
<svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256"><path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z"></path></svg>
    Module Adoptions
</h1>



<div class="join bg-[#0006] max-auto rounded-box">
    <a class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white join-item" href="{{ url('export/adoptions/pdf') }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M224,152a8,8,0,0,1-8,8H192v16h16a8,8,0,0,1,0,16H192v16a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8h32A8,8,0,0,1,224,152ZM92,172a28,28,0,0,1-28,28H56v8a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8H64A28,28,0,0,1,92,172Zm-16,0a12,12,0,0,0-12-12H56v24h8A12,12,0,0,0,76,172Zm88,8a36,36,0,0,1-36,36H112a8,8,0,0,1-8-8V152a8,8,0,0,1,8-8h16A36,36,0,0,1,164,180Zm-16,0a20,20,0,0,0-20-20h-8v40h8A20,20,0,0,0,148,180ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,0,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.69L160,51.31Z"></path>
        </svg>
        <span class="hidden md:inline">Export</span>
    </a>
    <a class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white join-item" href="{{ url('export/adoptions/excel') }}">
        <svg xmlns=" http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M156,208a8,8,0,0,1-8,8H120a8,8,0,0,1-8-8V152a8,8,0,0,1,16,0v48h20A8,8,0,0,1,156,208ZM92.65,145.49a8,8,0,0,0-11.16,1.86L68,166.24,54.51,147.35a8,8,0,1,0-13,9.3L58.17,180,41.49,203.35a8,8,0,0,0,13,9.3L68,193.76l13.49,18.89a8,8,0,0,0,13-9.3L77.83,180l16.68-23.35A8,8,0,0,0,92.65,145.49Zm98.94,25.82c-4-1.16-8.14-2.35-10.45-3.84-1.25-.82-1.23-1-1.12-1.9a4.54,4.54,0,0,1,2-3.67c4.6-3.12,15.34-1.72,19.82-.56a8,8,0,0,0,4.07-15.48c-2.11-.55-21-5.22-32.83,2.76a20.58,20.58,0,0,0-8.95,14.95c-2,15.88,13.65,20.41,23,23.11,12.06,3.49,13.12,4.92,12.78,7.59-.31,2.41-1.26,3.33-2.15,3.93-4.6,3.06-15.16,1.55-19.54.35A8,8,0,0,0,173.93,214a60.63,60.63,0,0,0,15.19,2c5.82,0,12.3-1,17.49-4.46a20.81,20.81,0,0,0,9.18-15.23C218,179,201.48,174.17,191.59,171.31ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,1,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.68L160,51.31Z"></path>
        </svg>
        <span class="hidden md:inline">Export</span>
    </a>

</div>
{{-- Options --}}
<label class="input text-white bg-[#0009] outline-none mb-10">
    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <g
            stroke-linejoin="round"
            stroke-linecap="round"
            stroke-width="2.5"
            fill="none"
            stroke="currentColor">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.3-4.3"></path>
        </g>
    </svg>
    <input type="search" required placeholder="Search" name="qsearch" id="qsearch" />
</label>

<!-- CSRF token for AJAX search -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">


@csrf
<div class="datalist flex flex-col gap-4 items-center justify-center">
    @foreach($adopts as $adopt)
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
    <a href="{{ url('adoptions/'.$adopt->id) }}" class="btn bg-[#0006] text-white rounded-full px-6 py-2 shadow-md hover:bg-[#0009] transition-transform flex items-center gap-3">
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#111] text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </span>
        <span class="font-medium">Más info</span>
    </a>
    <span class="border-b-1 border-dashed mt-8 border-[#fff] h-2 w-12/12"></span>
    @endforeach
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