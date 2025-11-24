<?php

use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes (temporary - will be replaced with proper auth)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // TODO: Implement authentication
    return redirect()->route('dashboard');
})->name('login.post');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/password/request', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/logout', function () {
    // TODO: Implement logout
    return redirect()->route('login');
})->name('logout');

// Protected routes (temporary - will add auth middleware later)
Route::middleware(['web'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        $stats = [
            'domains' => 25,
            'subdomains' => 342,
            'ports' => 1205,
            'vulnerabilities' => 47
        ];
        return view('dashboard.index', compact('stats'));
    })->name('dashboard');

    // Domains
    Route::get('/domains', function () {
        return view('domains.index');
    })->name('domains.index');

    Route::get('/domains/{id}', function ($id) {
        return view('domains.show', compact('id'));
    })->name('domains.show');

    // Subdomains
    Route::get('/subdomains', function () {
        return view('subdomains.index');
    })->name('subdomains.index');

    // Ports
    Route::get('/ports', function () {
        return view('ports.index');
    })->name('ports.index');

    // Tech Stack
    Route::get('/tech-stack', function () {
        return view('tech-stack.index');
    })->name('tech-stack.index');

    // Vulnerabilities
    Route::get('/vulnerabilities', function () {
        return view('vulnerabilities.index');
    })->name('vulnerabilities.index');

    // CVE Intelligence
    Route::get('/cve', function () {
        return view('cve.index');
    })->name('cve.index');

    // Dark Web Monitoring
    Route::get('/darkweb', function () {
        return view('darkweb.index');
    })->name('darkweb.index');

    // Botnet
    Route::get('/botnet', function () {
        return view('botnet.index');
    })->name('botnet.index');

    // PII Exposure
    Route::get('/pii', function () {
        return view('pii.index');
    })->name('pii.index');

    // Threat Hunting
    Route::get('/threat-hunting', function () {
        return view('threat-hunting.index');
    })->name('threat-hunting.index');

    // Alerts
    Route::get('/alerts', function () {
        return view('alerts.index');
    })->name('alerts.index');

    // Settings
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');

    // Users & Roles
    Route::get('/users', function () {
        return view('users.index');
    })->name('users.index');

    // Audit Logs
    Route::get('/audit-logs', function () {
        return view('audit-logs.index');
    })->name('audit-logs.index');

    // Profile
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
});
