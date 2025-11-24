<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DomainController;
use App\Http\Controllers\Api\V1\SubdomainController;
use App\Http\Controllers\Api\V1\VulnerabilityController;
use App\Http\Controllers\Api\V1\CVEController;
use App\Http\Controllers\Api\V1\DarkWebController;
use App\Http\Controllers\Api\V1\BotnetController;
use App\Http\Controllers\Api\V1\PiiController;
use App\Http\Controllers\Api\V1\ThreatHuntingController;
use App\Http\Controllers\Api\V1\AlertController;
use App\Http\Controllers\Api\V1\AdminController;

Route::prefix('v1')->group(function () {
    // Auth Routes
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);

        // Domain Routes
        Route::apiResource('domains', DomainController::class);
        Route::post('domains/{domain}/scan', [DomainController::class, 'scan']);

        // Subdomain Routes
        Route::apiResource('subdomains', SubdomainController::class)->only(['index', 'show']);

        // Vulnerability Routes
        Route::apiResource('vulnerabilities', VulnerabilityController::class);
        Route::post('vulnerabilities/scan', [VulnerabilityController::class, 'scan']);

        // CVE Routes
        Route::get('cve/latest', [CVEController::class, 'latest']);
        Route::get('cve/trending', [CVEController::class, 'trending']);
        Route::get('cve/search', [CVEController::class, 'search']);
        Route::apiResource('cve', CVEController::class)->only(['index', 'show']);

        // Dark Web Routes
        Route::get('darkweb/credentials', [DarkWebController::class, 'credentials']);
        Route::get('darkweb/exposures', [DarkWebController::class, 'exposures']);

        // Botnet Routes
        Route::apiResource('botnet', BotnetController::class)->only(['index', 'show']);

        // PII Routes
        Route::apiResource('pii', PiiController::class)->only(['index', 'show']);

        // Threat Hunting Routes
        Route::get('threat-hunting/search', [ThreatHuntingController::class, 'search']);

        // Alert Routes
        Route::apiResource('alerts', AlertController::class);
        Route::post('alerts/test', [AlertController::class, 'test']);

        // Admin Routes
        Route::get('admin/analytics', [AdminController::class, 'analytics']);
        Route::get('admin/summaries', [AdminController::class, 'summaries']);
    });
});
