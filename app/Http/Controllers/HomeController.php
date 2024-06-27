<?php

namespace App\Http\Controllers;
use carbon\carbon;
use App\Models\Input_P3K;
use App\Models\Data_Kotak;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */

     public function index()
     {
         // Mengambil data penggunaan P3K
        $usageData = DB::table('input_p3k')
                       ->select(DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as month"), DB::raw('SUM(quantity) as total_quantity'))
                       ->groupBy('month')
                       ->orderBy('month', 'ASC')
                       ->get();
        $usageData = $usageData->map(function($item) {
            $item->month = Carbon::createFromFormat('Y-m', $item->month)->locale('id')->translatedFormat('F Y');
            return $item;
        });

        $currentMonth = now()->format('Y-m');
        $currentMonthUsage = DB::table('input_p3k')
                            ->where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m')"), $currentMonth)
                            ->sum('quantity');
        $currentMonthRequest = DB::table('data_kotak')
                            ->where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m')"), $currentMonth)
                            ->sum('quantity');

       
         return view('pages.dashboard', compact('usageData', 'currentMonthUsage', 'currentMonthRequest'));
     }

    
}
