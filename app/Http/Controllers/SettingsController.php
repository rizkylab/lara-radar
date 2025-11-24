<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        $settings = [
            'scan_frequency' => config('app.scan_frequency', 'daily'),
            'notification_email' => config('app.notification_email', auth()->user()->email),
            'enable_alerts' => config('app.enable_alerts', true),
            'alert_threshold' => config('app.alert_threshold', 'medium'),
            'api_rate_limit' => config('app.api_rate_limit', 100),
        ];

        return view('settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'scan_frequency' => 'required|in:hourly,daily,weekly',
            'notification_email' => 'required|email',
            'enable_alerts' => 'boolean',
            'alert_threshold' => 'required|in:low,medium,high,critical',
            'api_rate_limit' => 'required|integer|min:10|max:1000',
        ]);

        // Store settings in cache or database
        foreach ($validated as $key => $value) {
            Cache::forever("settings.{$key}", $value);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Display API keys management.
     */
    public function apiKeys()
    {
        $apiKeys = auth()->user()->company->apiKeys ?? collect();

        return view('settings.api-keys', compact('apiKeys'));
    }

    /**
     * Generate new API key.
     */
    public function generateApiKey(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $apiKey = auth()->user()->company->apiKeys()->create([
            'name' => $validated['name'],
            'key' => 'lara_' . bin2hex(random_bytes(32)),
            'is_active' => true,
        ]);

        return redirect()->route('settings.api-keys')
            ->with('success', 'API key generated successfully.');
    }

    /**
     * Revoke API key.
     */
    public function revokeApiKey($id)
    {
        $apiKey = auth()->user()->company->apiKeys()->findOrFail($id);
        $apiKey->update(['is_active' => false]);

        return redirect()->route('settings.api-keys')
            ->with('success', 'API key revoked successfully.');
    }
}
