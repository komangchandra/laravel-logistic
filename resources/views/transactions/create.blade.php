@extends('layouts.app') @section('title', 'Dashboard - Transaction') @push('css')
<link
    rel="stylesheet"
    href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css"
/>
<link
    rel="stylesheet"
    href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.min.css"
/>
@endpush @section('content')

<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Menu Transaction</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('transactions.index') }}">Menu Transaction</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Create Transaction
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
            <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                
                <!--begin::Horizontal Form-->
                <div class="card card-primary card-outline mb-4">
                <!--begin::Header-->
                <div class="card-header"><div class="card-title">Transaction Form</div></div>
                <!--end::Header-->
                <!--begin::Form-->
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="transaction_type" class="col-sm-5 col-form-label">Jenis Transaksi</label>
                            <div class="col-sm-7">
                            <select class="form-select" id="transaction_type" name="transaction_type" required>
                                <option selected disabled value="">Pilih jenis transaksi..</option>
                                <option disabled value="Kartu">Kartu</option>
                                <option disabled value="Voucher">Voucher</option>
                                <option value="Manual">Manual</option>
                            </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="unit_id" class="col-sm-5 col-form-label">Unit</label>
                            <div class="col-sm-7">
                            <select class="form-select" id="unit_id" name="unit_id" required>
                                <option selected disabled value="">Pilih unit..</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->nomor_lambung }} - {{ $unit->status }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="station_id" class="col-sm-5 col-form-label">Station</label>
                            <div class="col-sm-7">
                            <select class="form-select" id="station_id" name="station_id" required>
                                <option selected disabled value="">Pilih station..</option>
                                @foreach($stations as $station)
                                    <option value="{{ $station->id }}">{{ $station->station_name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="flowmeter_start" class="col-sm-5 col-form-label">Flow Awal</label>
                            <div class="col-sm-7">
                            <input type="number" class="form-control" id="flowmeter_start" name="flowmeter_start" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="flowmeter_end" class="col-sm-5 col-form-label">Flow Akhir</label>
                            <div class="col-sm-7">
                            <input type="number" class="form-control" id="flowmeter_end" name="flowmeter_end" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hour_meter" class="col-sm-5 col-form-label">HM/KM</label>
                            <div class="col-sm-7">
                            <input type="number" class="form-control" id="hour_meter" name="hour_meter" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="driver_name" class="col-sm-5 col-form-label">Nama Driver</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="driver_name" name="driver_name" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="fuelman" class="col-sm-5 col-form-label">Nama Fuel Man</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="fuelman" name="fuelman" required/>
                            </div>
                        </div>

                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Data Transaksi</button>
                    </div>
                    <!--end::Footer-->
                </form>
                <!--end::Form-->
                </div>
                <!--end::Horizontal Form-->

            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content-->
@endsection @push('js')
<!-- jQuery wajib dulu -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    $(document).ready(function () {
        $("#dataTable").DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            dom: "Bfrtip",
            buttons: ["excel", "pdf", "print"],
        });
    });
</script>
@endpush
