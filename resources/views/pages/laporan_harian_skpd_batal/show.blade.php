@extends('layouts.app')

@section('title', 'SKPD Batal ' . $payment_point->nama)

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">SKPD Batal {{ $payment_point->nama }}</h6>
    </div>
    <div class="card-body">
        <form id="search-form" class="form-inline">
            <div class="form-group mr-2">
                <select name="bulan" class="form-control">
                    <option selected value="Semua">-- Semua Bulan --</option>
                    @php
                    $bulan = 1;
                    @endphp
                    @while ($bulan <= 12) <option value="{{ $bulan }}" @if(old('bulan')==$bulan) selected @endif>{{
                        \Carbon\Carbon::create()->month($bulan)->monthName }}
                        </option>
                        @php
                        $bulan++;
                        @endphp
                        @endwhile
                </select>
            </div>
            <div class="form-group mr-2">
                <select name="bulan" class="form-control">
                    <option selected disabled>Pilih Tahun...</option>
                    @php
                    $tahun = 2022;
                    @endphp
                    @while ($tahun <= \Carbon\Carbon::parse(now())->year) <option value="{{ $tahun }}"
                            @if(\Carbon\Carbon::parse(now())->year == $tahun) selected @endif>{{
                            $tahun }}
                        </option>
                        @php
                        $tahun++;
                        @endphp
                        @endwhile
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-filter fa-fw"></i> Filter</button>
        </form>
        <div class="table-responsive mt-3">
            <table id="laporan_harian_skpd_batalTable" class="table table-sm table-bordered table-hover" width="100%"
                cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">No.</th>
                        <th class="text-center">Tanggal Cetak</th>
                        <th class="text-center">Jenis PKB</th>
                        <th class="text-center">No. SKPD</th>
                        <th class="text-center">No. Polisi</th>
                        <th class="text-center">Keterangan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modalContainer" data-backdrop="static" data-keyboard="false" role="dialog"
    aria-labelledby="modalContainer" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
    var tableDokumen = $('#laporan_harian_skpd_batalTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('laporan_harian_skpd_batal.show', $payment_point->id) !!}',
            data: function (d) {
                d.bulan = $('select[name=bulan]').val();
                d.tahun = $('select[name=tahun]').val();
            }
        },
        columns: [
            { data: 'action', name: 'action', className: 'text-nowrap text-center', width: '1%', orderable: false, searchable: false },
            { data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '1%' , searchable: false, orderable: false},
            { data: 'tgl_cetak', name: 'tgl_cetak', className: 'text-center' },
            { data: 'jenis_pkb.nama', name: 'jenis_pkb.nama', className: 'text-center' },
            { data: 'no_skpd', name: 'no_skpd', className: 'text-center' },
            { data: 'no_pol_lengkap', name: 'no_pol_lengkap', className: 'text-center text-nowrap' },
            { data: 'keterangan', name: 'keterangan', className: 'text-center' },
        ],
    });

    $('#search-form').on('submit', function(e) {
        tableDokumen.draw();
        e.preventDefault();
    });
</script>
<script>
    $('body').on("click", ".batal", function(event){
            event.preventDefault();
            var href = $(this).attr("href");
            var dataTargetTable = $(this).data('target-table');
    
            Swal.fire({
                title: 'Anda yakin akan mengaktifkan lagi data ini?',
                text: "Periksa kembali data anda sebelum mengaktifkan lagi SKPD ini!",
                icon: 'warning',
                showCancelButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false,
                allowEnterKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: href,
                        type: 'PUT',
                        success: function(response) {
                            if(response.status == 'success'){
                                showAlert(response.message, 'success');
                                window[dataTargetTable].ajax.reload(null, false);
                            }else{
                                showAlert(response.message, response.status);
                            }
                        }
                    });
                }
            })
        });
</script>
@endpush