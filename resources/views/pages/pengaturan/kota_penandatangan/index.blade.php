@extends('layouts.app')

@section('title', 'Kota Penandatangan')

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kota Penandatangan</h6>
    </div>
    <div class="card-body">
        <a class="btn btn-outline-primary btn-sm" title="Tambah Kota Penandatangan" data-toggle="modal"
            data-target="#modalContainer" data-title="Tambah Kota Penandatangan"
            href="{{ route('kota_penandatangan.create') }}"><i class="fa fa-plus fa-fw"></i>
            Tambah
            Kota Penandatangan</a>
        <div class="table-responsive mt-3">
            <table id="kota_penandatanganTable" class="table table-sm table-bordered table-hover" width="100%"
                cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Nama Kota</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modalContainer" data-backdrop="static" data-keyboard="false" role="dialog"
    aria-labelledby="modalContainer" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Title</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                ...
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    tableDokumen = $('#kota_penandatanganTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('kota_penandatangan.index') !!}',
        columns: [
            { data: 'action', name: 'action', className: 'text-nowrap text-center', width: '1%', orderable: false, searchable: false },
            { data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '1%' , searchable: false, orderable: false},
            { data: 'nama', name: 'nama' },
        ],
    });
</script>
@endpush