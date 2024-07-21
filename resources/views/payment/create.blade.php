@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('payments.list-siswa') }}">Pembayaran</a></li>
        <li class="breadcrumb-item"><a href="{{ route('siswa.payments.index', $siswa) }}">{{ $siswa->nama }}</a></li>
        <li class="breadcrumb-item">Tambah Pembayaran</li>
    </ol>
@endsection

@section('content')
    <h1 class="h3 mb-4">Tambah Pembayaran Siswa</h1>

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
                <small>Program</small>
                <p class="mb-0">{{ $siswa->program?->nama_program ?? '-' }}</p>
            </li>
            <li class="list-group-item">
                <small>Harga Program</small>
                <p class="mb-0">Rp {{ $siswa->program?->harga ?? '-' }}</p>
            </li>
            <li class="list-group-item">
                <small>Terbayar</small>
                <p class="mb-0">Rp {{ $siswa->program?->harga - $siswa->sisa_bayar ?? '-' }}</p>
            </li>
            <li class="list-group-item">
                <small>Sisa Tagihan</small>
                <p class="mb-0">Rp {{ $siswa->sisa_bayar ?? '-' }}</p>
            </li>
        </ul>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('siswa.payments.store', $siswa) }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tanggal">Tanggal<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" value="{{ old('tanggal') ?? today()->format('Y-m-d') }}" name="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror" required>

                        @error('tanggal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="jumlah">Jumlah pembayaran<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" value="{{ old('jumlah') ?? $siswa->sisa_bayar }}" name="jumlah"
                            class="form-control @error('jumlah') is-invalid @enderror" required>

                        @error('jumlah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 ms-auto">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
