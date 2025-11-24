<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;

class DomainsController extends Controller
{
    /**
     * Display a listing of domains.
     */
    public function index()
    {
        $domains = Domain::with(['subdomains', 'vulnerabilities'])
            ->withCount(['subdomains', 'vulnerabilities'])
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('domains.index', compact('domains'));
    }

    /**
     * Display the specified domain.
     */
    public function show($id)
    {
        $domain = Domain::with(['subdomains', 'ports', 'techStacks', 'vulnerabilities'])
            ->findOrFail($id);

        return view('domains.show', compact('domain'));
    }

    /**
     * Store a newly created domain.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'domain' => 'required|string|max:255|unique:domains',
            'company_id' => 'required|exists:companies,id',
        ]);

        $domain = Domain::create($validated);

        return redirect()->route('domains.index')
            ->with('success', 'Domain added successfully.');
    }

    /**
     * Update the specified domain.
     */
    public function update(Request $request, $id)
    {
        $domain = Domain::findOrFail($id);

        $validated = $request->validate([
            'domain' => 'required|string|max:255|unique:domains,domain,' . $id,
            'is_monitored' => 'boolean',
        ]);

        $domain->update($validated);

        return redirect()->route('domains.show', $id)
            ->with('success', 'Domain updated successfully.');
    }

    /**
     * Remove the specified domain.
     */
    public function destroy($id)
    {
        $domain = Domain::findOrFail($id);
        $domain->delete();

        return redirect()->route('domains.index')
            ->with('success', 'Domain deleted successfully.');
    }
}
