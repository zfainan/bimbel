@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('jadwal.pertemuan') }}">Jadwal Pertemuan</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('jadwal.pertemuan.index', [
                    'jadwal' => $jadwal,
                ]) }}">{{ $pertemuan->jadwal->program?->nama_program }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ $pertemuan->id }}</li>
    </ol>
@endsection

@section('content')
    <h1 class="h3 mb-3">Detail Pertemuan</h1>

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

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ada beberapa kesalahan validasi:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="pb-4 pt-2">
        <ul class="list-group">
            <li class="list-group-item">
                <small>Nama Program</small>
                <p class="mb-0">{{ $pertemuan->jadwal?->program?->nama_program }}</p>
            </li>
            <li class="list-group-item">
                <small>Tanggal</small>
                <p class="mb-0">{{ $pertemuan->tanggal }}</p>
            </li>
            <li class="list-group-item">
                <small>Tentor</small>
                <p class="mb-0">{{ $pertemuan->jadwal?->tentor?->name }}</p>
            </li>
        </ul>
    </div>

    <div class="card">
        <form class="card-body" method="POST" action="{{ route('presensi.store') }}">
            @csrf

            <input type="hidden" name="id_pertemuan" value="{{ $pertemuan->id }}">

            <div class="d-flex justify-content-between mb-4">
                <h4 class="card-title">Daftar Kehadiran</h4>
                @if ($hasEditAccess)
                    <button type="submit" class="btn btn-primary my-auto"><i class="cil-save icon me-2"></i>
                        Simpan</button>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pertemuan?->presensi ?? [] as $item)
                            <tr>
                                <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $item->siswa?->nama }}</td>
                                <td class="d-flex">

                                    <input type="hidden" name="siswa[{{ $loop->index }}][id]"
                                        value="{{ $item->siswa?->id_siswa }}">

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="siswa[{{ $loop->index }}][hadir]" value="1" id="hadir1"
                                            @checked((bool) $item->hadir) @disabled(!$hasEditAccess)>
                                        <label class="form-check-label" for="hadir1">
                                            Hadir
                                        </label>
                                    </div>

                                    <div class="form-check ms-4">
                                        <input class="form-check-input" type="radio"
                                            name="siswa[{{ $loop->index }}][hadir]" value="0" id="hadir2"
                                            @checked(!(bool) $item->hadir) @disabled(!$hasEditAccess)>
                                        <label class="form-check-label" for="hadir2">
                                            Tidak Hadir
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        new DataTable('#addSiswaTable', {
            columnDefs: [{
                "orderable": false,
                "targets": [0]
            }]
        });
    </script>
@endsection
