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

    
}
