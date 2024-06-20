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
                <div class="mb-3">
                    <label class="form-label" for="">Nama<span class="text-danger">*</span>:</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" required>

                    @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Tanggal Lahir<span class="text-danger">*</span>:</label>
                    <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror"
                        required>

                    @error('tgl_lahir')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Jenis Kelamin<span class="text-danger">*</span>:</label>
                    <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>

                    @error('jenis_kelamin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Alamat<span class="text-danger">*</span>:</label>
                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                        required>

                    @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">No Telp<span class="text-danger">*</span>:</label>
                    <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror"
                        required>

                    @error('no_telp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Nama Ortu<span class="text-danger">*</span>:</label>
                    <input type="text" name="nama_ortu" class="form-control @error('nama_ortu') is-invalid @enderror"
                        required>

                    @error('nama_ortu')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">No Telp Ortu<span class="text-danger">*</span>:</label>
                    <input type="text" name="no_telp_ortu"
                        class="form-control @error('no_telp_ortu') is-invalid @enderror" required>

                    @error('no_telp_ortu')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Pekerjaan Ortu<span class="text-danger">*</span>:</label>
                    <input type="text" name="pekerjaan_ortu"
                        class="form-control @error('pekerjaan_ortu') is-invalid @enderror" required>

                    @error('pekerjaan_ortu')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Asal Sekolah<span class="text-danger">*</span>:</label>
                    <input type="text" name="asal_sekolah"
                        class="form-control @error('asal_sekolah') is-invalid @enderror" required>

                    @error('asal_sekolah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Kelas<span class="text-danger">*</span>:</label>
                    <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" required>

                    @error('kelas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Status<span class="text-danger">*</span>:</label>
                    <input type="text" name="status" class="form-control @error('status') is-invalid @enderror"
                        required>

                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
