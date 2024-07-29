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
                    {{-- <p>Telepon: (021) 123-4567 | Email: info@pendaftaranbimbelsmartgama.com</p> --}}
                    <p>Website: https://pendaftaranbimbelsmartgama.my.id</p>
                </td>
            </tr>
        </table>

        <hr>

        <h3>Data Presensi</h3>

        <p>Dengan hormat,</p>
        <p>Berikut ini adalah daftar data presensi:</p>

        <table class="table">
            <tr>
                <td>Tentor</td>
                <td>:</td>
                <td>{{ $jadwal?->tentor?->name }}</td>
            </tr>
            <tr>
                <td>Program</td>
                <td>:</td>
                <td>{{ $jadwal?->program?->nama_program }}</td>
            </tr>
            <tr>
                <td>Jadwal</td>
                <td>:</td>
                <td>{{ $jadwal?->hari }} - {{ $jadwal?->jam }}</td>
            </tr>
            <tr>
                <td>Tanggal Cetak</td>
                <td>:</td>
                <td>{{ now()->isoFormat('D MMMM YYYY') }}</td>
            </tr>
        </table>

        <br>

        @foreach ($data as $pertemuan)
            <p>Pertemuan ke: <strong>{{ $loop->iteration }}</strong></p>
            <p>Tanggal: <strong>{{ $pertemuan->tanggal }}</strong></p>

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
