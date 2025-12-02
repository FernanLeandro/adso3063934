@extends('layouts.dashboard')

@section('title', 'Edit Pet: Larapets 🐾')

@section('content')
<h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
    <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
        <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
    </svg>
    Edit Pet
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
            <span>Edit Pet</span>
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

            <button class="btn text-white border mt-4 w-full hover:bg-[#fff6]">Update</button>
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
        // Toggle other kind input
        $('#kind_select').on('change', function() {
            if ($(this).val() === 'Other') {
                $('#kind_other').show();
            } else {
                $('#kind_other').hide();
                $('#kind_other').val('');
            }
        });
        // Status badge update for edit
        function refreshStatusEdit() {
            if ($('input[name=status]').is(':checked')) {
                $('input[name=status]').nextAll('.badge').first().removeClass('badge-default').removeClass('badge-outline').addClass('badge-success').text('Adopted');
            } else {
                $('input[name=status]').nextAll('.badge').first().removeClass('badge-success').addClass('badge-default').text('Available');
            }
        }
        refreshStatusEdit();
        $('input[name=status]').on('change', function() { refreshStatusEdit(); });
    });
</script>
@endsection
