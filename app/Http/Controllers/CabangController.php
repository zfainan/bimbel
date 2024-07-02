<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cabang = Cabang::latest()->paginate();

        return view('cabang.index', compact('cabang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cabang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        Cabang::create($request->all());

        return redirect()
            ->route('cabang.index')
            ->with('success', 'Cabang created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cabang $cabang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabang $cabang)
    {
        return view('cabang.edit', compact('cabang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabang $cabang)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $cabang->update($request->all());

        return redirect()
            ->route('cabang.index')
            ->with('success', 'Cabang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabang $cabang)
    {
        if (Cabang::count() < 2) {
            return redirect()
                ->route('cabang.index')
                ->with('error', 'Sistem harus memiliki setidaknya 1 cabang');
        }

        $cabang->delete();

        return redirect()->route('cabang.index')
            ->with('success', 'Cabang deleted successfully.');
    }
}
