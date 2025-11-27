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
            <div class="col-sm-6"><h3 class="mb-0">Menu Unit</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="/dashboard">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Menu Unit
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
                        <h6 class="m-0 fw-bold text-primary">Tabel Unit</h6>
                        <div class="ms-auto">

                            @php
                                $disabledRoles = ['Direktur', 'Manager', 'Logistic', 'User'];
                                $isDisabled = auth()->user() && auth()->user()->hasAnyRole($disabledRoles);
                            @endphp

                            <a 
                                href="{{ $isDisabled ? '#' : route('units.create') }}" 
                                class="btn btn-sm btn-primary {{ $isDisabled ? 'disabled' : '' }}"
                                {{ $isDisabled ? 'aria-disabled=true tabindex=-1' : '' }}>
                                <i class="bi bi-plus-lg"></i> Create Data Unit
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID Kartu</th>
                                        <th>Lambung</th>
                                        <th>Nama</th>
                                        <th>Owner</th>
                                        <th>Area</th>
                                        <th>Aktivitas</th>
                                        <th>##</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>ID Kartu</th>
                                        <th>Lambung</th>
                                        <th>Nama</th>
                                        <th>Owner</th>
                                        <th>Area</th>
                                        <th>Aktivitas</th>
                                        <th>##</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @forelse ($units as $unit)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @if ($unit->is_activ == 1)
                                                <td class="bg-primary text-white">{{ $unit->unit_id }}</td>
                                            @else
                                                <td class="bg-danger text-white">{{ $unit->unit_id }}</td>
                                            @endif
                                            <td>{{ $unit->nomor_lambung }}</td>
                                            <td>{{ $unit->unit_name }}</td>
                                            <td>{{ $unit->status }}</td>
                                            <td>{{ $unit->area }}</td>
                                            <td>{{ $unit->activity }}</td>
                                            <td>
                                                <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                @role('Super-Admin')
                                                <form action="{{ route('units.destroy', $unit->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $unit->id }}">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </button>
                                                </form>
                                                @endrole
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada Unit</td>
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
            dom: "<'row'<'col-sm-6'l><'col-sm-6 text-end'B>>" +
                "<'row'<'col-sm-12'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: ["excel", "pdf", "print"],
            lengthMenu: [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
            pageLength: 10, // default tampilan awal (10 baris)
            language: {
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(difilter dari total _MAX_ data)",
                search: "Cari:",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                },
            }
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
