<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdoptionsExport;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adopts = Adoption::orderBy('id', 'DESC')->paginate(20);
        //dd($adopts->toArray());
        return view('adoptions.index')->with('adopts', $adopts);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Load adoption with relations to ensure pet and user are available in the view
        $adopt = Adoption::with(['pet', 'user'])->findOrFail($id);
        return view('adoptions.show')->with('adopt', $adopt);
    }

    public function search(Request $request)
    {
        $adopts = Adoption::names($request->q)->orderBy('id', 'DESC')->paginate(20);
        return view('adoptions.search')->with('adopts', $adopts);

    }

    // Export PDF
    public function pdf()
    {
        $adopts = Adoption::with(['user','pet'])->get();
        $pdf = PDF::loadView('adoptions.pdf', compact('adopts'));
        return $pdf->download('alladoptions.pdf');
    }

    // Export Excel
    public function excel()
    {
        return Excel::download(new AdoptionsExport, 'alladoptions.xlsx');
    }
}
