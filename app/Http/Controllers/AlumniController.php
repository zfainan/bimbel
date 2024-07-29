<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Alumni;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AlumniController extends Controller
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
            'tahun_angkatan' => 'required|string|max:10',
        ]);

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
