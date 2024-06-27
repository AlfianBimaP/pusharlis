<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index(){
        $users = Users::all(); // Mengambil semua data user dari database
        return view('pages.user-management', compact('users'));
    }
    
    public function show($id){
        $users = Users::find($id);
        return view('pages.show_user', compact('users'));
        
    }

    public function update(Request $request, $id)
    {
        $user = Users::find($id);
        $user->update($request->all());
        session()->flash('success', 'User updated successfully.'); // Menyimpan informasi ke session
        return redirect()->route('view_user.index');
    }
    
    public function delete($id)
    {
        $user = Users::find($id);
        $user->delete();
        session()->flash('success', 'User updated successfully.'); // Menyimpan informasi ke session
        return redirect()->route('view_user.index');
    }

    public function add(){
        return view('pages.add_user');
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'role' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Debugging log
        
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('pictures');
        }

        $user = new Users();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->role = $request->input('role');
        $user->picture = $picturePath;


        $user->save();

        // Debugging log
        

        return redirect()->route('view_user.index')->with('success', 'User added successfully');
    }
}
