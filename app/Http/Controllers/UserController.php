<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use Illuminate\Support\Facades\Log;
use App\Imports\UserImport;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);
        // dd($users->toArray());
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'document' => ['required', 'numeric', 'unique:users'],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'photo' => ['required', 'image'],
            'phone' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        $photo = 'no-photo.png'; // valor por defecto

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = time() . '.' . $request->photo->extension();
            try {
                $request->photo->move(public_path('images'), $photo);
            } catch (\Exception $e) {
                Log::error('Error moving uploaded photo (store user): ' . $e->getMessage());
                return back()->with('error', 'Error saving uploaded photo.');
            }
        }

        $user = new User;
    $user->document = $request->document;
    $user->fullname = $request->fullname;
    $user->gender = $request->gender;
    $user->birthdate = $request->birthdate;
    $user->photo = $photo;
    $user->phone = $request->phone;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);

    if ($user->save()) {
        return redirect('users')->with('message', 'The user: ' . $user->fullname . ' was successfully added!.');
    }
}


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validation = $request->validate([
            'document' => ['required', 'numeric', 'unique:users,document,' . $user->id],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ]);

        // process photo if provided
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = time() . '.' . $request->photo->extension();
            try {
                $request->photo->move(public_path('images'), $photo);
            } catch (\Exception $e) {
                Log::error('Error moving uploaded photo (update user): ' . $e->getMessage());
                return back()->with('error', 'Error saving uploaded photo.');
            }
            if ($request->originphoto != 'no-photo.png') {
                @unlink(public_path('images/') . $request->originphoto);
            }
        } else {
            $photo = $request->originphoto ?? $user->photo;
        }
        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo = $photo;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if ($user->save()) {
            return redirect('users')->with('message', 'The user: ' . $user->fullname . ' was successfully edited!.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->photo != 'no-photo.png' && file_exists(public_path('images/').$user->photo)){
            unlink(public_path('images/').$user->photo);
        }
        if ($user->delete()) {
            return redirect('users')->with('message', 'The user: ' . $user->fullname . ' was successfully deleted!.');
        }   
    }

    // Search by Scope
    public function search(Request $request)
    {
        $users = User::names($request->q)->orderBy('id', 'desc')->paginate(20);
        return view('users.search')->with('users', $users);
    }

    // Export PDF
    public function pdf() {
        $users = User::all();
        $pdf = PDF::loadView('users.pdf', compact('users'));
        return $pdf->download('allusers.pdf');
    }
    // Export Excel
    public function excel() {
        return Excel::download(new UserExport, 'allusers.xlsx');
    }
    public function import(Request $request) {
        $request->validate([
            'excel' => ['required', 'file', 'mimes:xlsx,xls,csv']
        ]);
        
        $file = $request->file('excel');
        try {
            Excel::import(new UserImport, $file);
            return redirect()->back()->with('message', 'Users imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }
    
}