

@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div id="auth">
    <div class="row h-100">
        <!-- Left illustration -->
        <div class="col-lg-7 d-none d-lg-block" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
            <div class="text-center text-white p-5">
                <i class="bi bi-shield-check" style="font-size: 120px; opacity: 0.9;"></i>
                <h1 class="mt-4 mb-3" style="font-size: 3rem; font-weight: 700;">LaraRadar XTI</h1>
                <h4 class="mb-4" style="font-weight: 300; opacity: 0.9;">Extended Threat Intelligence Platform</h4>
                <div class="row mt-5">
                    <div class="col-4">
                        <div class="p-3">
                            <i class="bi bi-globe" style="font-size: 2.5rem;"></i>
                            <p class="mt-2 mb-0">Attack Surface</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3">
                            <i class="bi bi-bug-fill" style="font-size: 2.5rem;"></i>
                            <p class="mt-2 mb-0">Vulnerabilities</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3">
                            <i class="bi bi-incognito" style="font-size: 2.5rem;"></i>
                            <p class="mt-2 mb-0">Dark Web</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right form -->
        <div class="col-lg-5 col-12">
            <div id="auth-right" class="d-flex align-items-center justify-content-center" style="height: 100%;">
                <div class="auth-left" style="width: 100%; max-width: 420px; padding: 40px;">
                    <div class="auth-logo mb-4">
                        <a href="/">
                            <h2 class="mb-0"><i class="bi bi-shield-check text-primary"></i><span class="text-primary">Lara</span>Radar</h2>
                        </a>
                    </div>
                    <h1 class="auth-title mb-1">Log in.</h1>
                    <p class="auth-subtitle mb-5">Extended Threat Intelligence Platform</p>

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end mb-3">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">Keep me logged in</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="font-bold">Sign up</a>.</p>
                        <p><a class="font-bold" href="{{ route('password.request') }}">Forgot password?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

