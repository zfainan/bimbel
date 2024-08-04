<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $countPayment = Siswa::whereHas('payments', function ($builder) {
            $builder->where('tanggal', now()->format('Y-m-d'));
        })->count();

        $countSiswa = Siswa::whereDoesntHave('alumni')->count();

        $payment = Payment::whereBetween('tanggal', [now()->subDays(30)->format('Y-m-d'), now()->format('Y-m-d')])
            ->groupBy('tanggal')
            ->select('tanggal', DB::raw('SUM(jumlah) as jumlah'))
            ->get();

        return view('dashboard', compact('countPayment', 'countSiswa', 'payment'));
    }
}
