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
    public function index()
    {
        $pets = Pet::paginate(20);
        return view('pets.index')->with('pets', $pets);
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'kind' => 'required|string',
            'weight' => 'required|numeric',
            'age' => 'required|numeric',
            'breed' => 'required|string',
            'description' => 'required|string',
            'active' => 'required|boolean',
            'status' => 'required|integer',
            'location' => 'required|string',
            'image' => 'required|image'
        ]);

        $photo = 'no-photo.png';
        if ($request->hasFile('image')) {
            $photo = time().'.'.$request->image->extension();
            $request->image->move(public_path('image'), $photo);
        }

        $pet = new Pet();
        $pet->name = $request->name;
        $pet->kind = $request->kind;
        $pet->weight = $request->weight;
        $pet->age = $request->age;
        $pet->breed = $request->breed;
        $pet->description = $request->description;
        $pet->active = $request->active;
        $pet->status = $request->status;
        $pet->location = $request->location;
        $pet->image = $photo;
        $pet->save();

        return redirect('pets')->with('message', 'Pet added successfully!');
    }

    public function show(Pet $pet)
    {
        return view('pets.show')->with('pet', $pet);
    }

    public function edit(Pet $pet)
    {
        return view('pets.edit')->with('pet', $pet);
    }

    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name' => 'required|string',
            'kind' => 'required|string',
            'weight' => 'required|numeric',
            'age' => 'required|numeric',
            'breed' => 'required|string',
            'description' => 'required|string',
            'active' => 'required|boolean',
            'status' => 'required|integer',
            'location' => 'required|string',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $photo = time().'.'.$request->image->extension();
            $request->image->move(public_path('image'), $photo);
            if ($pet->image != 'no-photo.png' && file_exists(public_path('image/'.$pet->image))) {
                unlink(public_path('image/'.$pet->image));
            }
        } else {
            $photo = $pet->image;
        }

        $pet->update([
            'name' => $request->name,
            'kind' => $request->kind,
            'weight' => $request->weight,
            'age' => $request->age,
            'breed' => $request->breed,
            'description' => $request->description,
            'active' => $request->active,
            'status' => $request->status,
            'location' => $request->location,
            'image' => $photo
        ]);

        return redirect('pets')->with('message', 'Pet updated successfully!');
    }

    public function destroy(Pet $pet)
    {
        if ($pet->image != 'no-photo.png' && file_exists(public_path('image/'.$pet->image))) {
            unlink(public_path('image/'.$pet->image));
        }

        $pet->delete();
        return redirect('pets')->with('message', 'Pet deleted successfully!');
    }

    // Search by Scope
    public function search(Request $request)
    {
        $pets = Pet::where('name', 'like', '%'.$request->q.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
        return view('pets.search')->with('pets', $pets);
    }

    // Export PDF
    public function pdf() {
        $pets = Pet::all();
        $pdf = PDF::loadView('pets.pdf', compact('pets'));
        return $pdf->download('allpets.pdf');
    }

    // Export Excel
    public function excel() {
        return Excel::download(new PetsExport, 'allpets.xlsx');
    }

    // Import Excel
    public function import(Request $request) {
        $request->validate([
            'excel' => ['required', 'file', 'mimes:xlsx,xls,csv']
        ]);

        $file = $request->file('excel');
        try {
            Excel::import(new PetsImport, $file);
            return redirect()->back()->with('message', 'Pets imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }
}
