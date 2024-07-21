@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('program.index') }}">Program</a></li>
        <li class="breadcrumb-item"><a href="{{ route('program.show', $program) }}">{{ $program->nama_program }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="h4">Ubah Program</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('program.update', $program) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nama_program">Nama Program<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('nama_program') ?? $program->nama_program }}"
                            name="nama_program" class="form-control @error('nama_program') is-invalid @enderror" required>

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
                        <input type="number" value="{{ old('harga') ?? $program->harga }}" name="harga"
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
                            required>{{ old('deskripsi') ?? $program->deskripsi }}</textarea>

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
