<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Data_P3K;
use App\Models\Lemari;
use App\Models\Kotak;
use App\Models\User;

use Illuminate\Http\Request;

class LemariController extends Controller
{

    public function index()
    {

        $items = Lemari::with('dataP3K')->get(); 
        return view('pages.Lemari_stock', compact('items'));
    }

    public function show()
    {
        $dataP3Ks = Data_P3K::all();
        $kotak = Lemari::all();
        $Boxs = Kotak::all();
        $user = Auth::user();

        return view('pages.add_isi_lemari', compact('dataP3Ks', 'kotak', 'Boxs', 'user'));
    }



    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'userName' => 'required',
            'itemName' => 'required|exists:data_p3ks,id',
            'quantity' => 'required|integer|min:0',
            'exp_date' => 'required|date',
            'tanggal' => 'required|date',
        ]);

        // Ambil user berdasarkan username
        $user = User::where('username', $request->userName)->first();

        $inputP3K = new Lemari();
        $inputP3K->user_id = Auth::id();
        $inputP3K->data_p3ks_id = $request->input('itemName');
        $inputP3K->quantity = $request->input('quantity');
        $inputP3K->exp_date = $request->input('exp_date');
        $inputP3K->tanggal = $request->input('tanggal');

        

        $inputP3K->save();
        

        return redirect()->route('lemari.index')->with('success', 'Item added successfully.');
    }

    public function destroy($kotakId, $lemariId)
    {
        // $items = lemari::find($id);
        $kotak = Kotak::find($kotakId);

        $kotak->dataP3Ks()->detach($lemariId);
        // $items->kotaks()->detach($dataP3kId);

        return redirect()->route('lemari.index', $kotakId)->with('success', 'Item removed successfully');
    }
}