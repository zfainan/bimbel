@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('jadwal.pertemuan') }}">Jadwal Pertemuan</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $jadwal->program?->nama_program }}</li>
    </ol>
@endsection

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <div class="">
            <h1 class="h3">Daftar Pertemuan {{ $jadwal->program?->nama_program }}</h1>
            <p>{{ $jadwal->hari }} {{ $jadwal->jam }}</p>
        </div>

        @if (auth()->user()->jabatan?->role_name == \App\Enums\RoleEnum::Tutor->value)
            <a href="{{ route('jadwal.pertemuan.create', $jadwal) }}" class="btn btn-primary my-auto"><i
                    class="cil-plus icon me-2"></i> Tambah
                Pertemuan</a>
        @endif
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

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $item->tanggal }}</td>
                            <td class="text-center">
                                <a href="{{ route('jadwal.pertemuan.show', [
                                    'jadwal' => $jadwal,
                                    'pertemuan' => $item,
                                ]) }}"
                                    class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i></a>

                                @if (auth()->user()->jabatan?->role_name == App\Enums\RoleEnum::Tutor->value)
                                    <a href="{{ route('jadwal.pertemuan.edit', [
                                        'jadwal' => $jadwal,
                                        'pertemuan' => $item,
                                    ]) }}"
                                        class="btn btn-outline-warning btn-sm"><i class="cil-pencil"></i></a>
                                    <form
                                        action="{{ route('jadwal.pertemuan.destroy', [
                                            'jadwal' => $jadwal,
                                            'pertemuan' => $item,
                                        ]) }}"
                                        method="POST" style="display:inline-block;"
                                        onsubmit="return confirm('Anda yakin ingin menghapus data pertemuan?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                                class="cil-trash icon"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $data->links() }}
        </div>
    </div>
@endsection
