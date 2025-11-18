@extends('layouts.app') @section('title', 'Dashboard') @section('content')

<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item active" aria-current="page">
                        Dashboard
                    </li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <!--begin::Col-->
            <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 1-->
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $unitsCount }} Unit</h3>
                        <p>Total Unit (Alat Berat & Genset)</p>
                    </div>
                    <i class="bi bi-truck small-box-icon"></i>
                    <a
                        href="{{ route('units.index') }}"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                    >
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
                <!--end::Small Box Widget 1-->
            </div>
            <!--end::Col-->
            <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 2-->
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $transactionsCountYear }}</h3>
                        <p>Transaction YTD</p>
                    </div>
                    <i class="bi bi-graph-up small-box-icon"></i>
                    <a
                        href="{{ route('transactions.index') }}"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                    >
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
                <!--end::Small Box Widget 2-->
            </div>
            <!--end::Col-->
            <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 3-->
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $transactionsCountMonth }}</h3>
                        <p>Transaksi MTD</p>
                    </div>
                    <i class="bi bi-calendar3 small-box-icon"></i>
                    <a
                        href="{{ route('transactions.index') }}"
                        class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover"
                    >
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
                <!--end::Small Box Widget 3-->
            </div>
            <!--end::Col-->
            <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 4-->
                <div class="small-box text-bg-danger">
                    <div class="inner">
                        <h3>{{ $transactionsCountNow }}</h3>
                        <p>Transaksi Hari Ini</p>
                    </div>
                    <i class="bi bi-lightning-charge small-box-icon"></i>
                    <a
                        href="{{ route('transactions.index') }}"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                    >
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
                <!--end::Small Box Widget 4-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 connectedSortable">
                <div class="card mb-4">
                    <!-- Line Chart -->
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">
                            Mounthly Fuel Consumtion Trend
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="transactions-chart"></div>
                    </div>
                    <!-- Line Chart -->
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- /.row (main row) -->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content-->
@endsection @push('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var seriesData = [
        @foreach($data as $remark => $values)
        {
            name: "{{ $remark }}",
            data: @json($values)
        },
        @endforeach
    ];

    var options = {
        chart: {
            type: 'line',
            height: 350,
            toolbar: { show: true }
        },
        series: seriesData,
        colors: ['#FF5733', '#33FF57', '#3357FF', '#F1C40F', '#8E44AD'], // warna untuk tiap remark
        xaxis: {
            categories: @json($labels),
            title: { text: 'Tanggal' }
        },
        yaxis: {
            title: { text: 'Volume (liter)' },
            min: 0
        },
        stroke: { curve: 'smooth' },
        markers: { size: 4 },
        title: { text: 'Transaksi Bulan Ini per Tipe', align: 'left' },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function(val) { return val + " liter"; }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#transactions-chart"), options);
    chart.render();
</script>
@endpush
