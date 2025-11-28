@extends('layouts.app') @section('title', 'Dashboard - Station') @push('css')
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
            <div class="col-sm-6"><h3 class="mb-0">Menu Station</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('stations.index') }}">Menu Station</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Station
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
                <div class="card-header"><div class="card-title">Station Form Edit</div></div>
                <!--end::Header-->
                <!--begin::Form-->
                <form action="{{ route('stations.update', $station->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="station_name" class="col-sm-5 col-form-label">Nama Station</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="station_name" name="station_name" value="{{ old('status', $station->station_name) }}"  required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="flow_meter" class="col-sm-5 col-form-label">Flow Rate</label>
                            <div class="col-sm-7">
                            <input type="number" class="form-control" id="flow_meter" name="flow_meter" value="{{ old('status', $station->flow_meter) }}"  required/>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Data Station</button>
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
