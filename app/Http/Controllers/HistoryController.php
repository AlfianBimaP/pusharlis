<?php

namespace App\Http\Controllers;


use App\Models\Input_P3K;
use Illuminate\Support\Facades\Auth;
use App\Models\Request_P3K;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller
{


    public function index(Request $request)
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $month = $request->input('month', $currentMonth);
        $year = $request->input('year', $currentYear);
        $user = $request->user();
        

        if ($user->role == 'admin') {
            // Admin can see all data
            $inputItems = Input_P3K::with('user')
                ->whereMonth('tanggal', $month)
                ->whereYear('tanggal', $year)
                ->get();
        } else {
            // Non-admin users can see only their data
            $inputItems = Input_P3K::with('user')
                ->whereMonth('tanggal', $month)
                ->whereYear('tanggal', $year)
                ->where('user_id', $user->id)
                ->get();
        }

        // if ($month && $year) {
        //     $inputItems = Input_P3K::whereMonth('tanggal', $month)
        //         ->whereYear('tanggal', $year)
        //         ->where('user_id', $user->id) 
        //         ->with('user')  // Load relasi user
        //         ->get();

        // } else {
        //     $inputItems = Input_P3K::with('user')  // Load relasi user
        //         ->get();
        // }

        $requestItems = Request_P3K::all();
        return view('pages.history', compact('inputItems', 'requestItems', 'currentMonth', 'currentYear'));
    }

    public function show(Request $request)
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $month = $request->input('month', $currentMonth);
        $year = $request->input('year', $currentYear);
        $user = $request->user();

        if ($month && $year) {
            $requestItems = Request_P3K::whereMonth('tanggal', $month)
                ->whereYear('tanggal', $year)
                ->where('user_id', $user->id) 
                ->with('user')  // Load relasi user
                ->get();
        } else {
            $requestItems = Request_P3K::with('user')
                ->get();
        }

        return view('pages.history_request', compact('requestItems', 'currentMonth', 'currentYear'));
    }



}

