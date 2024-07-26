@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Jadwal Pertemuan</li>
    </ol>
@endsection

@section('content')
    <h1 class="h3">Daftar Jadwal</h1>

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
                        <th scope="col">Nama Tentor</th>
                        <th scope="col">Nama Program</th>
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
                            <td>{{ $item->program?->nama_program }}</td>
                            <td>{{ $item->hari }}</td>
                            <td>{{ $item->jam }}</td>
                            <td class="text-center">
                                <a href="{{ route('jadwal.pertemuan.index', [
                                    'jadwal' => $item->id,
                                ]) }}"
                                    class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
