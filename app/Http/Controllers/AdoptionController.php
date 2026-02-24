<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adopts = Adoption::orderBy('id', 'DESC')->paginate(20);
        return view('adoptions.index')->with('adopts', $adopts);
    }

    /**
     * Show the form for creating a new adoption.
     */
    public function create()
    {
        $users = User::all();
        $pets  = Pet::all();

        return view('adoptions.create', compact('users', 'pets'));
    }

    /**
     * Store a newly created adoption.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'pet_id'  => 'required|exists:pets,id',
        ]);

        // Verificar si la mascota YA fue adoptada
        if (Adoption::where('pet_id', $request->pet_id)->exists()) {
            return back()->with('error', 'Esta mascota ya fue adoptada.');
        }

        Adoption::create([
            'user_id' => $request->user_id,
            'pet_id'  => $request->pet_id,
        ]);

        return redirect()->route('adoptions.index')->with('success', '¡Adopción registrada con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $adopt = Adoption::find($id);

        if (is_null($adopt)) {
            return redirect()->route('adoptions.index')->with('error', 'Adoption not found.');
        }

        return view('adoptions.show')->with('adopt', $adopt);
    }

    /**
     * Search adoption records.
     */
    public function search(Request $request)
    {
        $adopts = Adoption::names($request->q)
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('adoptions.search')->with('adopts', $adopts);
    }
}
