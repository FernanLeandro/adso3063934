@extends('layouts.dashboard')
@section('title', 'dashboard ADMIN: Larapets')

@section('content')

<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
  <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="currentColor" viewBox="0 0 256 256">
    <path d="M224,40V216a8,8,0,0,1-16,0V40a8,8,0,0,1,16,0ZM192,64v40a16,16,0,0,1-16,16H80a16,16,0,0,1-16-16V64A16,16,0,0,1,80,48h96A16,16,0,0,1,192,64Zm-16,0H80v40h96Zm16,88v40a16,16,0,0,1-16,16H40a16,16,0,0,1-16-16V152a16,16,0,0,1,16-16H176A16,16,0,0,1,192,152Zm-16,0H40v40H176Z"></path>
  </svg>
  Dashboard
</h1>

{{-- Customer --}}
@if (Auth::user()->role == 'Administrator')
<!-- Cards -->
<div class="flex flex-wrap gap-4 items-center justify-center">
  {{-- module user --}}
  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img class="w-full h-full object-cover" src="images/model-user.png" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">Module Users</h2>
      {{-- stats --}}
      <ul class="list bg-[#0003] rounded-box shadow-md">

        <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Stadistics:</li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Total users:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\User::count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Customer:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\User::where('role', 'customer')->count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Active</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\User::where('active', 1)->count() }}
          </button>
        </li>
      </ul>
      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('users') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>

  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img class="w-full h-full object-cover" src="images/model-pets.png" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">Module Pets</h2>
      {{-- stats --}}
      <ul class="list bg-[#0003] rounded-box shadow-md">

        <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Stadistics:</li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Total Pets:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Pet::count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Dogs:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Pet::where('kind', 'dog')->count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Cats:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Pet::where('kind', 'cat')->count() }}
          </button>
        </li>
      </ul>
      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('pets') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>

  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img src="images/adoption-pets.png" class="w-full h-full object-cover" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">Module Adoptions</h2>
      {{-- stats --}}
      <ul class="list bg-[#0003] rounded-box shadow-md">

        <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Stadistics:</li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Total Adoptions:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Adoption::count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Dog Adopted:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Pet::where('status', 1)->where('kind', 'dog')->count() }}
          </button>
        </li>

        <li class="list-row">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path
              d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
            </path>
          </svg>
          <div class="flex items-center">
            <div class="text-xs uppercase font-semibold opacity-60">Cat Adopted:</div>
          </div>
          <button class="btn btn-square btn-ghost">
            {{ App\Models\Pet::where('status', 1)->where('kind', 'cat')->count() }}
          </button>
        </li>
      </ul>
      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('adoptions') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>
</div>

@endif

{{-- Customer --}}
@if (Auth::user()->role == 'Customer')

<!-- Cards -->
<div class="flex flex-wrap gap-4 items-center justify-center">
  {{-- module user --}}
  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img class="w-full h-full object-cover" src="images/model-user.png" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">Module Profile</h2>
      {{-- stats --}}

      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('myprofile') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>

  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img class="w-full h-full object-cover" src="images/model-pets.png" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">My Adoptions</h2>
      {{-- stats --}}

      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('pets') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>
  <div class="card text-white bg-[#0006] w-96 shadow-sm">
    <figure class="h-48 overflow-hidden">
      <img src="images/adoption-pets.png" class="w-full h-full object-cover" alt="">
    </figure>
    <div class="card-body">
      <h2 class="card-title">Make Adoption</h2>
      {{-- stats --}}

      <div class="card-actions justify-end">
        <a class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3" href="{{ url('adoptions') }}">Enter
          <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>
</div>

<dialog id="modal_error" class="modal">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Sorry!</h3>
    <div role="alert" class="alert alert-error">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span id="modal_error_text">{{ session('error') }}</span>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

@endif

<dialog id="modal_message" class="modal">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Congratulations profile edited!</h3>
    <div role="alert" class="alert alert-success">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span id="modal_message_text">{{ session('message') }}</span>
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
    const modal_error = document.getElementById('modal_error');
    @if(session('error'))
    modal_error.showModal();
    @endif
    const modal_message = document.getElementById('modal_message');
    @if(session('message'))
    modal_message.showModal();
    @endif

  })
</script>
@endsection