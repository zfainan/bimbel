@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="h4">Edit Siswa</h3>
        </div>
        <div class="card-body" id="form">
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
                        <input type="date" value="{{ old('tgl_lahir') ?? $siswa->tgl_lahir->format('Y-m-d') }}"
                            name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" required>

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
                        <select v-model="status" name="status"
                            class="form-select @error('status') is-invalid @enderror" required>
                            <option value disabled>Pilih status</option>
                            @foreach ($status as $item)
                                <option value="{{ $item }}"
                                    {{ $item == (old('status') ?? $siswa->status) ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div v-if="status == 'Alumni'">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="tahun_angkatan">Tahun Angkatan<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ old('tahun_angkatan') ?? $siswa->alumni?->tahun_angkatan }}"
                                name="tahun_angkatan" class="form-control @error('tahun_angkatan') is-invalid @enderror"
                                required>

                            @error('tahun_angkatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nilai_ujian">Nilai Ujian<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ old('nilai_ujian') ?? $siswa->alumni?->nilai_ujian }}"
                                name="nilai_ujian" class="form-control @error('nilai_ujian') is-invalid @enderror"
                                required>

                            @error('nilai_ujian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="pendidikan_lanjutan">Pendidikan Lanjutan<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text"
                                value="{{ old('pendidikan_lanjutan') ?? $siswa->alumni?->pendidikan_lanjutan }}"
                                name="pendidikan_lanjutan"
                                class="form-control @error('pendidikan_lanjutan') is-invalid @enderror" required>

                            @error('pendidikan_lanjutan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        const {
            createApp,
            ref
        } = Vue

        createApp({
            setup() {
                const status = ref('{{ (old('status') ?? $siswa->status) }}')
                return {
                    status
                }
            }
        }).mount('#form')
    </script>
@endsection
