@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3>Edit Siswa</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.update', $siswa) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">Nama<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('nama') ?? $siswa->nama }}" name="nama"
                            class="form-control @error('nama') is-invalid @enderror" required>

                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">Tanggal Lahir<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" value="{{ old('tgl_lahir') ?? $siswa->tgl_lahir->format('Y-m-d') }}" name="tgl_lahir"
                            class="form-control @error('tgl_lahir') is-invalid @enderror" required>

                        @error('tgl_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">Jenis Kelamin<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror"
                            required>
                            <option @selected((old('jenis_kelamin') ?? $siswa->jenis_kelamin) == 'L') value="L">Laki-laki</option>
                            <option @selected((old('jenis_kelamin') ?? $siswa->jenis_kelamin) == 'P') value="P">Perempuan</option>
                        </select>

                        @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">Alamat<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('alamat') ?? $siswa->alamat }}" name="alamat"
                            class="form-control @error('alamat') is-invalid @enderror" required>

                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">No Telp<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('no_telp') ?? $siswa->no_telp }}" name="no_telp"
                            class="form-control @error('no_telp') is-invalid @enderror" required>

                        @error('no_telp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">Nama Ortu<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('nama_ortu') ?? $siswa->nama_ortu }}" name="nama_ortu"
                            class="form-control @error('nama_ortu') is-invalid @enderror" required>

                        @error('nama_ortu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">No Telp Ortu<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('no_telp_ortu') ?? $siswa->no_telp_ortu }}" name="no_telp_ortu"
                            class="form-control @error('no_telp_ortu') is-invalid @enderror" required>

                        @error('no_telp_ortu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">Pekerjaan Ortu<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('pekerjaan_ortu') ?? $siswa->pekerjaan_ortu }}"
                            name="pekerjaan_ortu" class="form-control @error('pekerjaan_ortu') is-invalid @enderror"
                            required>

                        @error('pekerjaan_ortu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">Asal Sekolah<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('asal_sekolah') ?? $siswa->asal_sekolah }}"
                            name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" required>

                        @error('asal_sekolah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">Kelas<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('kelas') ?? $siswa->kelas }}" name="kelas"
                            class="form-control @error('kelas') is-invalid @enderror" required>

                        @error('kelas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="">Status<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('status') ?? $siswa->status }}" name="status"
                            class="form-control @error('status') is-invalid @enderror" required>

                        @error('status')
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
