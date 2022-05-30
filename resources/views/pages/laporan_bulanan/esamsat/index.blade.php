@extends('layouts.app')

@section('title', 'Laporan Bulanan E-Samsat')

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Bulanan E-Samsat</h6>
    </div>
    <div class="card-body">
        <form id="printForm" action="{{ route('laporan_bulanan_esamsat.print') }}" accept-charset="UTF-8"
            class="form needs-validation" autocomplete="off">
            @csrf
            <div class="border p-3 my-2 shadow">
                <div class="form-group">
                    <strong>Pilih Kriteria</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Payment Point</label>
                    <select name="payment_point_id" class="form-control">
                        <option selected disabled>Pilih Payment Point...</option>
                        @foreach ($payment_point as $pp)
                        <option value="{{ $pp->id }}">{{ $pp->nama }}</option>
                        @endforeach
                    </select>
                    @error('payment_point_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Tahun</label>
                    <select name="tahun" class="form-control">
                        <option selected disabled>Pilih Tahun...</option>
                        <option value="2022">2022</option>
                    </select>
                    @error('tahun')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Bulan</label>
                    <select name="bulan" class="form-control">
                        <option selected disabled>Pilih Bulan...</option>
                        @php
                        $bulan = 1;
                        @endphp
                        @while ($bulan <= 12) <option value="{{ $bulan }}">{{
                            \Carbon\Carbon::create()->month($bulan)->monthName }}
                            </option>
                            @php
                            $bulan++;
                            @endphp
                            @endwhile
                    </select>
                    @error('bulan')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="border p-3 my-2 shadow">
                <div class="form-group">
                    <strong>Penandatangan</strong>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="font-weight-semibold">Penandatangan Pertama</label>
                            <select name="penandatangan1_id" class="form-control">
                                <option selected disabled>Pilih Penandatangan Pertama...</option>
                                @foreach ($penandatangan as $p1)
                                <option value="{{ $p1->id }}">{{ $p1->nama }} ({{ $p1->jabatan }})</option>
                                @endforeach
                            </select>
                            @error('penandatangan1_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="font-weight-semibold">Tempat Tanda Tangan</label>
                                    <select name="kota_penandatangan_id" class="form-control">
                                        <option selected disabled>Pilih Tempat (Kota)...</option>
                                        @foreach ($kota_penandatangan as $kota)
                                        <option value="{{ $kota->id }}">{{ $kota->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kota_penandatangan_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="font-weight-semibold">Tanggal Tanda Tangan</label>
                                    <input type="date" name="tgl_ttd" class="form-control">
                                    @error('tgl_ttd')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold">Penandatangan Kedua</label>
                            <select name="penandatangan2_id" class="form-control">
                                <option selected disabled>Pilih Penandatangan Kedua...</option>
                                @foreach ($penandatangan as $p2)
                                <option value="{{ $p2->id }}">{{ $p2->nama }} ({{ $p2->jabatan }})</option>
                                @endforeach
                            </select>
                            @error('penandatangan2_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row mt-4">
                <div class="col text-center">
                    <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="printContainer" data-backdrop="static" data-keyboard="false" role="dialog"
    aria-labelledby="printContainer" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Cetak Laporan E-Samsat</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#printContainer').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var href = button.attr('href')
        modal.find('.modal-body').html(setLoader())
    });
    $("#printForm").on('submit', function(event) {
        event.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhrFields:{
                responseType: 'blob'
            },
            success: function(data) {
                var blobData = data;
                var url = window.URL || window.webkitURL;
                var src = url.createObjectURL(data);
                $("#printContainer").modal('show');
                $("#printContainer").find('.modal-body').html(
                    '<object type="application/pdf" data="'+src+'" width="100%" height="500">No Support</object>'
                );
        }
    });
    return false;
});
</script>
@endpush