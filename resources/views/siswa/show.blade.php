@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Siswa</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $siswa->nama }}</li>
    </ol>
@endsection

@section('content')
    <div class="d-flex mb-4">
        <h1 class="h4 my-auto">Detail Siswa</h1>

        @if (auth()->user()->jabatan?->role_name == App\Enums\RoleEnum::Administrator->value)
            <a href="{{ route('siswa.edit', $siswa) }}" class="btn btn-warning my-auto ms-auto"><i
                    class="cil-pencil icon me-2"></i> Edit</a>
        @endif
    </div>
    <div class="card">
        <div class="">
            <ol class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto ms-2">
                        <div class="fw-bold">Nama</div> {{ $siswa->nama }}
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto ms-2">
                        <div class="fw-bold">Tanggal Lahir</div> {{ $siswa->tgl_lahir }}
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto ms-2">
                        <div class="fw-bold">Jenis Kelamin</div> {{ $siswa->jenis_kelamin }}
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto ms-2">
                        <div class="fw-bold">Alamat</div> {{ $siswa->alamat }}
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto ms-2">
                        <div class="fw-bold">No Telp</div> {{ $siswa->no_telp }}
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto ms-2">
                        <div class="fw-bold">Nama Ortu</div> {{ $siswa->nama_ortu }}
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto ms-2">
                        <div class="fw-bold">No Telp Ortu</div> {{ $siswa->no_telp_ortu }}
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto ms-2">
                        <div class="fw-bold">Pekerjaan Ortu</div> {{ $siswa->pekerjaan_ortu }}
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto ms-2">
                        <div class="fw-bold">Asal Sekolah</div> {{ $siswa->asal_sekolah }}
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto ms-2">
                        <div class="fw-bold">Kelas</div> {{ $siswa->kelas }}
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto ms-2">
                        <div class="fw-bold">Status</div> {{ $siswa->status }}
                    </div>
                </li>
            </ol>
        </div>
    </div>

    <div class="d-flex pb-5 pt-3">
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
