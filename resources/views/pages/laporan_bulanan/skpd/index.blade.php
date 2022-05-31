@extends('layouts.app')

@section('title', 'Laporan SKPD Bulanan')

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan SKPD Bulanan</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('laporan_bulanan_skpd.print') }}" accept-charset="UTF-8"
            class="form needs-validation" autocomplete="off">
            @csrf
            <div class="border p-3 my-2 shadow">
                <div class="form-group">
                    <strong>Laporan</strong>
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold">Payment Point</label>
                    <select name="payment_point_id" class="form-control">
                        <option selected disabled>Pilih Payment Point...</option>
                        @foreach ($payment_point as $pp)
                        <option value="{{ $pp->id }}" @if(old('payment_point_id')==$pp->id) selected @endif >{{
                            $pp->nama }}</option>
                        @endforeach
                    </select>
                    @error('payment_point_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="font-weight-semibold">Tahun</label>
                            <select name="tahun" class="form-control">
                                <option selected disabled>Pilih Tahun...</option>
                                <option value="2022" @if(old('tahun')=='2022' ) selected @endif>2022</option>
                            </select>
                            @error('tahun')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="font-weight-semibold">Bulan</label>
                            <select name="bulan" class="form-control">
                                <option selected disabled>Pilih Bulan...</option>
                                @php
                                $bulan = 1;
                                @endphp
                                @while ($bulan <= 12) <option value="{{ $bulan }}" @if(old('bulan')==$bulan) selected
                                    @endif>{{
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
                                <option value="{{ $p1->id }}" @if(old('penandatangan1_id')==$p1->id) selected @endif>{{
                                    $p1->nama }} ({{ $p1->jabatan }})</option>
                                @endforeach
                            </select>
                            @error('penandatangan1_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="font-weight-semibold">Tanggal Tanda Tangan</label>
                            <input type="date" name="tgl_ttd" class="form-control" value={{ old('tgl_ttd') }}>
                            @error('tgl_ttd')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold">Penandatangan Kedua</label>
                            <select name="penandatangan2_id" class="form-control">
                                <option selected disabled>Pilih Penandatangan Kedua...</option>
                                @foreach ($penandatangan as $p2)
                                <option value="{{ $p2->id }}" @if(old('penandatangan2_id')==$p2->id) selected @endif>{{
                                    $p2->nama }} ({{ $p2->jabatan }})</option>
                                @endforeach
                            </select>
                            @error('penandatangan2_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="font-weight-semibold">Penandatangan Ketiga</label>
                            <select name="penandatangan3_id" class="form-control">
                                <option selected disabled>Pilih Penandatangan Ketiga...</option>
                                @foreach ($penandatangan as $p3)
                                <option value="{{ $p3->id }}" @if(old('penandatangan3_id')==$p3->id) selected @endif>{{
                                    $p3->nama }} ({{ $p3->jabatan }})</option>
                                @endforeach
                            </select>
                            @error('penandatangan3_id')
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
@endsection