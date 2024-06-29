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
                ->get(),
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
            'tahun_angkatan' => 'required|string|max:10'
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
