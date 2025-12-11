{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
@csrf

<!-- Name -->
<div>
    <x-input-label for="name" :value="__('Name')" />
    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Email Address -->
<div class="mt-4">
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <x-text-input id="password" class="block mt-1 w-full"
        type="password"
        name="password"
        required autocomplete="new-password" />

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div class="mt-4">
    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

    <x-text-input id="password_confirmation" class="block mt-1 w-full"
        type="password"
        name="password_confirmation" required autocomplete="new-password" />

    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

<div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>

    <x-primary-button class="ms-4">
        {{ __('Register') }}
    </x-primary-button>
</div>
</form>
</x-guest-layout> --}}



@extends('layouts.home')

@section('title', 'register: Larapets 🐶')

@section('content')
<section class="bg-[#000a] text-white rounded-lg md:w-[640px] w-[360px] gap-2 p-4 flex flex-col items-center justify-center">
    <h1 class="flex gap-2 justify-center items-center text-4xl pb-4 p-5 border-b-2 border-[#000a]">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path d="M168,56a8,8,0,0,1,8-8h16V32a8,8,0,0,1,16,0V48h16a8,8,0,0,1,0,16H208V80a8,8,0,0,1-16,0V64H176A8,8,0,0,1,168,56Zm62.56,54.68a103.92,103.92,0,1,1-85.24-85.24,8,8,0,0,1-2.64,15.78A88.07,88.07,0,0,0,40,128a87.62,87.62,0,0,0,22.24,58.41A79.66,79.66,0,0,1,98.3,157.66a48,48,0,1,1,59.4,0,79.66,79.66,0,0,1,36.06,28.75A87.62,87.62,0,0,0,216,128a88.85,88.85,0,0,0-1.22-14.68,8,8,0,1,1,15.78-2.64ZM128,152a32,32,0,1,0-32-32A32,32,0,0,0,128,152Zm0,64a87.57,87.57,0,0,0,53.92-18.5,64,64,0,0,0-107.84,0A87.57,87.57,0,0,0,128,216Z"></path>
        </svg>
        Register
    </h1>
    <div class="card w-full">
        <form method="POST" action="{{ route('register') }}" class="flex gap-4 flex-col md:flex-row ">
            <div class="w-full md:w-[320px]">
                @csrf
                {{-- document --}}
                <label class="label">Document</label>
                <input type="text" class="input bg-[#000a] indent-2 outline-0" name="document" placeholder="1002673088" value="{{ old('document') }}" />
                @error('document')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                {{-- fullname --}}
                <label class="label">Fullname</label>
                <input type="text" class="input bg-[#000a] indent-2 outline-0" name="fullname" placeholder="Fernandinho Filipinho" />
                @error('fullname')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                {{-- gender --}}
                <label class="label text-white">gender</label>
                <select name="gender" class="select bg-[#000a] outline-0 indent-2" id="">
                    <option value="">Select...</option>
                    <option value="Female" @if(old('gender')=='Female' ) selected @endif>Female</option>
                    <option value="Male" @if(old('gender')=='Male' ) selected @endif>Male</option>
                </select>
                @error('gender')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                {{-- Birthdate --}}
                <label class="label">Birthdate</label>
                <input type="date" class="input bg-[#000a] indent-1 outline-0" name="birthdate" placeholder="1600-02-08" />
                @error('birthdate')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror


            </div>
            <div class="w-full md:w-[320px]">
                {{-- Phone --}}
                <label class="label">Phone</label>
                <input type="number" class="input bg-[#000a] indent-2 outline-0" name="phone" placeholder="3219858748" />
                @error('phone')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                {{-- Email --}}
                <label class="label">Email</label>
                <input type="email" class="input bg-[#000a] indent-2 outline-0" name="email" placeholder="fernandinho@gmail.com" />
                @error('email')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                {{-- Password --}}
                <label class="label">Password</label>
                <input type="password" class="input bg-[#000a] indent-2 outline-0" name="password" placeholder="Password" />
                @error('password')
                <small class="badge badge-error w-full -mt-1 text-xs py-4">{{ $message }}</small>
                @enderror

                <label class="label">Password confirmation</label>
                <input type="password" class="input bg-[#000a] indent-2 outline-0" name="password_confirmation" placeholder="Password" />

                <button class="btn btn-outline hover:bg-[#000a] hover:text-white mt-4 border w-full">Register</button>

                <p class="text-sm text-center mt-2">
                    <a class="link link-default" href="{{ route('login') }}">
                        Already registred?
                    </a>
                </p>
            </div>

    </div>

</section>
@endsection