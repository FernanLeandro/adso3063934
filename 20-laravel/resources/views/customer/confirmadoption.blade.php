@extends('layouts.dashboard')

@section('title', 'Confirm Adoption: Larapets 🐾')


@section('content')

<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-white border-neutra-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
        <path d="M243.28,68.24l-24-23.56a16,16,0,0,0-22.59,0L104,136.23l-36.69-35.6a16,16,0,0,0-22.58.05l-24,24a16,16,0,0,0,0,22.61l71.62,72a16,16,0,0,0,22.63,0L243.33,90.91A16,16,0,0,0,243.28,68.24ZM103.62,208,32,136l24-24a.6.6,0,0,1,.08.08l42.35,41.09a8,8,0,0,0,11.19,0L208.06,56,232,79.6Z"></path>
    </svg>
    Confirm Adoption
</h1>

{{-- Breadcrumbs --}}
<div class="breadcrumbs text-sm text-white bg-[#000a] rounded-box px-4 py-2">
    <ul>
        <li>
            <a href="{{ url('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z"></path>
                </svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ url('makeadoption') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z"></path>
                </svg>

                Make Adoption
            </a>
        </li>
        <li>
            <span class="inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M169.47,56.79a8,8,0,0,0-2.94-15.73C150.42,44.08,137,52.18,128,64c-11.26-15-29.36-24-50-24a62.07,62.07,0,0,0-62,62c0,70,103.79,126.67,108.21,129a7.93,7.93,0,0,0,7.58,0h0a332.57,332.57,0,0,0,41.09-27.22,8,8,0,1,0-9.76-12.67c-10.31,7.94-20,14.37-27.12,18.82V81.7C141.84,68.75,153.94,59.7,169.47,56.79ZM120,210C93.58,193.41,32,149.71,32,102A46.06,46.06,0,0,1,78,56c18.91,0,34.86,9.78,42,25.64ZM232.55,104a8.85,8.85,0,0,1-.89,0,8,8,0,0,1-7.94-7.12,45.88,45.88,0,0,0-20.17-33.14,8,8,0,1,1,8.9-13.29,61.83,61.83,0,0,1,27.17,44.67A8,8,0,0,1,232.55,104Zm-2.09,35.62c-5.67,11.37-13.94,23-24.59,34.49a8,8,0,1,1-11.74-10.86c9.61-10.4,17-20.75,22-30.77a8,8,0,1,1,14.31,7.14Z"></path>
                </svg>
                Confirm Adoption
            </span>
        </li>
    </ul>
</div>

{{-- Card --}}
<div class="bg-[#000a] p-10 rounded-3xl">
    <div class="avatar flex flex-col cursor-pointer hover:scale-110 transition ease-in justify-center items-center">
        <div id="upload" class="mask mask-squircle w-48">
            <img src="{{ asset('images/' . $pet->image) }}" />
        </div>
    </div>
    {{-- Data --}}
    <div class="flex gap-2 flex-col md:flex-row">
        <ul class="list bg-[#000a] mt-4 text-white  rounded-box shadow-md">
            <li class="list-row">
                <span class="font-semibold">Name</span><span class="text-[#fffa]">{{ $pet->name }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Kind</span><span class="text-[#fffa]">{{ $pet->kind }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Age</span><span class="text-[#fffa]">{{ $pet->age }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Weight</span><span class="text-[#fffa]">{{ $pet->weight }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Breed</span><span class="text-[#fffa]">{{ $pet->breed }}</span>
            </li>
        </ul>
        <ul class="list bg-[#000a] mt-4 text-white rounded-box shadow-md">
            <li class="list-row">
                <span class="font-semibold">Location</span><span class="text-[#fffa]">{{ $pet->location }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Status</span>
                <span class="text-[#fffa]"> @if ($pet->status == 1)
                    <div class="badge badge-outline badge-success">Adopted</div>
                    @else
                    <div class="badge badge-outline badge-default">Available</div>
                    @endif
                </span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Active</span>
                <span class="text-[#fffa]">
                    @if ($pet->active == 1)
                    <div class="badge badge-outline badge-success">yes</div>
                    @else
                    <div class="badge badge-outline badge-error">no</div>
                    @endif
                </span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Create At::</span><span class="text-[#fffa]">{{ $pet->created_at }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Update At::</span><span class="text-[#fffa]">{{ $pet->updated_at }}</span>
            </li>
        </ul>
    </div>

    <div class="mt-6">
        @if ($pet->status == 0)
        <form method="POST" action="{{ url('makeadoption/' . $pet->id) }}">
            @csrf
            <button type="submit" class="btn btn-outline btn-success w-full text-white">Confirm Adoption</button>
        </form>
        @else
        <a href="{{ url('makeadoption') }}" class="btn btn-ghost w-full">Back</a>
        @endif
    </div>

</div>

@endsection