<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\DayEnum;
use App\Enums\RoleEnum;
use App\Models\JadwalAjar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class JadwalAjarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JadwalAjar::with('tentor')
            ->latest()
            ->paginate();

        return view('jadwal-ajar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $days = DayEnum::toArray();
        $tentor = User::whereHas('jabatan', function ($query) {
            $query->where('role_name', RoleEnum::Tutor->value);
        })->get();

        return view('jadwal-ajar.create', compact('days', 'tentor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_tentor' => 'required|exists:users,id',
            'hari' => ['required', new Enum(DayEnum::class)],
            'jam' => 'required',
        ]);

        JadwalAjar::create($validated);

        return redirect()->route('jadwal-ajar.index')
            ->with('success', 'Jadwal created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalAjar $jadwalAjar)
    {
        $days = DayEnum::toArray();
        $tentor = User::whereHas('jabatan', function ($query) {
            $query->where('role_name', RoleEnum::Tutor->value);
        })->get();

        return view('jadwal-ajar.edit', compact('jadwalAjar', 'days', 'tentor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalAjar $jadwalAjar)
    {
        $validated = $request->validate([
            'id_tentor' => 'required|exists:users,id',
            'hari' => ['required', new Enum(DayEnum::class)],
            'jam' => 'required',
        ]);

        $jadwalAjar->update($validated);

        return redirect()->route('jadwal-ajar.index')
            ->with('success', 'Jadwal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalAjar $jadwalAjar)
    {
        $jadwalAjar->delete();

        return redirect()->route('jadwal-ajar.index')
            ->with('success', 'Jadwal deleted successfully.');
    }
}
