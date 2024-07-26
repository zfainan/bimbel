<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\JadwalAjar;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function jadwal()
    {
        $query = JadwalAjar::with(['tentor', 'program']);

        if (auth()->user()->jabatan?->role_name == RoleEnum::Tutor->value) {
            $query->where('id_tentor', auth()->user()->id);
        }

        $data = $query->get();

        return view('pertemuan.jadwal', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, JadwalAjar $jadwal)
    {
        if (
            auth()->user()->jabatan?->role_name == RoleEnum::Tutor->value &&
            auth()->user()->id != $jadwal->id_tentor
        ) {
            return redirect()->route('jadwal.pertemuan');
        }

        $data = Pertemuan::where('id_jadwal', $jadwal->id)
            ->oldest()
            ->paginate();

        return view('pertemuan.index', compact('data', 'jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(JadwalAjar $jadwal)
    {
        if (
            auth()->user()->jabatan?->role_name != RoleEnum::Tutor->value ||
            auth()->user()->id != $jadwal->id_tentor
        ) {
            return redirect()->route('jadwal.pertemuan.index', $jadwal);
        }

        return view('pertemuan.create', compact('jadwal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, JadwalAjar $jadwal)
    {
        if (
            auth()->user()->jabatan?->role_name != RoleEnum::Tutor->value ||
            auth()->user()->id != $jadwal->id_tentor
        ) {
            return redirect()->route('jadwal.pertemuan.index', $jadwal);
        }

        $request->validate(['tanggal' => 'required']);

        DB::transaction(function () use ($request, $jadwal) {
            $pertemuan = Pertemuan::create([
                'tanggal' => $request->tanggal,
                'id_jadwal' => $jadwal->id,
            ]);

            foreach ($jadwal->program->siswa as $value) {
                Presensi::firstOrCreate([
                    'id_pertemuan' => $pertemuan->id,
                    'id_siswa' => $value->id_siswa,
                ], [
                    'waktu' => now(),
                    'hadir' => false,
                ]);
            }
        });

        return redirect()->route('jadwal.pertemuan.index', $jadwal)->with('success', 'Berhasil menambah pertemuan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalAjar $jadwal, Pertemuan $pertemuan)
    {
        $hasEditAccess = auth()->user()->jabatan?->role_name == RoleEnum::Tutor->value &&
            auth()->user()->id == $jadwal->id_tentor;
        $pertemuan->load('presensi.siswa');

        return view('pertemuan.show', compact('jadwal', 'pertemuan', 'hasEditAccess'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalAjar $jadwal, Pertemuan $pertemuan)
    {
        if (
            auth()->user()->jabatan?->role_name != RoleEnum::Tutor->value ||
            auth()->user()->id != $jadwal->id_tentor
        ) {
            return redirect()->route('jadwal.pertemuan.index', $jadwal);
        }

        return view('pertemuan.edit', compact('jadwal', 'pertemuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalAjar $jadwal, Pertemuan $pertemuan)
    {
        if (
            auth()->user()->jabatan?->role_name != RoleEnum::Tutor->value ||
            auth()->user()->id != $jadwal->id_tentor
        ) {
            return redirect()->route('jadwal.pertemuan.index', $jadwal);
        }

        $request->validate(['tanggal' => 'required']);

        $pertemuan->update([
            'tanggal' => $request->tanggal,
            'id_jadwal' => $jadwal->id,
        ]);

        return redirect()->route('jadwal.pertemuan.index', $jadwal)->with('success', 'Berhasil mengubah pertemuan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalAjar $jadwal, Pertemuan $pertemuan)
    {
        if (
            auth()->user()->jabatan?->role_name != RoleEnum::Tutor->value ||
            auth()->user()->id != $jadwal->id_tentor
        ) {
            return redirect()->route('jadwal.pertemuan.index', $jadwal);
        }

        $pertemuan->delete();

        return redirect()->route('jadwal.pertemuan.index', $jadwal)->with('success', 'Berhasil menghapus pertemuan');
    }
}
