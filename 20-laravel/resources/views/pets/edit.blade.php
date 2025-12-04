@extends('layouts.dashboard')

@section('title', 'Edit Pet: Larapets 🐾')

@section('content')
<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
        <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
    </svg>
    Edit Pet
</h1>

<div class="breadcrumbs text-sm text-white bg-[#0009] rounded-box px-4 py-2">
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
                    <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
                </svg>
                Edit Pet
            </span>
        </li>
    </ul>
</div>
<div class="w-full md:w-[720px] w-[320px] bg-[#0009] rounded-box p-6">
    <form method="POST" action="{{ url('pets/' . $pet->id) }}" class="flex flex-col md:flex-row gap-4 mt-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="w-full md:w-[320px]">
            <div class="avatar flex flex-col cursor-pointer hover:scale-110 transition ease-in justify-center items-center">
                <div id="upload" class="mask mask-squircle w-48">
                    <img id="preview" src="{{ asset('images/' . $pet->image) }}" />
                </div>
                <small class="pb-0 border-white border-b flex items-center justify-center text-white">Upload Image</small>
                @error('image')
                <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                @enderror
            </div>
            <input type="file" id="image" name="image" class="hidden" accept="image/*">
            <input type="hidden" name="originimage" value="{{ $pet->image }}">
        </div>
        <div class="w-full md:w-[320px]">
            <label class="label text-white">Name</label>
            <input type="text" class="input bg-[#fff]" name="name" placeholder="Buddy" value="{{ old('name', $pet->name) }}" />
            @error('name')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Kind</label>
            <select name="kind" id="kind_select" class="select bg-[#fff] outline-0">
                <option value="">Select...</option>
                @foreach($kinds as $k)
                <option value="{{ $k }}" @if(old('kind', $pet->kind)==$k) selected @endif>{{ $k }}</option>
                @endforeach
                <option value="Other" @if(old('kind', $pet->kind)=='Other') selected @endif>Other</option>
            </select>
            <input type="text" id="kind_other" name="kind_other" class="input bg-[#fff] mt-2" placeholder="Type other kind" value="{{ old('kind_other', '') }}" style="display: {{ old('kind', $pet->kind)=='Other' ? 'block' : 'none' }};">
            @error('kind')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Age</label>
            <input type="number" class="input bg-[#fff]" name="age" placeholder="2" value="{{ old('age', $pet->age) }}" />
            @error('age')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror
        </div>

        <div class="w-full md:w-[320px]">
            <label class="label text-white">Weight (kg)</label>
            <input type="number" step="0.1" class="input bg-[#fff]" name="weight" placeholder="4.5" value="{{ old('weight', $pet->weight) }}" />
            @error('weight')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Breed</label>
            <input type="text" class="input bg-[#fff]" name="breed" placeholder="Beagle" value="{{ old('breed', $pet->breed) }}" />
            @error('breed')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Location</label>
            <input type="text" class="input bg-[#fff]" name="location" placeholder="City" value="{{ old('location', $pet->location) }}" />
            @error('location')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            <label class="label text-white">Description</label>
            <textarea name="description" class="textarea bg-[#fff]" rows="3">{{ old('description', $pet->description) }}</textarea>
            @error('description')
            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
            @enderror

            <div class="form-control mt-2">
                <label class="cursor-pointer label flex items-center gap-3">
                    <input type="checkbox" name="active" class="toggle toggle-success" @if($pet->active == 1) checked @endif />
                    <span class="label-text text-white">Active</span>
                    @if($pet->active == 1)
                    <span class="badge badge-outline badge-success ml-2">Yes</span>
                    @else
                    <span class="badge badge-outline badge-error ml-2">No</span>
                    @endif
                </label>
            </div>
            <div class="form-control mt-2">
                <label class="cursor-pointer label flex items-center gap-3">
                    <input type="checkbox" name="status" class="toggle toggle-success" @if($pet->status == 1) checked @endif />
                    <span class="label-text text-white">Adopted</span>
                    @if($pet->status == 1)
                    <span class="badge badge-outline badge-success ml-2">Adopted</span>
                    @else
                    <span class="badge badge-outline badge-default ml-2">Available</span>
                    @endif
                </label>
            </div>

            <button type="submit" class="btn btn-outline text-white hover:bg-[#fff6] mt-4 w-full">Update</button>
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

        function refreshStatusEdit() {
            if ($('input[name=status]').is(':checked')) {
                $('input[name=status]').nextAll('.badge').first().removeClass('badge-default').removeClass('badge-outline').addClass('badge-success').text('Adopted');
            } else {
                $('input[name=status]').nextAll('.badge').first().removeClass('badge-success').addClass('badge-default').text('Available');
            }
        }
        refreshStatusEdit();
        $('input[name=status]').on('change', function() {
            refreshStatusEdit();
        });
    });
</script>
@endsection