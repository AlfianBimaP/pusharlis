<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Input_P3K;
use App\Models\Kotak;
use App\Models\Data_P3K;
use App\Models\Data_Kotak;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function index()
    {
        $kotaks = Kotak::all();
        $user = Auth::user();
        return view('pages.Input_P3K', compact('kotaks', 'user'));
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
            'keperluan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);


        $dataKotak = Data_Kotak::where('kotak_id', $request->input('kotak'))
                    ->where('data_p3ks_id', $request->input('namaBarang'))
                    ->first();
        if ($dataKotak) {
            if ($dataKotak->quantity < $request->input('quantity')) {
                return back()->withErrors(['quantity' => 'Jumlah yang diminta melebihi jumlah yang tersedia.'])->withInput();
            }

            // Mengurangi quantity dari data_kotak
            $dataKotak->quantity -= $request->input('quantity');
            $dataKotak->save();
        } else {
            return back()->withErrors(['dataKotak' => 'Data Kotak tidak ditemukan.'])->withInput();
        }

        // Menyimpan data ke database
        $inputP3K = new Input_P3K();
        $inputP3K->user_id = Auth::id();
        $inputP3K->kotak_id = $request->input('kotak');
        $inputP3K->data_p3ks_id = $request->input('namaBarang');
        $inputP3K->quantity = $request->input('quantity');
        $inputP3K->keperluan = $request->input('keperluan');
        $inputP3K->tanggal = $request->input('tanggal');

        //namaPJ

        $inputP3K->save();

        // Redirect back dengan pesan sukses
        return back()->with('success', 'Data berhasil ditambahkan');
    }
}
