@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
    </ol>
@endsection

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3">Daftar Pengguna</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary my-auto"><i class="cil-plus icon me-2"></i> Tambah
            Pengguna</a>
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
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $item->name }} @if (auth()->user()->id == $item->id)
                                    <span class="text-secondary">(You)</span>
                                @endif
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->jabatan->role_name }}</td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $item->id) }}" class="btn btn-outline-warning btn-sm"><i
                                        class="cil-pencil icon"></i></a>
                                @if (auth()->user()->id !== $item->id)
                                    <form action="{{ route('users.destroy', $item->id) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Anda yakin ingin menghapus data user {{ $item->name }}?');">
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

            {{ $users->links() }}
        </div>
    </div>
@endsection
