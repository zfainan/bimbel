@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3">Daftar Alumni</h1>
        <a href="{{ route('alumni.create') }}" class="btn btn-primary my-auto"><i class="cil-plus icon me-2"></i> Tambah
            Alumni</a>
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
                        <th scope="col">Angkatan</th>
                        <th scope="col">Nilai Ujian</th>
                        <th scope="col">Pendidikan Lanjutan</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumni as $item)
                        <tr>
                            <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $item->siswa->nama }}</td>
                            <td>{{ $item->tahun_angkatan }}</td>
                            <td>{{ $item->nilai_ujian }}</td>
                            <td>{{ $item->pendidikan_lanjutan }}</td>
                            <td class="text-center">
                                <a href="{{ route('alumni.edit', $item->id_alumni) }}"
                                    class="btn btn-outline-warning btn-sm"><i class="cil-pencil icon"></i></a>
                                <form action="{{ route('alumni.destroy', $item->id_alumni) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Anda yakin ingin menghapus data alumni {{ $item->siswa->nama }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                            class="cil-trash icon"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $alumni->links() }}
        </div>
    </div>
@endsection
