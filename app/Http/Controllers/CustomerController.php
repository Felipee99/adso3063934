<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // customer
    public function myprofile()
    {
        $user = User::find(Auth::user()->id);
        // dd($user->toArray());
        return view('customer.myprofile')->with('user', $user);
    }
    public function updatemyprofile(Request $request)
    {
        $validation = $request->validate([
            'document' => ['required', 'numeric', 'unique:users,document,' . $request->id],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $request->id],
        ]);

        $user = User::find($request->id);
        $photo = $user->photo;

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = time() . '.' . $request->photo->extension();
            try {
                $request->photo->move(public_path('images/'), $photo);
            } catch (\Exception $e) {
                Log::error('Error moving uploaded photo (customer update): ' . $e->getMessage());
                return back()->with('error', 'Error saving uploaded photo.');
            }
            if ($user->photo != 'no-photo.png') {
                $oldPhotoPath = public_path('images/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    @unlink($oldPhotoPath);
                }
            }
        }

        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo = $photo;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if ($user->save()) {
            return redirect('dashboard')->with('message', 'My profile was successfully edited!.');
        }
    }
    public function myadoptions()
    {
        $adopts = Adoption::where('user_id', Auth::user()->id)->get();
        return view('customer.myadoptions')->with('adopts', $adopts);
    }

    public function showadoptions(Request $request)
    {
        $adopts = Adoption::find($request->id);
        return view('customer.showadoption')->with('adopts', $adopts);
    }
    public function listpets()
    {
        $pets = Pet::where('status', 0)->orderBy('id', 'DESC')->paginate(20);
        return view('customer.makeadoptions')->with('pets', $pets);
    }
    public function listadoptions(Request $request) {}

    public function confirmadoptions($id)
    {
        $pet = Pet::findOrFail($id);
        return view('customer.confirmadoption')->with('pet', $pet);
        
    }

    public function makeadoptions(Request $request, $id)
    {
        $user = Auth::user();
        $pet = Pet::findOrFail($id);

        if ($pet->status == 1) {
            return redirect('makeadoptions')->with('error', 'This pet is already adopted.');
        }

        try {
            $adoption = new Adoption();
            $adoption->user_id = $user->id;
            $adoption->pet_id = $pet->id;
            $adoption->save();

            $pet->status = 1; // mark adopted
            $pet->save();

            return redirect('makeadoptions')->with('message', 'Adoption completed successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating adoption: ' . $e->getMessage());
            return redirect('makeadoptions')->with('error', 'There was an error processing the adoption.');
        }
    }
    public function search(Request $request)
    {
        $pets = Pet::kinds($request->q)->orderBy('id', 'desc')->paginate(20);
        return view('customer.search')->with('pets', $pets);
    }
}
