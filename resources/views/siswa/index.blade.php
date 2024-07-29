@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Siswa</li>
    </ol>
@endsection

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3">Daftar Siswa</h1>

        @if (auth()->user()->jabatan?->role_name == App\Enums\RoleEnum::Administrator->value)
            <a href="{{ route('siswa.create') }}" class="btn btn-primary my-auto"><i class="cil-plus icon me-2"></i> Tambah
                Siswa</a>
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
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $item)
                        <tr>
                            <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->status }}</td>
                            <td class="text-center">
                                <a
                                    href="{{ route('siswa.show', $item->id_siswa) }}"class="btn-detail btn btn-outline-info btn-sm">
                                    <i class='fa fa-eye'></i>
                                </a>

                                @if (auth()->user()->jabatan?->role_name == App\Enums\RoleEnum::Administrator->value)
                                    <a href="{{ route('siswa.edit', $item->id_siswa) }}"
                                        class="btn btn-outline-warning btn-sm"><i class="cil-pencil icon"></i></a>
                                    <form action="{{ route('siswa.destroy', $item->id_siswa) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Anda yakin ingin menghapus data siswa {{ $item->nama }}?');">
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

            {{ $siswa->links() }}
        </div>
    </div>
@endsection
