<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Kotak;
use App\Models\Data_P3K;
use App\Models\Lemari;
use Illuminate\Http\Request;

class ViewKotakController extends Controller
{
    public function index()
    {
        $kotaks = Kotak::all();
        return view('pages.kotak', compact('kotaks'));
    }

    public function show($id)
    {
        $kotak = Kotak::with('dataP3Ks')->find($id);

        if (!$kotak) {
            return redirect()->route('kotak.index')->with('error', 'Kotak not found');
        }

        return view('pages.isi_kotak', compact('kotak'));
    }

    public function add($id)
    {
        $kotaks = Kotak::find($id);
        // $dataP3Ks = Data_P3K::with('kotaks')->get();
        $dataP3Ks = Data_P3K::all();
        $user = Auth::user();
        return view('pages.add_isi_kotak', compact('kotaks', 'dataP3Ks', 'user'));
    }


    
    public function store(Request $request, $id)
{
    // Validate input
    $request->validate([
        'itemName' => 'required|string|max:255',
        'quantity' => 'required|integer',
        'exp_date' => 'required|date',
        'picture' => 'image|nullable|max:1999'
    ]);

    // Upload image if any
    if ($request->hasFile('picture')) {
        $filenameWithExt = $request->file('picture')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('picture')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('picture')->storeAs('public/pictures', $fileNameToStore);
    } else {
        $fileNameToStore = 'noimage.jpg';
    }

    // Find or create the Data_P3K item based on itemName
    $dataP3K = Data_P3K::find($request->input('itemName'));
    
        // Validate if quantity is sufficient
        if ($dataP3K->quantity < $request->input('quantity')) {
            return redirect()->back()->with('error', 'Insufficient quantity available.');
        }
    
        // If there's a picture, update the picture field
        if ($request->hasFile('picture')) {
            $dataP3K->picture = $fileNameToStore;
            $dataP3K->save();
        }
    
        // Find the Kotak
        $kotak = Kotak::find($id);
    
        // Check if the item already exists in the Kotak's dataP3Ks
        if ($kotak->dataP3Ks()->where('data_p3ks_id', $dataP3K->id)->exists()) {
            // Item already exists, update the quantity
            $existingPivotRow = $kotak->dataP3Ks()->where('data_p3ks_id', $dataP3K->id)->first()->pivot;
            $existingPivotRow->quantity += $request->input('quantity');
            $existingPivotRow->save();
        } else {
            // Item doesn't exist, attach new relation with quantity and exp_date
            $kotak->dataP3Ks()->attach($dataP3K->id, [
                'quantity' => $request->input('quantity'),
                'exp_date' => $request->input('exp_date'),
                'tanggal' => $request->input('tanggal'),
            ]);
        }

    // Save the Data_P3K item
    $dataP3K->quantity -= $request->input('quantity');
    $dataP3K->save();

    return redirect()->route('isi_kotak.add', $id)->with('success', 'Item added successfully');
}

    

    public function destroy($kotakId, $dataP3kId)
    {
        $kotak = Kotak::find($kotakId);

        if (!$kotak) {
            return redirect()->route('kotak.index')->with('error', 'Kotak not found');
        }

        // Hapus relasi dari tabel pivot
        $kotak->dataP3Ks()->detach($dataP3kId);

        return redirect()->route('isi_kotak.detail', $kotakId)->with('success', 'Item removed successfully');
    }

    



}
