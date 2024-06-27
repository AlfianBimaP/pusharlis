<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kotak;
use App\Models\Request_P3K;
use App\Models\Data_P3K;
use Illuminate\Support\Facades\Storage;

class RequestP3KController extends Controller
{
    public function index(){
        $kotaks = Kotak::all();
        $user = Auth::user();
        $items = Data_P3K::all();
        return view('pages.request_P3K', compact('kotaks', 'user', 'items'));
    }

    public function getItemsByKotakId($kotakId)
    {
        $items = Kotak::with('dataP3Ks')->find($kotakId)->dataP3Ks;
        return response()->json($items);
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'namaPJ' => 'required|string|max:255',
            'kotak' => 'required|exists:kotaks,id',
            'namaBarang' => 'required|exists:data_p3ks,id',
            'quantity' => 'required|integer', 
            'tanggal' => 'required|date',
        ]);

        // Menyimpan data ke database
        $requestp3k = new Request_P3K();
        $requestp3k->user_id = Auth::id();
        $requestp3k->kotak_id = $request->input('kotak');
        $requestp3k->data_p3ks_id = $request->input('namaBarang');
        $requestp3k->quantity = $request->input('quantity');
        $requestp3k->tanggal = $request->input('tanggal');

        $requestp3k->save();

        // Redirect back dengan pesan sukses
        return back()->with('success', 'Request berhasil ditambahkan');
    }

    
}
