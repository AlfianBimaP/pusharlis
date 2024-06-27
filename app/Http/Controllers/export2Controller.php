<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Input_P3K;
use App\Models\Kotak;
use Barryvdh\DomPDF\Facade\Pdf;

class export2Controller extends Controller
{
    // public function show($id)
    // {
    //     // $inputItems = Input_P3K::all();
    //     // $inputItems = Input_P3K::with(['user', 'kotak', 'datap3ks'])->get();
    //     $kotaks = Kotak::with('dataP3Ks')->find($id);
    //     return view('pages.PDF2', compact('kotaks'));
    // }

    public function exportForm()
    {
        $kotaks = Kotak::all();
        return view('pages.exportInspeksi', compact('kotaks'));
    }

    public function exportPdf2(Request $request, $id)
    {
        // Retrieve filter inputs
        // $month = $request->input('month');
        // $year = $request->input('year');

        // Filter data by month and year
        $kotaks = Kotak::with('dataP3Ks')->find($id);


        // encode Logo PLN
        $path = base_path('public/img/Logo_PLN.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // encode Logo K3
        $path1 = base_path('public/img/Logo_HSE.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('pages.PDF2', compact('pic', 'pic1', 'kotaks'));

        return $pdf->stream('coba.pdf');
    }
}
