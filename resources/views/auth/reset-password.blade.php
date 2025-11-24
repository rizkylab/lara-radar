@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="/">
                    <h2 class="mb-0">
                        <i class="bi bi-shield-check text-primary"></i>
                        <span class="text-primary">Lara</span>Radar
                    </h2>
                </a>
            </div>
            <h1 class="auth-title">Reset Password</h1>
            <p class="auth-subtitle mb-5">Input your new password.</p>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="email" name="email" class="form-control form-control-xl @error('email') is-invalid @enderror" 
                           placeholder="Email" value="{{ old('email', $email) }}" required autofocus>
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" class="form-control form-control-xl @error('password') is-invalid @enderror" 
                           placeholder="New Password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password_confirmation" class="form-control form-control-xl" 
                           placeholder="Confirm New Password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Reset Password</button>
            </form>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; height: 100%;">
            <div class="text-center text-white p-5">
                <i class="bi bi-shield-lock-fill" style="font-size: 120px; opacity: 0.9;"></i>
                <h1 class="mt-4 mb-3" style="font-size: 3rem; font-weight: 700;">Secure Access</h1>
                <h4 class="mb-4" style="font-weight: 300; opacity: 0.9;">Update your credentials securely</h4>
            </div>
        </div>
    </div>
</div>
@endsection
