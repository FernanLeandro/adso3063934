@extends('layouts.dashboard')

@section('title', 'Make Adoption: Larapets 🐶')

@section('content')


<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
<svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256"><path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z"></path></svg>
    Make Adoption
</h1>


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
        <thead class="text-white bg-[#0006]">
            <tr>
                <th class="hidden md:table-cell">Id</th>
                <th>Image</th>
                <th class="hidden md:table-cell">Name</th>
                <th>Kind</th>
                <th class="hidden md:table-cell">Age</th>
                <th class="hidden md:table-cell">Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="datalist">
            @foreach ($pets as $pet)
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
                    <a class="btn btn-ghost btn-xs" href="{{ url('makeadoption/' . $pet->id) }}" title="Make adoption">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-red-400" viewBox="0 0 256 256" fill="currentColor">
                            <path d="M128 218s-78-46-78-112a54 54 0 0 1 108 0 54 54 0 0 1 108 0c0 66-78 112-78 112z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            @endforeach
            <tr class="bg-[#0009]">
                <td colspan="7">{{ $pets->links('layouts.pagination') }}</td>
            </tr>
        </tbody>
    </table>
</div>

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
        <button>close</button>
    </form>
</dialog>

@endsection

@section('js')
<script>
    // Modal
    $(document).ready(function() {
        const modal_message = document.getElementById('modal_message');
        const modal_delete = document.getElementById('modal_delete');
        @if(session('message'))
        modal_message.showModal();
        @endif


        // Delete ----------------
        $('table').on('click', '.btn-delete', function() {
            $fullname = $(this).data('fullname');
            $('.fullname').text($fullname);
            $fsm = $(this).next();
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

            $.post("search/makeadoption", {
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

            $('.datalist').html(`<tr>
                                        <td colspan="7" class="text-center py-18">
                                            <span class="loading loading-spinner loading-xl"></span>
                                        </td>
                                    </tr>`)
            if (query != '') {
                search(query)
            } else {
                setTimeout(() => {
                    window.location.replace('makeadoption')
                }, 500);
            }
        })
        // Import
        $('.btn-import').click(function(e) {
            $('#file').click();
        })
        $('#file').change(function(e) {
            $(this).parent().submit();
        })
    })
</script>
@endsection
