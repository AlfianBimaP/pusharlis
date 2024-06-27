<?php

namespace App\Http\Controllers;

use App\Models\kotak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KotakP3KController extends Controller
{
    public function index(){
        $kotaks = kotak::all(); // Mengambil semua data user dari database
        // dd($kotaks);
        return view('pages.Kotak_P3K', compact('kotaks'));
    }
    
    // public function show($id){
    //     $users = Users::find($id);
    //     return view('pages.show_user', compact('users'));
        
    // }

    // public function update(Request $request, $id)
    // {
    //     $user = Users::find($id);
    //     $user->update($request->all());
    //     session()->flash('success', 'User updated successfully.'); // Menyimpan informasi ke session
    //     return redirect()->route('view_user.index');
    // }
    
    public function delete($id)
    {
        $kotak = kotak::find($id);
        $kotak->delete();
        session()->flash('success', 'User updated successfully.'); // Menyimpan informasi ke session
        return redirect()->route('kotak_p3k.index');
    }

    public function add(){
        return view('pages.add_kotak');
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
        ]);

        // Debugging log
        
 
        $kotak = new kotak();
        $kotak->nama_kotak = $request->input('username');



        $kotak->save();

        // Debugging log
        

        return redirect()->route('kotak_p3k.index')->with('success', 'data added successfully');
    }

    
}
