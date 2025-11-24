@extends('layouts.auth')

@section('title', 'Register')

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
            <h1 class="auth-title">Sign Up</h1>
            <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="name" class="form-control form-control-xl @error('name') is-invalid @enderror" 
                           placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="email" name="email" class="form-control form-control-xl @error('email') is-invalid @enderror" 
                           placeholder="Email" value="{{ old('email') }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" class="form-control form-control-xl @error('password') is-invalid @enderror" 
                           placeholder="Password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password_confirmation" class="form-control form-control-xl" 
                           placeholder="Confirm Password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Already have an account? <a href="{{ route('login') }}" class="font-bold">Log
                        in</a>.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; height: 100%;">
            <div class="text-center text-white p-5">
                <i class="bi bi-shield-plus" style="font-size: 120px; opacity: 0.9;"></i>
                <h1 class="mt-4 mb-3" style="font-size: 3rem; font-weight: 700;">Join LaraRadar</h1>
                <h4 class="mb-4" style="font-weight: 300; opacity: 0.9;">Start securing your digital assets today</h4>
                <div class="row mt-5">
                    <div class="col-4">
                        <div class="p-3">
                            <i class="bi bi-speedometer2" style="font-size: 2.5rem;"></i>
                            <p class="mt-2 mb-0">Fast Scanning</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3">
                            <i class="bi bi-graph-up" style="font-size: 2.5rem;"></i>
                            <p class="mt-2 mb-0">Analytics</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3">
                            <i class="bi bi-bell" style="font-size: 2.5rem;"></i>
                            <p class="mt-2 mb-0">Alerts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
