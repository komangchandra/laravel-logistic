<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Unit;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $daysInMonth = Carbon::now()->daysInMonth;
        $labels = range(1, $daysInMonth);

        // Remark yang diinginkan
        $remarksList = ['Coal Getting', 'Coal Hauling', 'CCP', 'OB Removal'];

        // Ambil total volume per hari dan per remark
        $transactions = Transaction::select(
            DB::raw('DAY(transaction_date) as day'),
            DB::raw("CASE 
                            WHEN remarks IN ('Coal Getting','Coal Hauling','CCP','OB Removal') 
                            THEN remarks ELSE 'Lainnya' END as remark"),
            DB::raw('SUM(volume) as total_volume')  // <-- hitung total volume
        )
            ->whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month)
            ->groupBy('day', 'remark')
            ->orderBy('day')
            ->get();

        // Siapkan array data per remark
        $data = [];
        $allRemarks = array_merge($remarksList, ['Lainnya']);

        foreach ($allRemarks as $remark) {
            $series = [];
            foreach ($labels as $day) {
                $match = $transactions->firstWhere(function ($item) use ($day, $remark) {
                    return $item->day == $day && $item->remark == $remark;
                });
                $series[] = $match ? $match->total_volume : 0; // <-- gunakan total_volume
            }
            $data[$remark] = $series;
        }

        // Variabel lain untuk small box
        $unitsCount = Unit::count();
        $transactionsCountYear = Transaction::whereYear('transaction_date', $year)->count();
        $transactionsCountMonth = Transaction::whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month)->count();
        $transactionsCountNow = Transaction::whereDate('transaction_date', Carbon::today())->count();

        return view('dashboard.index', compact(
            'unitsCount',
            'transactionsCountYear',
            'transactionsCountMonth',
            'transactionsCountNow',
            'labels',
            'data'
        ));
    }
}
