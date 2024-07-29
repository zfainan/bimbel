<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Alumni;
use App\Models\JadwalAjar;
use App\Models\Payment;
use App\Models\Pertemuan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ReportController extends Controller
{
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
        $request->validate([
            'id_tentor' => 'nullable|exists:users,id',
        ]);

        $tentor = User::whereHas('jabatan', fn ($builder) => $builder->where('role_name', RoleEnum::Tutor->value))
            ->get();
        $selectedTentor = null;
        $jadwal = null;

        if ($request->filled('id_tentor')) {
            $selectedTentor = User::whereId($request->id_tentor)
                ->whereHas('jabatan', fn ($builder) => $builder->where('role_name', RoleEnum::Tutor->value))
                ->first();

            if ($selectedTentor?->id) {
                $jadwal = JadwalAjar::with(['program'])
                    ->where('id_tentor', $selectedTentor?->id)->get();
            }
        }

        return view('reports.presensi.create', compact('tentor', 'jadwal', 'selectedTentor'));
    }

    public function downloadPresensi(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_ajar,id',
        ]);

        $jadwal = JadwalAjar::with(['tentor', 'program', 'branch'])
            ->findOrFail($request->id_jadwal);

        /** @var Collection $data */
        $data = Pertemuan::with(['presensi.siswa'])
            ->where('id_jadwal', $request->id_jadwal)
            ->get();

        $pdf = Pdf::loadView('reports.presensi.pdf', compact('data', 'jadwal'));

        return $pdf->download('presensi.pdf');
    }

    public function downloadAlumni(Request $request)
    {
        $request->validate([
            'since' => 'required|date',
            'until' => 'required|date',
        ]);

        $data = Alumni::with(['siswa'])
            ->whereBetween('created_at', [$request->since, $request->until])
            ->get();

        $pdf = Pdf::loadView('reports.alumni.pdf', compact('data', 'request'));

        return $pdf->download('alumni.pdf');
    }
}
