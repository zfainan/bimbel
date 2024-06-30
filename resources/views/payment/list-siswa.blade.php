@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Daftar Pembayaran Siswa</h1>

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
                        <th scope="col">Nama Siswa</th>
                        <th scope="col" class="text-center">Kelas</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $item)
                        <tr>
                            <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $item->nama }}</td>
                            <td class="text-center">{{ $item->kelas }}</td>
                            <td class="text-center">
                                <a href="{{ route('payments.index', $item) }}"
                                    class="btn btn-outline-info btn-sm"><i class="fa-regular fa-eye"></i> Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $siswa->links() }}
        </div>
    </div>
@endsection
