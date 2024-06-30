@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Daftar Pembayaran Siswa</h1>

    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    @session('error')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Status</th>
                        <th scope="col">Sisa Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $item)
                        <tr>
                            <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->sisa_bayar }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $payments->links() }}
        </div>
    </div>
@endsection
