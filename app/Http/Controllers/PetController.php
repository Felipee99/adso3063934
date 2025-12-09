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
        return view('pets.index', compact('pets'));
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
            'location' => 'required|string',
            'image' => 'nullable|image'  // ⬅ CAMBIADO: antes eras required
        ]);

        // Foto por defecto si no suben nada
        $photo = 'no-photo.png';

        // Si sube imagen, procesarla
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $photo = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('image'), $photo);
        }

        Pet::create([
            'name' => $request->name,
            'kind' => $request->kind,
            'weight' => $request->weight,
            'age' => $request->age,
            'breed' => $request->breed,
            'description' => $request->description,
            'active' => $request->active,
            'location' => $request->location,
            'image' => $photo
        ]);

        return redirect('pets')->with('message', 'Pet added successfully!');
    }

    public function show(Pet $pet)
    {
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        return view('pets.edit', compact('pet'));
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
            'location' => 'required|string',
            'image' => 'nullable|image'
        ]);

        $photo = $pet->image; // conservar imagen si no suben nueva

        if ($request->hasFile('image')) {

            // borrar la anterior solo si existe físicamente
            if ($pet->image != 'no-photo.png' && file_exists(public_path('image/' . $pet->image))) {
                unlink(public_path('image/' . $pet->image));
            }

            $file = $request->file('image');
            $photo = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('image'), $photo);
        }

        $pet->update([
            'name' => $request->name,
            'kind' => $request->kind,
            'weight' => $request->weight,
            'age' => $request->age,
            'breed' => $request->breed,
            'description' => $request->description,
            'active' => $request->active,
            'location' => $request->location,
            'image' => $photo
        ]);

        return redirect('pets')->with('message', 'Pet updated successfully!');
    }

    public function destroy(Pet $pet)
    {
        if ($pet->image != 'no-photo.png' && file_exists(public_path('image/' . $pet->image))) {
            unlink(public_path('image/' . $pet->image));
        }

        $pet->delete();

        return redirect('pets')->with('message', 'Pet deleted successfully!');
    }

    public function search(Request $request)
    {
        $pets = Pet::where('name', 'like', '%' . $request->q . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(20);

        return view('pets.search', compact('pets'));
    }

    public function pdf()
    {
        $pets = Pet::all();
        $pdf = Pdf::loadView('pets.pdf', compact('pets'));
        return $pdf->download('allpets.pdf');
    }

    public function excel()
    {
        return Excel::download(new PetsExport, 'allpets.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel' => ['required', 'file', 'mimes:xlsx,xls,csv']
        ]);

        try {
            Excel::import(new PetsImport, $request->file('excel'));
            return redirect()->back()->with('message', 'Pets imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }
}
