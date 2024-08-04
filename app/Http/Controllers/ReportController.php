<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Alumni;
use App\Models\JadwalAjar;
use App\Models\Payment;
use App\Models\Program;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            sprintf('role:%s|%s', RoleEnum::Administrator->value, RoleEnum::CentralHead->value)
        );
    }

    public function downloadPayments(Request $request)
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

    public function createPresensi(Request $request)
    {
        $program = Program::all();

        return view('reports.presensi.create', compact('program'));
    }

    public function downloadPresensi(Request $request)
    {
        $request->validate([
            'id_program' => 'required|exists:tb_program,id_program',
        ]);

        $data = JadwalAjar::with(['tentor', 'program', 'branch', 'pertemuan.presensi.siswa'])
            ->where('id_program', $request->id_program)
            ->get();

        $pdf = Pdf::loadView('reports.presensi.pdf', compact('data'));

        return $pdf->download('presensi.pdf');
    }

    public function downloadAlumni(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric|min_digits:4|max_digits:4',
        ]);

        $data = Alumni::with(['siswa'])
            ->where('tahun_angkatan', $request->year)
            ->get();

        $pdf = Pdf::loadView('reports.alumni.pdf', compact('data', 'request'));

        return $pdf->download('alumni.pdf');
    }
}
