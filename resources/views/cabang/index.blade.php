@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cabang</li>
    </ol>
@endsection

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3">Daftar Cabang</h1>
            <a href="{{ route('cabang.create') }}" class="btn btn-primary my-auto"><i class="cil-plus icon me-2"></i> Tambah Cabang</a>
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
                        <th scope="col">Alamat</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabang as $item)
                        <tr>
                            <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td class="text-center">
                                <a href="{{ route('cabang.edit', $item->id_cabang) }}"
                                    class="btn btn-outline-warning btn-sm"><i class="cil-pencil icon"></i></a>
                                <form action="{{ route('cabang.destroy', $item->id_cabang) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Anda yakin ingin menghapus data cabang {{ $item->nama }}? Semua data terkait cabang akan terhapus.');">
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

            {{ $cabang->links() }}
        </div>
    </div>
@endsection
