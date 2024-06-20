@extends('layouts.app')

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
                    <label class="col-sm-2 col-form-label" for="jabatan_id">Jabatan<span
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

                <div class="row mb-3">
                    <div class="col-sm-10 ms-auto">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
