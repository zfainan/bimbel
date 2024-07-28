<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function payments(Request $request)
    {
        $request->validate([
            'since' => 'required|date',
            'until' => 'required|date',
        ]);

        $data = Payment::with(['siswa', 'program'])
            ->whereBetween('tanggal', [$request->since, $request->until])
            ->get();

        $pdf = Pdf::loadView('payment.pdf', compact('data', 'request'));

        return $pdf->download('payments.pdf');
    }
}
