@extends('layouts.guest')

@section('content')
<div class="col-12">
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
</div>
@endsection

{{-- <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <label for="email" :value="__('Email')" />

        <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
            autofocus />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password" :value="__('Password')" />

        <input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="current-password" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
        </a>
        @endif

        <button type="submit" class="ml-3">
            {{ __('Log in') }}
        </button>
    </div>
</form> --}}