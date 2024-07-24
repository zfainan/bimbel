@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('jadwal.pertemuan') }}">Jadwal Pertemuan</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('jadwal.pertemuan.index', $jadwal) }}">{{ $jadwal->program?->nama_program }}</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('jadwal.pertemuan.show', [
                    'jadwal' => $jadwal,
                    'pertemuan' => $pertemuan,
                ]) }}">{{ $pertemuan->id }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
    </ol>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="h4">Ubah Pertemuan {{ $jadwal->program->nama_program }}</h3>
            <p>{{ $jadwal->hari }} {{ $jadwal->jam }}</p>
        </div>
        <div class="card-body">
            <form
                action="{{ route('jadwal.pertemuan.update', [
                    'jadwal' => $jadwal,
                    'pertemuan' => $pertemuan,
                ]) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tanggal">Tanggal Pertemuan<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="datetime-local" value="{{ old('tanggal') ?? $pertemuan->tanggal }}" name="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror" required>

                        @error('tanggal')
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
