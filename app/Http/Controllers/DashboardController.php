<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Transaction;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $unitsCount = Unit::count();
        $stationsCount = Station::count();
        $transactionsCount = Transaction::count();
        $transactionsCountNow = Transaction::whereDate('transaction_date', Carbon::today())->count();
        return view('dashboard.index', compact('unitsCount', 'stationsCount', 'transactionsCount', 'transactionsCountNow'));
    }
}
