@extends('layouts.guest')

@section('content')
<div>
    <div>
        <a class="logo">
            <img class="img-fluid for-light" src="{{ asset('assets/images/logo/logo.png') }}" alt="looginpage">
            <img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}" alt="looginpage">
        </a>
    </div>
    <div class="login-main">
        <form method="POST" action="{{ route('login') }}" class="theme-form">
            @csrf
            <h4>Masuk Akun</h4>
            <p>Silakan masukkan NIP dan password untuk login</p>
            <div class="form-group">
                <label class="col-form-label">NIP</label>
                <input autofocus required type="number" name="nip" class="form-control" placeholder="NIP"
                    value="{{ old('nip') }}" />
                @error('nip')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label class="col-form-label">Password</label>
                <div class="form-input position-relative">
                    <input required type="password" name="password" class="form-control" placeholder="Password" />
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="show-hide"><span class="show"> </span></div>
                </div>
            </div>
            <div class="form-group mb-0">
                <div class="checkbox p-0">
                    <input id="checkbox1" type="checkbox" name="remember">
                    <label class="text-muted" for="checkbox1">Ingat saya</label>
                </div>
                <div class="text-end mt-3">
                    <button class="btn btn-primary btn-block w-100" type="submit">Masuk</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

{{-- <div class="col-12">
    <div class="text-lg text-center mb-3">
        <img class="mx-auto d-block rotate-n-15" src={{ asset('assets/img/logo.png') }} height="84" />
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input autofocus required type="number" name="nip" class="form-control form-control-lg" placeholder="NIP."
                value="{{ old('nip') }}" />
            @error('nip')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <input required type="password" name="password" class="form-control form-control-lg"
                placeholder="Password" />
            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <input type="hidden" value="true" name="remember" />
        <button type="submit" class="btn btn-lg btn-primary btn-block">
            Login
        </button>
    </form>
</div> --}}
