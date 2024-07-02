@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3">Daftar Program</h1>
        <a href="{{ route('program.create') }}" class="btn btn-primary my-auto"><i class="cil-plus icon me-2"></i> Tambah
            Program</a>
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
                        <th scope="col">Nama Program</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($program as $item)
                        <tr>
                            <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $item->nama_program }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td class="text-center">
                                <a href="{{ route('program.show', $item->id_program) }}"
                                    class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('program.edit', $item->id_program) }}"
                                    class="btn btn-outline-warning btn-sm"><i class="cil-pencil icon"></i></a>
                                <form action="{{ route('program.destroy', $item->id_program) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Anda yakin ingin menghapus data program {{ $item->nama_program }}?');">
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

            {{ $program->links() }}
        </div>
    </div>
@endsection
