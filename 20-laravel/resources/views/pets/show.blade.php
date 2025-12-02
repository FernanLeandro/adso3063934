@extends('layouts.dashboard')

@section('title', 'View Pet: Larapets 🐾')


@section('content')

<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-black border-neutra-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
    </svg>
    View Pet
</h1>
{{-- Breadcrumbs --}}
<div class="breadcrumbs text-sm text-white bg-[#0009] rounded-box px-4 py-2">
    <ul>
        <li>
            <a href="{{ url('dashboard') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ url('pets') }}">Pets Module</a>
        </li>
        <li>
            <span>Show Pet</span>
        </li>
    </ul>
</div>

{{-- Card --}}
<div class="bg-[#0009] p-10 rounded-3xl">
    <div class="avatar flex flex-col cursor-pointer hover:scale-110 transition ease-in justify-center items-center">
        <div id="upload" class="mask mask-squircle w-48">
            <img src="{{ asset('images/' . $pet->image) }}" />
        </div>
    </div>
    {{-- Data --}}
    <div class="flex gap-2 flex-col md:flex-row">
        <ul class="list bg-[#0009] mt-4 text-white  rounded-box shadow-md">
            <li class="list-row">
                <span class="font-semibold">Name</span><span class="text-[#fff9]">{{ $pet->name }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Kind</span><span class="text-[#fff9]">{{ $pet->kind }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Age</span><span class="text-[#fff9]">{{ $pet->age }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Weight</span><span class="text-[#fff9]">{{ $pet->weight }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Breed</span><span class="text-[#fff9]">{{ $pet->breed }}</span>
            </li>
        </ul>
        <ul class="list bg-[#0009] mt-4 text-white rounded-box shadow-md">
            <li class="list-row">
                <span class="font-semibold">Location</span><span class="text-[#fff9]">{{ $pet->location }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Status</span>
                <span class="text-[#fff9]"> @if ($pet->status == 1)
                    <div class="badge badge-outline badge-success">Adopted</div>
                    @else
                    <div class="badge badge-outline badge-default">Available</div>
                    @endif
                </span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Active</span>
                <span class="text-[#fff9]">
                    @if ($pet->active == 1)
                    <div class="badge badge-outline badge-success">yes</div>
                    @else
                    <div class="badge badge-outline badge-error">no</div>
                    @endif
                </span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Create At::</span><span class="text-[#fff9]">{{ $pet->created_at }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Update At::</span><span class="text-[#fff9]">{{ $pet->updated_at }}</span>
            </li>
        </ul>
    </div>

</div>
