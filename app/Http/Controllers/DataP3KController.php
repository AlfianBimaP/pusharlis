<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Data_P3K;
use Illuminate\Support\Facades\Storage;

class DataP3KController extends Controller
{
    public function index()
    {
        $items = Data_P3K::all(); // Mengambil semua data user dari database
        $itemsExpiringSoon = $this->getItemsExpiringSoon($items);

        return view('pages.data_P3K', compact('items', 'itemsExpiringSoon'));
    }

    public function show($id)
    {
        $items = Data_P3K::find($id);
        return view('pages.show_DataP3K', compact('items'));
    }



    public function update(Request $request, $id)
    {
        $items = Data_P3K::find($id);

        // Validasi data
        $request->validate([
            'itemName' => 'required|string|max:255',
            // 'quantity' => 'required|integer',
            // 'exp_date' => 'required|date',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menyimpan gambar jika ada
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('pictures', 'public');
            $items->picture = $picturePath;
        }

        // Update data item di database
        $items->item_name = $request->input('itemName');
        // $items->quantity = $request->input('quantity');
        // $items->exp_date = $request->input('exp_date');
        $items->save();

        // Redirect dengan pesan sukses
        session()->flash('success', 'Item updated successfully.'); // Menyimpan informasi ke session
        return redirect()->route('data_p3k.index');
    }

    // public function store(Request $request)
    // {
    //     // Validasi data
    //     $request->validate([
    //         'itemName' => 'required|string|max:255',
    //         'quantity' => 'required|integer',
    //         'exp_date' => 'required|date',
    //         'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Cek apakah item sudah ada berdasarkan nama
    //     $existingItem = Data_P3K::where('item_name', $request->input('item_name'))->first();

    //     if ($existingItem) {
    //         // Item sudah ada, tambahkan quantity
    //         $existingItem->quantity += $request->input('quantity');
    //         $existingItem->save();

    //         // Menyimpan gambar jika ada
    //         if ($request->hasFile('picture')) {
    //             $picturePath = $request->file('picture')->store('pictures', 'public');
    //             $existingItem->picture = $picturePath;
    //             $existingItem->save();
    //         }

    //         // Redirect dengan pesan sukses
    //         return redirect()->route('data_p3k.index')->with('success', 'Quantity updated successfully');
    //     } else {
    //         // Item belum ada, buat item baru
    //         $items = new Data_P3K();
    //         $items->item_name = $request->input('itemName');
    //         $items->quantity = $request->input('quantity');
    //         $items->exp_date = $request->input('exp_date');

    //         // Menyimpan gambar jika ada
    //         if ($request->hasFile('picture')) {
    //             $picturePath = $request->file('picture')->store('pictures', 'public');
    //             $items->picture = $picturePath;
    //         }

    //         $items->save();

    //         // Redirect dengan pesan sukses
    //         return redirect()->route('data_p3k.index')->with('success', 'Item added successfully');
    //     }
    // }

    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'itemName' => 'required|string|max:255',
        'quantity' => 'required|integer',
        'exp_date' => 'required|date',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Cek apakah item sudah ada berdasarkan nama
    $existingItem = Data_P3K::where('item_name', $request->input('itemName'))->first();

    if ($existingItem) {
        // Item sudah ada, tambahkan quantity yang baru
        $existingItem->quantity += $request->input('quantity');

        // Update exp_date dengan yang baru
        $existingItem->exp_date = $request->input('exp_date');

        // Menyimpan gambar jika ada
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('pictures', 'public');
            $existingItem->picture = $picturePath;
        }

        $existingItem->save();

        // Redirect dengan pesan sukses
        return redirect()->route('data_p3k.index')->with('success', 'Quantity updated successfully');
    } else {
        // Item belum ada, buat item baru
        $items = new Data_P3K();
        $items->item_name = $request->input('itemName');
        $items->quantity = $request->input('quantity');
        $items->exp_date = $request->input('exp_date');

        // Menyimpan gambar jika ada
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('pictures', 'public');
            $items->picture = $picturePath;
        }

        $items->save();

        // Redirect dengan pesan sukses
        return redirect()->route('data_p3k.index')->with('success', 'Item added successfully');
    }
}


    public function delete($id)
    {
        // Cari item berdasarkan ID
        $item = Data_P3K::find($id);

        if (!$item) {
            // Item tidak ditemukan
            return redirect()->route('data_p3k.index')->with('error', 'Item not found');
        }

        // Hapus gambar jika ada
        if ($item->picture && $item->picture != 'noimage.jpg') {
            \Storage::delete('public/' . $item->picture);
        }

        // Hapus item dari database
        $item->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('data_p3k.index')->with('success', 'Item deleted successfully');
    }

    private function getItemsExpiringSoon($items)
    {
        $itemsExpiringSoon = [];

        foreach ($items as $item) {
            $expDate = Carbon::parse($item->exp_date);
            $daysUntilExpiration = $expDate->diffInDays(Carbon::now());

            if ($daysUntilExpiration <= 7 && $daysUntilExpiration >= 0) {
                $item->days_until_expiration = $daysUntilExpiration;
                $itemsExpiringSoon[] = $item;
            }
        }

        return $itemsExpiringSoon;
    }
}
