@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Daftar Siswa</h1>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary my-auto">Tambah Siswa</a>
    </div>

    @session('success')
        <div class="alert alert-success">
            {{ $value }}
        </div>
    @endsession

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ route('siswa.edit', $item->id_siswa) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('siswa.destroy', $item->id_siswa) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <a href="{{ route('siswa.show', $item->id_siswa) }}" class="btn btn-info btn-sm">Show</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $siswa->links() }}
@endsection
