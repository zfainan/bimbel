@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Laporan</li>
        <li class="breadcrumb-item active" aria-current="page">Presensi</li>
    </ol>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="h4">Download Data Presensi</h3>
        </div>
        <div class="card-body" id="form">
            <form action="{{ route('reports.presensi') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="id_tentor">Tentor<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="id_tentor" class="form-control @error('id_tentor') is-invalid @enderror" required>
                            <option selected value disabled>Pilih tentor</option>

                            @foreach ($tentor as $item)
                                <option @selected((old('id_tentor') ?? $selectedTentor?->id) == $item->id) value="{{ $item->id }}">{{ $item->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_tentor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="id_jadwal">Jadwal<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="id_jadwal" class="form-control @error('id_jadwal') is-invalid @enderror" required
                            @disabled(!$selectedTentor)>
                            <option selected value disabled>Pilih jadwal</option>

                            @foreach ($jadwal ?? [] as $item)
                                <option @selected(old('id_jadwal') == $item->id) value="{{ $item->id }}">
                                    {{ $item->program?->nama_program }} - {{ $item->hari }} - {{ $item->jam }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_jadwal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary">Download</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document
            .querySelector('select[name="id_tentor"]')
            .addEventListener('change', (value) => {
                window.location.href = `?id_tentor=${value.target.value}`
            })
    </script>
@endsection
