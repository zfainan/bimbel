<?php

namespace App\Http\Controllers;

use App\Enums\StatusBayarEnum;
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
            ->whereHas('program')
            ->paginate();

        return view('payment.list-siswa', compact('siswa'));
    }

    public function index(Siswa $siswa)
    {
        $siswa->load('program', 'payments');
        $siswa->append('sisa_bayar');

        $payments = Payment::where('id_siswa', $siswa->id_siswa)
            ->where('id_program', $siswa->id_program)
            ->paginate();

        return view('payment.index', compact('siswa', 'payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Siswa $siswa)
    {
        $siswa->load('program', 'payments');
        $siswa->append('sisa_bayar');

        return view('payment.create', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Siswa $siswa)
    {
        $request->validate([
            'jumlah' => 'numeric|min:0',
            'tanggal' => 'required|date|before_or_equal:today'
        ]);

        if (!$siswa->id_program) {
            return redirect()->route('siswa.payments.index', $siswa)->with('error', 'Siswa does not have program');
        }

        $harga = $siswa->program->harga;
        $sisaBayar = $harga - $siswa->payments->where('id_program', $siswa->id_program)
            ->sum('jumlah') - $request->jumlah;

        Payment::create([
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'sisa_bayar' => $sisaBayar,
            'status' => StatusBayarEnum::Terbayar->value,
            'id_siswa' => $siswa->id_siswa,
            'id_program' => $siswa->id_program,
        ]);

        return redirect()->route('siswa.payments.index', $siswa)->with('success', 'Payment created succesfully');
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
