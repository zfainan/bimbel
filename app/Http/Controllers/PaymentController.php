<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatusBayarEnum;
use App\Models\Payment;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            sprintf('role:%s|%s', RoleEnum::Administrator->value, RoleEnum::CentralHead->value)
        )->only(['siswa', 'index', 'download', 'report']);

        $this->middleware(
            sprintf('role:%s', RoleEnum::Administrator->value)
        )->except(['siswa', 'index', 'download', 'report']);
    }

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
            'tanggal' => 'required|date|before_or_equal:today',
        ]);

        if (! $siswa->id_program) {
            return redirect()->route('siswa.payments.index', $siswa)->with('error', 'Siswa does not have program');
        }

        if ($siswa->sisa_bayar < 1) {
            return redirect()->back()->with('error', "Siswa {$siswa->nama} telah melunasi tagihan pembayaran program")->withInput();
        }

        if ($siswa->sisa_bayar < $request->jumlah) {
            return redirect()->back()->with('error', 'Pembayaran tidak dapat melebihi sisa tagihan siswa')->withInput();
        }

        $sisaBayar = $siswa->sisa_bayar - $request->jumlah;

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

    public function report(Request $request)
    {
        $request->validate([
            'since' => 'required|date',
            'until' => 'required|date',
        ]);

        $data = Payment::with(['siswa', 'program'])
            ->whereBetween('tanggal', [$request->since, $request->until])
            ->get();

        $pdf = Pdf::loadView('payment.pdf', compact('data', 'request'));

        return $pdf->download('payments.pdf');
    }

    public function download(Payment $payment)
    {
        $pdf = Pdf::loadView('payment.download', compact('payment'));

        return $pdf->download('faktur.pdf');
    }
}
