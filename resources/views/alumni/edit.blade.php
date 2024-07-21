@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('alumni.index') }}">Alumni</a></li>
        <li class="breadcrumb-item">{{ $alumni->siswa->nama }}</li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="h4">Edit Alumni</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('alumni.update', $alumni) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="id_siswa">Nama Siswa<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $alumni->siswa->nama }}" class="form-control" disabled readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tahun_angkatan">Tahun Angkatan<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('tahun_angkatan') ?? $alumni->tahun_angkatan }}"
                            name="tahun_angkatan" class="form-control @error('tahun_angkatan') is-invalid @enderror"
                            required>

                        @error('tahun_angkatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nilai_ujian">Nilai Ujian<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('nilai_ujian') ?? $alumni->nilai_ujian }}" name="nilai_ujian"
                            class="form-control @error('nilai_ujian') is-invalid @enderror" required>

                        @error('nilai_ujian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="pendidikan_lanjutan">Pendidikan Lanjutan<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('pendidikan_lanjutan') ?? $alumni->pendidikan_lanjutan }}"
                            name="pendidikan_lanjutan"
                            class="form-control @error('pendidikan_lanjutan') is-invalid @enderror" required>

                        @error('pendidikan_lanjutan')
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
