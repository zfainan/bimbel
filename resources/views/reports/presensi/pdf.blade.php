<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Presensi</title>

        <style>
            .table {
                width: 100%;
            }

            .table-border {
                border: 1px solid black;
                border-collapse: collapse;
                border-spacing: 0;
            }

            .table-border td,
            .table-border th {
                border: 1px solid black;
                margin: 0;
                padding: 8px 10px;
            }

            .company-details {
                margin: auto;
            }

            .company-details h1 {
                margin: 0;
                font-size: 24px;
                text-align: center;
            }

            .company-details p {
                margin: 5px 0;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <table style="width: 100%">
            <tr>
                <td class="company-details">
                    <h1>Smartgama</h1>
                    <p>Jl. Raya Nguter, Sukoharjo, RT. 01, RW. 05.</p>
                </td>
            </tr>
        </table>

        <hr>

        <h3>Data Presensi</h3>

        <p>Dengan hormat,</p>
        <p>Berikut ini adalah daftar data presensi:</p>

        <table class="table">
            <tr>
                <td>Program</td>
                <td>:</td>
                <td>{{ $data?->first()?->program->nama_program ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal Cetak</td>
                <td>:</td>
                <td>{{ now()->isoFormat('D MMMM YYYY') }}</td>
            </tr>
        </table>

        <br>

        @foreach ($data as $jadwal)
            <hr>

            <p>Jadwal Pertemuan: <strong>{{ $jadwal->hari }}</strong> - <strong>{{ $jadwal->jam }}</strong></p>

            <p>
                Daftar Pertemuan: @if (!count($jadwal?->pertemuan))
                    <strong>Belum ada pertemuan.</strong>
                @endif
            </p>

            @foreach ($jadwal?->pertemuan ?? [] as $pertemuan)
                <p>{{ $loop->iteration }}. {{ $pertemuan->tanggal }}</p>

                <table class="table-border table">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pertemuan?->presensi as $presensi)
                            <tr>
                                <td>{{ $presensi->siswa?->nama }}</td>
                                <td>{{ $presensi->hadir ? 'Hadir' : 'Tidak Hadir' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach

            <br>
        @endforeach

        <p>Hormat kami,</p>

        <br>

        <div style="max-width: 300px">
            <br><br><br><br>
            <p style="">{{ auth()->user()->name }}</p>
        </div>
    </body>

</html>
