@extends('layouts.dashboard')

@section('title', 'Make Adoption: Larapets 🐶')

@section('content')


<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
        <path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z"></path>
    </svg>
    Make Adoption
</h1>


<label class="input text-white bg-[#000a] outline-none mb-10">
    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.3-4.3"></path>
        </g>
    </svg>
    <input type="search" required placeholder="Search" name="qsearch" id="qsearch" />
</label>

<div class="overflow-x-auto text-white rounded-box bg-[#000a]">
    <table class="table bg-[#000a]">
        <thead class="text-white bg-[#000a]">
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
            <tr class="{{ $pet->id % 2 == 0 ? 'bg-[#000a]' : '' }}">
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
                    @else
                    <div class="badge badge-outline badge-success">Available</div>
                    @endif
                </td>
                <td>
                    <a class="btn btn-ghost btn-xs" href="{{ url('makeadoption/' . $pet->id) }}" title="Make adoption">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="#000000" viewBox="0 0 256 256">
                            <path d="M169.47,56.79a8,8,0,0,0-2.94-15.73C150.42,44.08,137,52.18,128,64c-11.26-15-29.36-24-50-24a62.07,62.07,0,0,0-62,62c0,70,103.79,126.67,108.21,129a7.93,7.93,0,0,0,7.58,0h0a332.57,332.57,0,0,0,41.09-27.22,8,8,0,1,0-9.76-12.67c-10.31,7.94-20,14.37-27.12,18.82V81.7C141.84,68.75,153.94,59.7,169.47,56.79ZM120,210C93.58,193.41,32,149.71,32,102A46.06,46.06,0,0,1,78,56c18.91,0,34.86,9.78,42,25.64ZM232.55,104a8.85,8.85,0,0,1-.89,0,8,8,0,0,1-7.94-7.12,45.88,45.88,0,0,0-20.17-33.14,8,8,0,1,1,8.9-13.29,61.83,61.83,0,0,1,27.17,44.67A8,8,0,0,1,232.55,104Zm-2.09,35.62c-5.67,11.37-13.94,23-24.59,34.49a8,8,0,1,1-11.74-10.86c9.61-10.4,17-20.75,22-30.77a8,8,0,1,1,14.31,7.14Z"></path>
                        </svg>
                    </a>
                </td>
            </tr>
            @endforeach
            <tr class="bg-[#000a]">
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