<?php

namespace App\Http\Controllers;

use App\Models\Subdomain;
use App\Models\Domain;
use Illuminate\Http\Request;

class SubdomainsController extends Controller
{
    /**
     * Display a listing of subdomains.
     */
    public function index()
    {
        $subdomains = Subdomain::with(['domain', 'ports', 'techStacks', 'vulnerabilities'])
            ->withCount(['ports', 'vulnerabilities'])
            ->orderByDesc('created_at')
            ->paginate(50);

        return view('subdomains.index', compact('subdomains'));
    }

    /**
     * Display the specified subdomain.
     */
    public function show($id)
    {
        $subdomain = Subdomain::with(['domain', 'ports', 'techStacks', 'vulnerabilities'])
            ->findOrFail($id);

        return view('subdomains.show', compact('subdomain'));
    }

    /**
     * Store a newly created subdomain.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'domain_id' => 'required|exists:domains,id',
            'subdomain' => 'required|string|max:255',
            'ip_address' => 'nullable|ip',
            'status_code' => 'nullable|integer',
        ]);

        $subdomain = Subdomain::create($validated);

        return redirect()->route('subdomains.index')
            ->with('success', 'Subdomain added successfully.');
    }

    /**
     * Update the specified subdomain.
     */
    public function update(Request $request, $id)
    {
        $subdomain = Subdomain::findOrFail($id);

        $validated = $request->validate([
            'is_monitored' => 'boolean',
            'ip_address' => 'nullable|ip',
        ]);

        $subdomain->update($validated);

        return redirect()->route('subdomains.show', $id)
            ->with('success', 'Subdomain updated successfully.');
    }

    /**
     * Remove the specified subdomain.
     */
    public function destroy($id)
    {
        $subdomain = Subdomain::findOrFail($id);
        $subdomain->delete();

        return redirect()->route('subdomains.index')
            ->with('success', 'Subdomain deleted successfully.');
    }
}
