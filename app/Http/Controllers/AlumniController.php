<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumni = Alumni::with('siswa')->latest()->paginate();
        return view('alumni.index', compact('alumni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswa = Siswa::whereDoesntHave('alumni')->get();

        return view('alumni.create', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:tb_siswa,id_siswa',
            'nilai_ujian' => 'required|numeric',
            'pendidikan_lanjutan' => 'required|string|max:20',
            'tahun_angkatan' => 'required|date_format:Y',
        ]);

        if (Siswa::findOrFail($request->id_siswa)->alumni?->id_alumni) {
            return redirect()->back()
                ->withErrors(['id_siswa' => 'Siswa telah memiliki data alumni'])
                ->withInput();
        }

        Alumni::create($request->all());

        return redirect()->route('alumni.index')
            ->with('success', 'Alumni created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni $alumnus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumnus)
    {
        return view('alumni.edit', [
            'alumni' => $alumnus,
            'siswa' => Siswa::whereDoesntHave('alumni')
                ->orWhere('id_siswa', $alumnus->id_siswa)
                ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumni $alumnus)
    {
        $request->validate([
            'nilai_ujian' => 'required|numeric',
            'pendidikan_lanjutan' => 'required|string|max:20',
            'tahun_angkatan' => 'required|string|max:10',
            'id_siswa' => 'required|exists:tb_siswa,id_siswa',
        ]);

        if (
            $request->id_siswa != $alumnus->id_siswa &&
            Siswa::findOrFail($request->id_siswa)->alumni?->id_alumni
        ) {
            return redirect()->back()
                ->withErrors(['id_siswa' => 'Siswa telah memiliki data alumni'])
                ->withInput();
        }

        $alumnus->update($request->all());

        return redirect()->route('alumni.index')
            ->with('success', 'Alumni updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni $alumnus)
    {
        $alumnus->delete();

        return redirect()->route('alumni.index')
            ->with('success', 'Alumni deleted successfully.');
    }
}
