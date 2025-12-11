@extends('layouts.dashboard')

@section('title', 'Add Pet: Larapets 🐾')

@section('content')
<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
        <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z"></path>
    </svg>
    Add Pet
</h1>

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
            <a href="{{ url('pets') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z"></path>
                </svg>

                Pets Module
            </a>
        </li>
        <li>
            <span class="inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z"></path>
                </svg>
                Edit Pet
            </span>
        </li>
    </ul>
</div>
<div class="w-full md:w-[720px] w-[320px] bg-[#000a] rounded-box p-6">
    <form method="POST" action="{{ url('pets') }}" class="flex flex-col md:flex-row gap-4 mt-4" enctype="multipart/form-data">
        @csrf
        <div class="w-full md:w-[320px]">
            <div class="avatar flex flex-col cursor-pointer hover:scale-110 transition ease-in justify-center items-center">
                <div id="upload" class="mask mask-squircle w-48">
                    <img id="preview" src="{{ asset('images/no-image.png') }}" />
                </div>
                <small class="pb-0 border-white border-b flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M208,40H48A24,24,0,0,0,24,64V176a24,24,0,0,0,24,24H208a24,24,0,0,0,24-24V64A24,24,0,0,0,208,40Zm8,136a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V64a8,8,0,0,1,8-8H208a8,8,0,0,1,8,8Zm-48,48a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,224ZM157.66,106.34a8,8,0,0,1-11.32,11.32L136,107.31V152a8,8,0,0,1-16,0V107.31l-10.34,10.35a8,8,0,0,1-11.32-11.32l24-24a8,8,0,0,1,11.32,0Z"></path>
                    </svg>
                    Upload Image
                </small>
                @error('image')
                <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                @enderror
            </div>
            <input type="file" id="image" name="image" class="hidden" accept="image/*">
        </div>
        <div class="w-full md:w-[320px]">
            {{-- Name --}}
            <label class="label text-white">Name</label>
            <input type="text" class="input bg-[#fff]" name="name" placeholder="Buddy" value="{{ old('name') }}" />
            @error('name')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            {{-- Kind --}}
            <label class="label text-white">Kind</label>
            <select name="kind" id="kind_select" class="select bg-[#fff] outline-0">
                <option value="">Select...</option>
                @foreach($kinds as $k)
                <option value="{{ $k }}" @if(old('kind')==$k) selected @endif>{{ $k }}</option>
                @endforeach
                <option value="Other" @if(old('kind')=='Other' ) selected @endif>Other</option>
            </select>
            <input type="text" id="kind_other" name="kind_other" class="input bg-[#fff] mt-2" placeholder="Type other kind" value="{{ old('kind_other') }}" style="display: {{ old('kind')=='Other' ? 'block' : 'none' }};">
            @error('kind')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            {{-- Age --}}
            <label class="label text-white">Age</label>
            <input type="number" class="input bg-[#fff]" name="age" placeholder="2" value="{{ old('age') }}" />
            @error('age')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror
        </div>

        <div class="w-full md:w-[320px]">
            {{-- Weight --}}
            <label class="label text-white">Weight (kg)</label>
            <input type="number" step="0.1" class="input bg-[#fff]" name="weight" placeholder="4.5" value="{{ old('weight') }}" />
            @error('weight')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            {{-- Breed --}}
            <label class="label text-white">Breed</label>
            <input type="text" class="input bg-[#fff]" name="breed" placeholder="Beagle" value="{{ old('breed') }}" />
            @error('breed')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            {{-- Location --}}
            <label class="label text-white">Location</label>
            <input type="text" class="input bg-[#fff]" name="location" placeholder="City" value="{{ old('location') }}" />
            @error('location')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            {{-- Description --}}
            <label class="label text-white">Description</label>
            <textarea name="description" class="textarea bg-[#fff]" rows="3">{{ old('description') }}</textarea>
            @error('description')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            <button type="submit" class="btn btn-outline text-white hover:bg-[#000a] mt-4 w-full">Add</button>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#upload').on('click', function(e) {
            e.preventDefault();
            $('#image').click();
        });
        $('#image').change(function(e) {
            e.preventDefault();
            $('#preview').attr('src', window.URL.createObjectURL($(this).prop('files')[0]));
        })

        $('#kind_select').on('change', function() {
            if ($(this).val() === 'Other') {
                $('#kind_other').show();
            } else {
                $('#kind_other').hide();
                $('#kind_other').val('');
            }
        });

        function refreshStatusCreate() {
            if ($('input[name=status]').is(':checked')) {
                $('#status_badge_create').removeClass('badge-default badge-error').addClass('badge-success').text('Adopted');
            } else {
                $('#status_badge_create').removeClass('badge-success badge-error').addClass('badge-default').text('Available');
            }
        }

        refreshStatusCreate();
        $('input[name=status]').on('change', function() {
            refreshStatusCreate();
        });
    });
</script>
@endsection