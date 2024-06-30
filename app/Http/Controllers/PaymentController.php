<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Program;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function siswa(Request $request)
    {
        $siswa = Siswa::when($request->filled('keyword'), function (Builder $query) {
            $keyword = request()->input('keyword');

            $query->where('nama', 'like', "%$keyword%")
                ->orWhere('kelas', $keyword);
        })
            ->when($request->filled('id_program'), function (Builder $query) {
                $query->where('id_program', request()->input('id_program'));
            })
            ->paginate();

        return view('payment.list-siswa', compact('siswa'));
    }

    public function index(Siswa $siswa)
    {
        $payments = Payment::where('id_siswa', $siswa->id_siswa)
            ->paginate();

        return view('payment.index', compact('siswa', 'payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Siswa $siswa)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Siswa $siswa)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa, Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa, Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa, Payment $payment)
    {
        //
    }
}
