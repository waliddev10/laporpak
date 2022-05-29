@extends('layouts.app')

@section('title', 'Beranda')

@section('title-widget')
<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-file-pdf fa-sm text-white-50 mr-2"></i>
    Laporan Bulanan
</a>
@endsection

@section('content')
<div class="row p-4">
    @foreach($payment_point as $pp)
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            {{ $pp->alamat }}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pp->nama }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection