<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatusSiswaEnum;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            sprintf('role:%s|%s', RoleEnum::Administrator->value, RoleEnum::CentralHead->value)
        )->only(['index', 'show']);
        $this->middleware(
            sprintf('role:%s', RoleEnum::Administrator->value)
        )->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::whereNot('status', StatusSiswaEnum::Alumni->value)
            ->latest()
            ->paginate();

        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = StatusSiswaEnum::toArray();

        return view('siswa.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:30',
            'tgl_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:50',
            'no_telp' => 'required|string|max:15',
            'nama_ortu' => 'required|string|max:30',
            'no_telp_ortu' => 'required|string|max:15',
            'pekerjaan_ortu' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:30',
            'kelas' => 'required|string|max:10',
            'status' => ['required', Rule::enum(StatusSiswaEnum::class)],
            // if siswa is set to alumni
            'nilai_ujian' => sprintf(
                'required_if:status,%s|numeric',
                StatusSiswaEnum::Alumni->value
            ),
            'pendidikan_lanjutan' => sprintf(
                'required_if:status,%s|string|max:20',
                StatusSiswaEnum::Alumni->value
            ),
            'tahun_angkatan' => sprintf(
                'required_if:status,%s|string|max_digits:4',
                StatusSiswaEnum::Alumni->value
            ),
        ]);

        DB::transaction(function () use ($request) {
            Siswa::create($request->except('nilai_ujian', 'pendidikan_lanjutan', 'tahun_angkatan'));
        });

        return redirect()->route('siswa.index')
            ->with('success', 'Siswa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $status = StatusSiswaEnum::toArray();

        return view('siswa.edit', compact('siswa', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:30',
            'tgl_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:50',
            'no_telp' => 'required|string|max:15',
            'nama_ortu' => 'required|string|max:30',
            'no_telp_ortu' => 'required|string|max:15',
            'pekerjaan_ortu' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:30',
            'kelas' => 'required|string|max:10',
            'status' => ['required', Rule::enum(StatusSiswaEnum::class)],
            // if siswa is set to alumni
            'nilai_ujian' => sprintf(
                'required_if:status,%s|numeric',
                StatusSiswaEnum::Alumni->value
            ),
            'pendidikan_lanjutan' => sprintf(
                'required_if:status,%s|string|max:20',
                StatusSiswaEnum::Alumni->value
            ),
            'tahun_angkatan' => sprintf(
                'required_if:status,%s|string|max_digits:4',
                StatusSiswaEnum::Alumni->value
            ),
        ]);

        DB::transaction(function () use ($request, $siswa) {
            $siswa->update($request->except('nilai_ujian', 'pendidikan_lanjutan', 'tahun_angkatan'));
        });

        return redirect()->route('siswa.index')
            ->with('success', 'Siswa updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Siswa deleted successfully.');
    }
}
