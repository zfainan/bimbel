@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Pengguna</li>
    </ol>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="h4">Tambah Pengguna</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name">Nama<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('name') }}" name="name"
                            class="form-control @error('name') is-invalid @enderror" required>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="email">Email<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" value="{{ old('email') }}" name="email"
                            class="form-control @error('email') is-invalid @enderror" required>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="password">Password<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="password_confirmation">Konfirmasi Password<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror" required>

                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="id_jabatan">Jabatan<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="id_jabatan" class="form-select @error('id_jabatan') is-invalid @enderror" required>
                            <option value="">Pilih Jabatan</option>
                            @foreach ($jabatan as $item)
                                <option value="{{ $item->id_jabatan }}">{{ $item->role_name }}</option>
                            @endforeach
                        </select>

                        @error('id_jabatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                @if (auth()->user()->jabatan?->role_name == App\Enums\RoleEnum::CentralHead->value)
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="id_cabang">Cabang<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select name="id_cabang" class="form-select @error('id_cabang') is-invalid @enderror" required>
                                <option value="">Pilih Cabang</option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id_cabang }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>

                            @error('id_cabang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-sm-10 ms-auto">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document
            .querySelector('select[name="id_jabatan"]')
            .addEventListener('change', (value) => {
                $selectCabang = document.querySelector('select[name="id_cabang"]')

                if ($selectCabang && value.target.value == '{{ $jabatanKepala?->id_jabatan }}') {
                    $selectCabang.setAttribute('disabled', true)
                } else {
                    $selectCabang.removeAttribute('disabled')
                }
            })
    </script>
@endsection
