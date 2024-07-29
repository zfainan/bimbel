<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Alumni</title>

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

        <h3>Data Alumni</h3>

        <p>Dengan hormat,</p>
        <p>Berikut ini adalah daftar data alumni:</p>

        <table class="table">
            @if ($request->filled('since'))
                <tr>
                    <td>Sejak</td>
                    <td>:</td>
                    <td>{{ $request->get('since') }}</td>
                </tr>
            @endif
            @if ($request->filled('until'))
                <tr>
                    <td>Sampai</td>
                    <td>:</td>
                    <td>{{ $request->get('until') }}</td>
                </tr>
            @endif
            <tr>
                <td>Tanggal Cetak</td>
                <td>:</td>
                <td>{{ now()->isoFormat('D MMMM YYYY') }}</td>
            </tr>
        </table>

        <br>

        <table class="table-border table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Asal Sekolah</th>
                    <th>Angkatan</th>
                    <th>Nilai Ujian</th>
                    <th>Pendidikan Lanjutan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $alumni)
                    <tr>
                        <td>{{ $alumni->siswa?->nama }}</td>
                        <td>{{ $alumni->siswa?->asal_sekolah }}</td>
                        <td>{{ $alumni->tahun_angkatan }}</td>
                        <td>{{ $alumni->nilai_ujian }}</td>
                        <td>{{ $alumni->pendidikan_lanjutan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>

        <p>Hormat kami,</p>

        <br>

        <div style="max-width: 300px">
            <br><br><br><br>
            <p style="">{{ auth()->user()->name }}</p>
        </div>
    </body>

</html>
