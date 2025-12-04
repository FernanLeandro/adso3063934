<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PetsExport;
use App\Imports\PetsImport;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::orderBy('id', 'desc')->paginate(20);
        return view('pets.index')->with('pets', $pets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kinds = Pet::select('kind')->distinct()->orderBy('kind')->pluck('kind');
        if ($kinds->isEmpty()) {
            $kinds = collect(['Dog', 'Cat']);
        }
        return view('pets.create', compact('kinds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'string'],
            'image' => ['required', 'image'],
            'kind' => ['required', 'string'],
            'kind_other' => ['nullable', 'string'],
            'weight' => ['required', 'numeric'],
            'age' => ['required', 'integer'],
            'breed' => ['required', 'string'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if ($request->kind === 'Other' && empty($request->kind_other)) {
            return back()->withErrors(['kind_other' => 'Please provide the kind when selecting Other'])->withInput();
        }

        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
        } else {
            $image = 'no-image.png';
        }

        $pet = new Pet;
        $pet->name = $request->name;
        $pet->image = $image;
        $pet->kind = $request->kind === 'Other' ? $request->kind_other : $request->kind;
        $pet->weight = $request->weight;
        $pet->age = $request->age;
        $pet->breed = $request->breed;
        $pet->location = $request->location;
        $pet->description = $request->description;
        // Default newly created pets to active (user requested new pets appear active)
        $pet->active = 1;
        $pet->status = $request->has('status') ? 1 : 0;

        if ($pet->save()) {
            return redirect('pets')->with('message', 'The pet: ' . $pet->name . ' was successfully added!.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        return view('pets.show')->with('pet', $pet);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        $kinds = Pet::select('kind')->distinct()->orderBy('kind')->pluck('kind');
        if ($kinds->isEmpty()) {
            $kinds = collect(['Dog', 'Cat']);
        }
        return view('pets.edit', compact('pet', 'kinds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $validation = $request->validate([
            'name' => ['required', 'string'],
            'kind' => ['required', 'string'],
            'kind_other' => ['nullable', 'string'],
            'weight' => ['required', 'numeric'],
            'age' => ['required', 'integer'],
            'breed' => ['required', 'string'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if ($request->kind === 'Other' && empty($request->kind_other)) {
            return back()->withErrors(['kind_other' => 'Please provide the kind when selecting Other'])->withInput();
        }

        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
            if ($request->originimage != 'no-image.png' && file_exists(public_path('images/') . $request->originimage)) {
                unlink(public_path('images/') . $request->originimage);
            }
        } else {
            $image = $request->originimage ?? $pet->image;
        }

        $pet->name = $request->name;
        $pet->image = $image;
        $pet->kind = $request->kind === 'Other' ? $request->kind_other : $request->kind;
        $pet->weight = $request->weight;
        $pet->age = $request->age;
        $pet->breed = $request->breed;
        $pet->location = $request->location;
        $pet->description = $request->description;
        $pet->active = $request->has('active') ? 1 : 0;
        $pet->status = $request->has('status') ? 1 : 0;

        if ($pet->save()) {
            return redirect('pets')->with('message', 'The pet: ' . $pet->name . ' was successfully edited!.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        if ($pet->image != 'no-image.png' && file_exists(public_path('images/') . $pet->image)) {
            unlink(public_path('images/') . $pet->image);
        }
        if ($pet->delete()) {
            return redirect('pets')->with('message', 'The pet: ' . $pet->name . ' was successfully deleted!.');
        }
    }

    /**
     * Toggle active state for the pet.
     */
    public function toggleActive(Pet $pet)
    {
        $pet->active = $pet->active ? 0 : 1;
        $pet->save();
        return redirect()->back()->with('message', 'The pet: ' . $pet->name . ' active status was updated!.');
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $pets = Pet::where('name', 'like', "%{$q}%")->orderBy('id', 'desc')->paginate(20);
        return view('pets.search')->with('pets', $pets);
    }

    // Export PDF
    public function pdf()
    {
        $pets = Pet::all();
        $pdf = PDF::loadView('pets.pdf', compact('pets'));
        return $pdf->download('allpets.pdf');
    }

    // Export Excel
    public function excel()
    {
        return Excel::download(new PetsExport, 'allpets.xlsx');
    }

    // Import Excel
    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new PetsImport, $file);
        return redirect()->back()->with('message', 'Pets imported successfully!');
    }
}
