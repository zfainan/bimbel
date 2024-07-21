@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('payments.list-siswa') }}">Pembayaran</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $siswa->nama }}</li>
    </ol>
@endsection

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3">Daftar Pembayaran Siswa</h1>
        <a href="{{ route('siswa.payments.create', $siswa) }}" class="btn btn-primary my-auto"><i
                class="cil-plus icon me-2"></i> Tambah Pembayaran</a>
    </div>

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

    <div class="pb-4 pt-2">
        <ul class="list-group">
            <li class="list-group-item">
                <small>Nama Siswa</small>
                <p class="mb-0">{{ $siswa->nama }}</p>
            </li>
            <li class="list-group-item">
                <small>Kelas</small>
                <p class="mb-0">{{ $siswa->kelas }}</p>
            </li>
            <li class="list-group-item">
                <small>Jenis Kelamin</small>
                <p class="mb-0">{{ $siswa->jenis_kelamin }}</p>
            </li>
            <li class="list-group-item">
                <small>Alamat</small>
                <p class="mb-0">{{ $siswa->alamat }}</p>
            </li>
            <li class="list-group-item">
                <small>No. Telepon</small>
                <p class="mb-0">{{ $siswa->no_telp }}</p>
            </li>
            <li class="list-group-item">
                <small>Nama Orang Tua</small>
                <p class="mb-0">{{ $siswa->nama_ortu }}</p>
            </li>
            <li class="list-group-item">
                <small>No. Telepon Orang Tua</small>
                <p class="mb-0">{{ $siswa->no_telp_ortu }}</p>
            </li>
            <li class="list-group-item">
                <small>Sisa Tagihan</small>
                <p class="mb-0">Rp {{ $siswa->sisa_bayar }}</p>
            </li>
        </ul>
    </div>

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
