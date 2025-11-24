@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="row gx-0" style="min-height:100vh;">
    <!-- Left visual / hero -->
    <div class="col-lg-7 d-none d-lg-block" style="background:#161631; display:flex; align-items:center; justify-content:center;">
        <div style="max-width:720px; width:100%; padding:40px;">
            <!-- Decorative/illustration area: keep simple gradient circle to mimic sample -->
            <div style="display:flex; align-items:center; justify-content:center; height:520px;">
                <div style="width:520px; height:520px; border-radius:50%; background: radial-gradient(circle at 35% 30%, #2b2350 0%, #191532 40%, #0f0d29 100%); display:flex; align-items:center; justify-content:center; box-shadow: inset 0 0 80px rgba(255,80,128,0.05);">
                    <div style="text-align:center; color:#fff;">
                        <h1 style="font-size:64px; margin:0; font-weight:800; letter-spacing:2px;">XTI</h1>
                        <p style="margin-top:6px; opacity:0.85;">Extended Threat Intelligence</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right form panel -->
    <div class="col-lg-5 col-12" style="background:#fff; display:flex; align-items:center;">
        <div style="width:100%; max-width:420px; margin:40px auto;">
            <!-- Top small links (privacy/terms/about) -->
            <div class="d-flex justify-content-end mb-3 d-none d-md-flex" style="gap:18px; font-size:0.9rem; color:#9aa0b1;">
                <a href="#" class="text-muted">Privacy Policy</a>
                <a href="#" class="text-muted">Terms of Use</a>
                <a href="#" class="text-muted">About Us</a>
            </div>

            <!-- Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <img src="{{ asset('logo.png') }}" alt="logo" style="height:56px; object-fit:contain;">
                    </div>

                    <h5 class="text-center mb-1" style="font-weight:700;">Sign in to platform</h5>
                    <p class="text-center text-muted mb-4">Enter your credentials to access the dashboard</p>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" novalidate>
                        @csrf

                        <div class="mb-3 position-relative">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-person"></i></span>
                                <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" placeholder="example@socradar.io" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label ms-1" for="remember">Remember Me</label>
                            </div>
                            <div>
                                <a href="{{ route('password.request') }}" class="text-muted small">Forgot Password ?</a>
                            </div>
                        </div>

                        <button class="btn btn-dark w-100 mb-3" style="background:#3f3650; border:none; padding:12px 14px;">Next</button>
                    </form>

                    <div class="text-center my-3">
                        <small class="text-muted">Don't have a membership?</small>
                    </div>

                    <a href="{{ route('register') }}" class="btn btn-outline-secondary w-100">Sign Up For Free</a>
                </div>
            </div>

            <!-- Footer small -->
            <div class="text-center mt-4 small text-muted">
                © {{ date('Y') }} Lara Radar. All rights reserved.
            </div>
        </div>
    </div>
</div>
@endsection
