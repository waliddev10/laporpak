@extends('layouts.app')

@section('title', 'Data User')
@section('title.category', 'General')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="row">
    <!-- Zero Configuration  Starts-->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Manajemen User</h5>
            </div>
            <div class="card-body">
                <a class="btn btn-outline-primary btn-sm" title="Tambah User" data-bs-toggle="modal"
                    data-bs-target="#modalContainer" data-title="Tambah User" href="{{ route('user.create') }}"><i
                        class="fa fa-plus fa-fw"></i>
                    Tambah
                    User</a>
                <div class="table-responsive">
                    <table id="tableDokumen" class="display">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Pangkat</th>
                                <th>Bidang</th>
                                <th>No. HP</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalContainer" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalContainer" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Title</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                ...
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    var tableDokumen = $('#tableDokumen').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('user.index') }}',
            // data: function (d) {
            //     d.bulan = $('select[name=bulan]').val();
            //     d.tahun = $('select[name=tahun]').val();
            // }
        },
        columns: [
            { data: 'action', name: 'action', className: 'text-nowrap text-center', width: '1%', orderable: false, searchable: false },
            { data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '1%' , searchable: false, orderable: false},
            { data: 'nama', name: 'nama', className: 'text-center' },
            { data: 'email', name: 'email', className: 'text-center' },
            { data: 'nip', name: 'nip', className: 'text-center' },
            { data: 'jabatan', name: 'jabatan', className: 'text-center' },
            { data: 'pangkat.nama', name: 'pangkat.nama', className: 'text-center text-nowrap' },
            { data: 'bidang.nama', name: 'bidang.nama', className: 'text-nowrap' },
            { data: 'no_hp', name: 'no_hp', className: 'text-nowrap' },
            { data: 'role', name: 'role', className: 'text-nowrap' },
        ],
    });

    // $('#search-form').on('submit', function(e) {
    //     tableDokumen.draw();
    //     e.preventDefault();
    // });
</script>
@endpush
