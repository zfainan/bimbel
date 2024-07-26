<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pertemuan' => 'required|exists:pertemuan,id',
            'siswa' => 'array|required',
            'siswa.*.id' => 'exists:tb_siswa,id_siswa',
            'siswa.*.hadir' => 'required|boolean',
        ]);

        foreach ($request->get('siswa') as $value) {
            $presensi = Presensi::firstOrCreate([
                'id_pertemuan' => $request->id_pertemuan,
                'id_siswa' => $value['id'],
            ], [
                'waktu' => now(),
                'hadir' => (bool) $value['hadir'],
            ]);

            $presensi->update([
                'waktu' => now(),
                'hadir' => (bool) $value['hadir'],
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil update presensi');
    }
}
