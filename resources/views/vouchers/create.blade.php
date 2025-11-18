@extends('layouts.app') @section('title', 'Dashboard - Units') @push('css')
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
            <div class="col-sm-6"><h3 class="mb-0">Menu Voucher</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('vouchers.index') }}">Menu Voucher</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Create Voucher
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

                @if (session('error'))
                    <div class="callout callout-danger mb-4" role="aler">
                        {{ session('error') }}
                    </div>
                @endif
                
                <!--begin::Horizontal Form-->
                <div class="card card-primary card-outline mb-4">
                <!--begin::Header-->
                <div class="card-header"><div class="card-title">Voucer Form</div></div>
                <!--end::Header-->
                <!--begin::Form-->
                <form action="{{ route('vouchers.store') }}" method="POST">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="unit_name" class="col-sm-5 col-form-label">Nama Unit</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="unit_name" name="unit_name" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="volume" class="col-sm-5 col-form-label">Volume Pengisian</label>
                            <div class="col-sm-7">
                            <input type="number" class="form-control" id="volume" name="volume" required/>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Generate Voucher</button>
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

<script>
    if ("NDEFReader" in window) {
    const reader = new NDEFReader();
    reader.scan().then(() => {
        reader.onreading = event => {
        const serial = event.serialNumber; // ID dari kartu NFC
        document.getElementById("unit_id").value = serial;
        };
    }).catch(error => {
        alert("Tidak bisa membaca NFC: " + error);
    });
    } 
    else {
    console.log("Perangkat ini tidak mendukung Web NFC")
    }
</script>


@endpush
