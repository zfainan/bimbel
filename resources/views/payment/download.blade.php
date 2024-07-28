<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pembayaran Program</title>

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

        <h3>Pembayaran Program</h3>

        <p>Berikut ini adalah detail pembayaran program.</p>

        <table class="table">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $payment->tanggal }}</td>
            </tr>
            <tr>
                <td>Siswa</td>
                <td>:</td>
                <td>{{ $payment->siswa?->nama }}</td>
            </tr>
            <tr>
                <td>Program</td>
                <td>:</td>
                <td>{{ $payment->program?->nama_program }}</td>
            </tr>
            <tr>
                <td>Jumlah Pembayaran</td>
                <td>:</td>
                <td>Rp {{ $payment->jumlah }}</td>
            </tr>
            <tr>
                <td>Sisa Tagihan</td>
                <td>:</td>
                <td>Rp {{ $payment->sisa_bayar }}</td>
            </tr>
        </table>

        <br>

        <p>Hormat kami,</p>

        <br>

        <div style="max-width: 300px">
            <br><br><br><br>
            <p>{{ auth()->user()->name }}</p>
        </div>
    </body>

</html>
