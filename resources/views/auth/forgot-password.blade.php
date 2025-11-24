@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="/">
                    <img src="{{ asset('logo.png') }}" alt="Logo" style="height:48px;">
                </a>
            </div>
            <h1 class="auth-title">Forgot Password</h1>
            <p class="auth-subtitle mb-5">Input your email and we will send you reset password link.</p>

            @if (session('status'))
                <div class="alert alert-success mb-4 alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="email" name="email" class="form-control form-control-xl @error('email') is-invalid @enderror" 
                           placeholder="Email" value="{{ old('email') }}" required autofocus>
                    <div class="form-control-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send Reset Link</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Remember your account? <a href="{{ route('login') }}" class="font-bold">Log in</a>.</p>
            </div>
        </div>
    </div>
                <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; height: 100%;">
            <div class="text-center text-white p-5">
                <i class="fas fa-key" style="font-size: 120px; opacity: 0.9;"></i>
                <h1 class="mt-4 mb-3" style="font-size: 3rem; font-weight: 700;">Recovery</h1>
                <h4 class="mb-4" style="font-weight: 300; opacity: 0.9;">Securely recover your access</h4>
            </div>
        </div>
    </div>
</div>
@endsection
