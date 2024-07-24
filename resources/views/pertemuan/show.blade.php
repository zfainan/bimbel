@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('program.index') }}">Program</a></li>
        <li class="breadcrumb-item active">{{ $program->nama_program }}</li>
    </ol>
@endsection

@section('content')
    <h1 class="h3 mb-3">Detail Program</h1>

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

    <div class="pb-4 pt-2">
        <ul class="list-group">
            <li class="list-group-item">
                <small>Nama Program</small>
                <p class="mb-0">{{ $program->nama_program }}</p>
            </li>
            <li class="list-group-item">
                <small>Harga program</small>
                <p class="mb-0">{{ $program->harga }}</p>
            </li>
            <li class="list-group-item">
                <small>Deskripsi</small>
                <p class="mb-0">{{ $program->deskripsi }}</p>
            </li>
        </ul>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                <h4 class="card-title">Daftar Siswa</h4>
                <a href="#" class="btn btn-primary my-auto" data-coreui-toggle="modal"
                    data-coreui-target="#addSiswaModal"><i class="cil-plus icon me-2"></i> Tambah
                    Siswa</a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Kelas</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($program->siswa as $item)
                            <tr>
                                <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kelas }}</td>
                                <td class="text-center">
                                    <form
                                        action="{{ route('program.remove-siswa', [
                                            'program' => $program,
                                            'siswa' => $item,
                                        ]) }}"
                                        method="POST" style="display:inline-block;"
                                        onsubmit="return confirm('Anda yakin ingin mengeluarkan siswa {{ $item->nama }}?');">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                                class="cil-trash icon"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal tambah siswa -->
    <div class="modal fade" id="addSiswaModal" tabindex="-1" aria-labelledby="addSiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form class="modal-content" action="{{ route('program.add-siswa', $program) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addSiswaModalLabel">Pilih siswa</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive p-3">
                        <table class="w-100 table" id="addSiswaTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="no-sort">#</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $item)
                                    <tr>
                                        <td><input value="{{ $item->id_siswa }}" @checked($item->id_program == $program->id_program)
                                                class="form-check-input" type="checkbox" name="siswa[]"></td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kelas }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        new DataTable('#addSiswaTable', {
            columnDefs: [{
                "orderable": false,
                "targets": [0]
            }]
        });
    </script>
@endsection
