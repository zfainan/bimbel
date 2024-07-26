@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Pembayaran</li>
    </ol>
@endsection

@section('content')
    <div class="d-flex pb-3">
        <h1 class="h3 mb-3">Daftar Pembayaran Siswa</h1>
        <button class="btn btn-outline-primary my-auto ms-auto" data-coreui-toggle="modal"
            data-coreui-target="#reportModal">Cetak Data</button>
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ada beberapa kesalahan validasi:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                                <a href="{{ route('siswa.payments.index', $item) }}" class="btn btn-outline-info btn-sm"><i
                                        class="fa-regular fa-eye"></i> Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $siswa->links() }}
        </div>
    </div>

    <!-- Modal generate report -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form class="modal-content" action="{{ route('payments.generate-report') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Cetak Data</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="since">Tanggal awal<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="datetime-local" value="{{ old('since') ?? today()->subDays(30) }}"
                                name="since" class="form-control @error('since') is-invalid @enderror" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="until">Tanggal akhir<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="datetime-local" value="{{ old('until') ?? today() }}" name="until"
                                class="form-control @error('until') is-invalid @enderror" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
@endsection
