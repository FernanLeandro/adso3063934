@extends('layouts.dashboard')

@section('title, Show User: Larapets 🐶')


@section('content')

@endsection
<h1 class="text-4xl text-black flex gap-2 items-center justify-center pb-4 border-b-2 border-black border-neutra-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
    </svg>
    Show User
</h1>
{{-- Breadcrumbs --}}
<div class="breadcrumbs text-sm text-white bg-[#0009] rounded-box px-4 py-2">
    <ul>
        <li>
            <a href="{{ url('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z">
                    </path>
                </svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ url('users') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z">
                    </path>
                </svg>
                Users Module
            </a>
        </li>
        <li>
            <span class="inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                </svg>
                Show user
            </span>
        </li>
    </ul>
</div>

{{-- Card --}}
<div class="bg-[#0009] p-10 rounded-3xl">
    <div class="avatar flex flex-col cursor-pointer hover:scale-110 transition ease-in justify-center items-center">
        <div id="upload" class="mask mask-squircle w-48">
            <img src="{{ asset('images/'.$user->photo) }}" />
        </div>
    </div>
    {{-- Data --}}
    <div class="flex gap-2 flex-col md:flex-row">
        <ul class="list bg-[#0009] mt-4 text-white  rounded-box shadow-md">
            <li class="list-row">
                <span class="font-semibold">Document</span><span class="text-[#fff9]">{{ $user->document }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">FullName</span><span class="text-[#fff9]">{{ $user->fullname }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Gender</span><span class="text-[#fff9]">{{ $user->gender }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Birthdate</span><span class="text-[#fff9]">{{ $user->birthdate }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Phone</span><span class="text-[#fff9]">{{ $user->phone }}</span>
            </li>
        </ul>
        <ul class="list bg-[#0009] mt-4 text-white rounded-box shadow-md">
            <li class="list-row">
                <span class="font-semibold">Email</span><span class="text-[#fff9]">{{ $user->email }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Active</span>
                <span class="text-[#fff9]"> @if ($user->active == 1)
                    <div class="badge badge-outline badge-success">Active</div>
                    @else
                    <div class="badge badge-outline badge-error">Inactive</div>
                    @endif
                </span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Role</span><span class="text-[#fff9]"> @if ($user->role == 'Administrator')
                    <div class="badge badge-outline badge-warning">Admin</div>
                    @else
                    <div class="badge badge-outline badge-default">Customer</div>
                    @endif
                </span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Create At::</span><span class="text-[#fff9]">{{ $user->created_at }}</span>
            </li>
            <li class="list-row">
                <span class="font-semibold">Update At::</span><span class="text-[#fff9]">{{ $user->updated_at }}</span>
            </li>
        </ul>
    </div>

</div>