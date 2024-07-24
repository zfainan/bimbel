@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('jadwal-ajar.index') }}">Jadwal Ajar</a></li>
        <li class="breadcrumb-item">{{ $jadwalAjar->id }}</li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="h4">Edit Jadwal Ajar</h3>
        </div>
        <div class="card-body" id="form">
            <form action="{{ route('jadwal-ajar.update', $jadwalAjar) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="id_tentor">Tentor<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="id_tentor" class="form-control @error('id_tentor') is-invalid @enderror" required>
                            <option selected value disabled>Pilih Tentor</option>

                            @foreach ($tentor as $item)
                                <option @selected((old('id_tentor') ?? $jadwalAjar->id_tentor) == $item->id) value="{{ $item->id }}">{{ $item->name }}
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
                    <label class="col-sm-2 col-form-label" for="id_program">Program<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="id_program" class="form-control @error('id_program') is-invalid @enderror" required>
                            <option selected value disabled>Pilih Program</option>

                            @foreach ($programs as $item)
                                <option @selected((old('id_program') ?? $jadwalAjar->id_program) == $item->id_program) value="{{ $item->id_program }}">{{ $item->nama_program }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_program')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="hari">Hari<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="hari" class="form-control @error('hari') is-invalid @enderror" required>
                            @foreach ($days as $item)
                                <option @selected((old('hari') ?? $jadwalAjar->hari) == $item) value="{{ $item }}">{{ $item }}
                                </option>
                            @endforeach
                        </select>

                        @error('hari')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="jam">Jam<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="time" value="{{ old('jam') ?? $jadwalAjar->jam }}" name="jam"
                            class="form-control @error('jam') is-invalid @enderror" required>

                        @error('jam')
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
