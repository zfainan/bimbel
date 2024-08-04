@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
@endsection

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-sm-6">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-start pb-0">
                    <div>
                        <div>Jumlah Siswa Membayar</div>
                        <div class="fs-4 fw-semibold">{{ $countPayment }} <span class="fs-6 fw-normal">siswa</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mx-3 mt-3" style="height:20px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card bg-info text-white">
                <div class="card-body d-flex justify-content-between align-items-start pb-0">
                    <div>
                        <div>Total Siswa</div>
                        <div class="fs-4 fw-semibold">{{ $countSiswa }} <span class="fs-6 fw-normal">siswa</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mx-3 mt-3" style="height:20px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title mb-0">Pembayaran</h4>
                    <div class="small text-body-secondary">30 hari yang lalu</div>
                </div>
            </div>
            <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                <canvas class="chart" id="main-chart" height="300"></canvas>
            </div>
        </div>
    </div>
    <!-- /.card-->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const mainChart = new Chart(document.getElementById('main-chart'), {
            type: 'line',
            data: {
                labels: {!! $payment->pluck('tanggal')->toJson() !!},
                datasets: [{
                    label: 'Jumlah Pembayaran',
                    backgroundColor: `rgba(51, 153, 255, .1)`,
                    borderColor: `rgba(51, 153, 255)`,
                    pointHoverBackgroundColor: '#fff',
                    borderWidth: 2,
                    data: {!! $payment->pluck('jumlah')->toJson() !!},
                    fill: true
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    annotation: {
                        annotations: {
                            line1: {
                                type: 'line',
                                yMin: 95,
                                yMax: 95,
                                borderColor: 'rgb(219, 93, 93)',
                                borderWidth: 1,
                                borderDash: [8, 5]
                            }
                        }
                    },
                    legend: {
                        display: false
                    }
                }
            }
        })
    </script>
@endsection
