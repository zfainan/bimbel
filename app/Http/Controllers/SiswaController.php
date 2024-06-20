<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::latest()->paginate();
        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:30',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:50',
            'no_telp' => 'required|string|max:15',
            'nama_ortu' => 'required|string|max:30',
            'no_telp_ortu' => 'required|string|max:15',
            'pekerjaan_ortu' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:30',
            'kelas' => 'required|string|max:10',
            'status' => 'required|string|max:10',
        ]);

        Siswa::create($request->all());

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
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:30',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:50',
            'no_telp' => 'required|string|max:15',
            'nama_ortu' => 'required|string|max:30',
            'no_telp_ortu' => 'required|string|max:15',
            'pekerjaan_ortu' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:30',
            'kelas' => 'required|string|max:10',
            'status' => 'required|string|max:10',
        ]);

        $siswa->update($request->all());

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
