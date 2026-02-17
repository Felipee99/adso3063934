<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/pets/list
     */
    public function index()
    {
        $pets = Pet::all();

        if ($pets->isEmpty()) {
            return response()->json(['message' => 'No pets found 🐾'], 404);
        } else {
            return response()->json([
                'mesagge' => 'Successfull Query 🐶',
                'pets' => $pets
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/pets/store
     */
    public function store(Request $request)
    {
        try {
            $validation = $request->validate([
                'name'          => ['required', 'string'],
                'kind'          => ['required'],
                'weight'        => ['required', 'numeric'],
                'age'           => ['required', 'numeric'],
                'breed'         => ['required'],
                'location'      => ['required'],
                'description'   => ['required'],
            ]);
            $pet = Pet::create($request->all());
            return response()->json([
                'mesagge' => 'Pet was Successfully added! 🐶',
                'data' => $pet

            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Error in the request',
                'Errors' => $e->errors()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     * GET /api/pets/show/{id}
     */
    public function show(Request $request)
    {
        $pet = Pet::find($request->id);
        if ($pet) {
            return response()->json([
                'message' => 'Successfull Query 😈',
                'pet' => $pet
            ], 200);
        } else {
            return response()->json(['error' => 'Pet not found 🐾'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/pets/edit/{id}
     */
    public function update(Request $request, $id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json(['error' => 'Pet not found 🐾'], 404);
        }

        try {
            $validation = $request->validate([
                'name'        => ['sometimes', 'string'],
                'kind'        => ['sometimes'],
                'weight'      => ['sometimes', 'numeric'],
                'age'         => ['sometimes', 'numeric'],
                'breed'       => ['sometimes'],
                'location'    => ['sometimes'],
                'description' => ['sometimes'],
            ]);

            $pet->update($request->all());

            return response()->json([
                'message' => 'Pet updated successfully! 🐶',
                'pet' => $pet
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Error in the request',
                'Errors' => $e->errors()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/pets/delete/{id}
     */
    public function destroy(Request $request)
    {
        $pet = Pet::find($request->id);
        if ($pet) {
            if ($pet->delete()) {
                return response()->json([
                    'message' => 'Pet was successfull deleted!',
                    'pet' => $pet
                ], 200);
            }
        } else {
            return response()->json(['error' => 'Pet not found 🐾'], 404);
        }
    }
}