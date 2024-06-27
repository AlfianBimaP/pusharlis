<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Input_P3K;
use Barryvdh\DomPDF\Facade\Pdf;

class exportController extends Controller
{
    public function show()
    {
        // $inputItems = Input_P3K::all();
        $inputItems = Input_P3K::with(['user', 'kotak', 'datap3ks'])->get();
        return view('pages.PDF', compact('inputItems'));
    }

    public function exportPdf(Request $request)
    {
        // Retrieve filter inputs
        $month = $request->input('month');
        $year = $request->input('year');

        // Filter data by month and year
        $inputItems = Input_P3K::whereMonth('tanggal', $month)
                                ->whereYear('tanggal', $year)
                                ->get();

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
                  ->loadView('pages.PDF', compact('pic', 'pic1', 'inputItems'));

        return $pdf->stream('coba.pdf');
    }
}
