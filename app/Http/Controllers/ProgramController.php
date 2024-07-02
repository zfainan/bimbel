<?php

namespace App\Http\Controllers;

use App\Enums\StatusSiswaEnum;
use App\Models\Program;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $program = Program::latest()->paginate();

        return view('program.index', compact('program'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string|max:255',
        ]);

        Program::create($request->all());

        return redirect()
            ->route('program.index')
            ->with('success', 'Program created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        $siswa = Siswa::where('status', StatusSiswaEnum::Aktif->value)
            ->whereDoesntHave('program')
            ->get();

        return view('program.show', compact('program', 'siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('program.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string|max:255',
        ]);

        $program->update($request->all());

        return redirect()
            ->route('program.index')
            ->with('success', 'Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        if (count($program->siswa)) {
            return redirect()->route('program.index')
                ->with('error', 'Program has siswa.');
        }

        $program->delete();

        return redirect()->route('program.index')
            ->with('success', 'Program deleted successfully.');
    }

    public function addSiswa(Request $request, Program $program)
    {
        $request->validate([
            'siswa' => 'nullable|array',
            'siswa.*' => 'exists:tb_siswa,id_siswa'
        ]);

        DB::transaction(function () use ($request, $program) {
            Siswa::whereIn('id_siswa', $request->siswa)
                ->update([
                    'id_program' => $program->id_program
                ]);
        });

        return redirect()->route('program.show', $program)
            ->with('success', 'Siswa updated successfully.');
    }

    public function removeSiswa(Program $program, Siswa $siswa)
    {
        $siswa->program()->disassociate()->save();

        return redirect()->route('program.show', $program)
            ->with('success', 'Siswa removed successfully.');
    }
}
