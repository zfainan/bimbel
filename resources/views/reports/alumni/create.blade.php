@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Laporan</li>
        <li class="breadcrumb-item active" aria-current="page">Alumni</li>
    </ol>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="h4">Download Data Alumni</h3>
        </div>
        <div class="card-body" id="form">
            <form class="modal-content" action="{{ route('reports.alumni') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="year">Tahun Angkatan<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" max="9999" min="1000" value="{{ old('year') }}" name="year"
                            class="form-control @error('year') is-invalid @enderror" required>
                    </div>
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
@endsection
