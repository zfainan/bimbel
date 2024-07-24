@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Jadwal Ajar</li>
    </ol>
@endsection

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3">Daftar Jadwal Ajar</h1>
            <a href="{{ route('jadwal-ajar.create') }}" class="btn btn-primary my-auto"><i class="cil-plus icon me-2"></i> Tambah Jadwal</a>
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
                        <th scope="col">Tentor</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Jam</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $item->tentor?->name }}</td>
                            <td>{{ $item->hari }}</td>
                            <td>{{ $item->jam }}</td>
                            <td class="text-center">
                                <a href="{{ route('jadwal-ajar.edit', $item) }}"
                                    class="btn btn-outline-warning btn-sm"><i class="cil-pencil icon"></i></a>
                                <form action="{{ route('jadwal-ajar.destroy', $item) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Anda yakin ingin menghapus jadwal?');">
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

            {{ $data->links() }}
        </div>
    </div>
@endsection
