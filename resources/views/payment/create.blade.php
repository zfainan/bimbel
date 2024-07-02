@extends('layouts.app')

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
        </ul>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('program.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nama_program">Jumlah pembayaran<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('nama_program') }}" name="nama_program"
                            class="form-control @error('nama_program') is-invalid @enderror" required>

                        @error('nama_program')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="harga">Harga<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" value="{{ old('harga') }}" name="harga"
                            class="form-control @error('harga') is-invalid @enderror" required>

                        @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">Deskripsi<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror"
                            required>{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
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
