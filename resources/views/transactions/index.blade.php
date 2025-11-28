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
                        <a href="/dashboard">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Menu Transaction
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
                        <h6 class="m-0 fw-bold text-primary">Tabel Station</h6>
                        <div class="ms-auto">
                            <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-lg"></i> Create Data Station
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Shift</th>
                                        <th>Jenis Transaksi</th>
                                        <th>No Lambung</th>
                                        <th>Nama Unit</th>
                                        <th>Station</th>
                                        <th>Flow Awal</th>
                                        <th>Flow Akhir</th>
                                        <th>Volume</th>
                                        <th>Remakrk</th>
                                        <th>Lokasi</th>
                                        <th>##</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Shift</th>
                                        <th>Jenis Transaksi</th>
                                        <th>No Lambung</th>
                                        <th>Nama Unit</th>
                                        <th>Station</th>
                                        <th>Flow Awal</th>
                                        <th>Flow Akhir</th>
                                        <th>Volume</th>
                                        <th>Remakrk</th>
                                        <th>Lokasi</th>
                                        <th>##</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaction->formatted_date }}</td>
                                            <td>{{ $transaction->formatted_time }}</td>
                                            <td>{{ $transaction->shift }}</td>
                                            <td>{{ $transaction->transaction_type }}</td>
                                            <td>{{ $transaction->unit->nomor_lambung ?? '-' }}</td>
                                            <td>{{ $transaction->unit->unit_name ?? '-' }}</td>
                                            <td>{{ $transaction->station->station_name ?? '-' }}</td>
                                            <td>{{ number_format($transaction->flowmeter_start) }}</td>
                                            <td>{{ number_format($transaction->flowmeter_end) }}</td>
                                            <td>{{ number_format($transaction->volume) }}</td>
                                            <td>{{ $transaction->unit->activity ?? '-' }}</td>
                                            <td>{{ $transaction->unit->area ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                                <button type="button" class="btn btn-sm btn-info btn-detail" 
                                                    data-bs-toggle="modal" data-bs-target="#detailModal"
                                                    data-transaction='@json($transaction)'>
                                                    Detail
                                                </button>

                                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $transaction->id }}">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center">Belum ada transaksi</td>
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

<!-- Modal Detail Transaction -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content" id="modalPrint">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Transaction</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr><th>ID Transaksi</th><td id="modal_id"></td></tr>
              <tr><th>Jenis Transaksi</th><td id="modal_transaction_type"></td></tr>
              <tr><th>Unit</th><td id="modal_unit"></td></tr>
              <tr><th>Station</th><td id="modal_station"></td></tr>
              <tr><th>Flowmeter Start</th><td id="modal_flowmeter_start"></td></tr>
              <tr><th>Flowmeter End</th><td id="modal_flowmeter_end"></td></tr>
              <tr><th>Volume</th><td id="modal_volume"></td></tr>
              <tr><th>Hour Meter</th><td id="modal_hour_meter"></td></tr>
              <tr><th>Tanggal Transaksi</th><td id="modal_transaction_date"></td></tr>
              <tr><th>Jam Transaksi</th><td id="modal_transaction_time"></td></tr>
              <tr><th>Driver</th><td id="modal_driver"></td></tr>
              <tr><th>Fuelman</th><td id="modal_fuelman"></td></tr>
              <tr><th>Remarks</th><td id="modal_remarks"></td></tr>
              <tr><th>Diperbarui</th><td id="modal_updated_at"></td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End::Modal Detail Transaction -->


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

<script>
$(document).ready(function () {
    $('.btn-detail').on('click', function () {
        let transaction = $(this).data('transaction');

        $('#modal_id').text(transaction.id);
        $('#modal_transaction_type').text(transaction.transaction_type);
        $('#modal_unit').text(transaction.unit ? transaction.unit.nomor_lambung + ' - ' + transaction.unit.unit_name : '-');
        $('#modal_station').text(transaction.station ? transaction.station.station_name : '-');
        $('#modal_flowmeter_start').text(transaction.flowmeter_start);
        $('#modal_flowmeter_end').text(transaction.flowmeter_end);
        $('#modal_volume').text(transaction.volume);
        $('#modal_hour_meter').text(transaction.hour_meter);
        $('#modal_transaction_date').text(transaction.transaction_date);
        $('#modal_transaction_time').text(transaction.transaction_time);
        $('#modal_driver').text(transaction.driver_name);
        $('#modal_fuelman').text(transaction.fuelman);
        $('#modal_remarks').text(transaction.remarks || '-');

        // Convert timestamp ke format lebih readable
        const createdAt = new Date(transaction.created_at);
        const updatedAt = new Date(transaction.updated_at);

        $('#modal_created_at').text(createdAt.toLocaleString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        }));

        $('#modal_updated_at').text(updatedAt.toLocaleString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        }));
    });
});
</script>



@endpush
