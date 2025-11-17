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
            <div class="col-sm-6"><h3 class="mb-0">Menu Voucher</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="/dashboard">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Menu Voucher
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
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">

                @if (session('success'))
                    <div class="callout callout-info mb-4" role="aler">
                        {{ session('success') }}
                    </div>
                @endif
 
                <!--begin::Small Box Widget 1-->
                <div class="card shad ow mb-4">
                    <div class="card-header py-3 d-flex align-items-center">
                        <h6 class="m-0 fw-bold text-primary">Tabel Voucher</h6>
                        <div class="ms-auto">
                            <a href="{{ route('stations.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-lg"></i> Create Voucher
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Unit</th>
                                        <th>Station</th>
                                        <th>Volume</th>
                                        <th>Pembuat</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>##</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Unit</th>
                                        <th>Station</th>
                                        <th>Volume</th>
                                        <th>Pembuat</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>##</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @forelse ($vouchers as $voucher)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $voucher->unit_name }}</td>
                                            <td>{{ $voucher->station_id->station_name }}</td>
                                            <td>{{ $voucher->volume }}</td>
                                            <td>{{ $voucher->user_id->name }}</td>
                                            <td>{{ $voucher->user_id->remarks }}</td>
                                            <td>{{ $voucher->user_id->status }}</td>
                                            <td>
                                                <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $voucher->id }}">
                                                        Hapus
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada voucher</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!--end::Small Box Widget 1-->
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

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        // SweetAlert konfirmasi delete
        $('.btn-delete').on('click', function (e) {
            e.preventDefault();
            let form = $(this).closest('form');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); 
            }
        });
    });
    });
</script>
@endpush
