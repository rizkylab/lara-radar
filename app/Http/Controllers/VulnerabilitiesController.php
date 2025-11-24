<?php

namespace App\Http\Controllers;

use App\Models\Vulnerability;
use Illuminate\Http\Request;

class VulnerabilitiesController extends Controller
{
    /**
     * Display a listing of vulnerabilities.
     */
    public function index()
    {
        $vulnerabilities = Vulnerability::with(['domain', 'subdomain'])
            ->orderByDesc('created_at')
            ->paginate(50);

        // Stats for filters
        $stats = [
            'total' => Vulnerability::count(),
            'critical' => Vulnerability::where('severity', 'critical')->count(),
            'high' => Vulnerability::where('severity', 'high')->count(),
            'medium' => Vulnerability::where('severity', 'medium')->count(),
            'low' => Vulnerability::where('severity', 'low')->count(),
        ];

        return view('vulnerabilities.index', compact('vulnerabilities', 'stats'));
    }

    /**
     * Display the specified vulnerability.
     */
    public function show($id)
    {
        $vulnerability = Vulnerability::with(['domain', 'subdomain'])
            ->findOrFail($id);

        return view('vulnerabilities.show', compact('vulnerability'));
    }

    /**
     * Store a newly created vulnerability.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'domain_id' => 'required|exists:domains,id',
            'subdomain_id' => 'nullable|exists:subdomains,id',
            'title' => 'required|string|max:255',
            'severity' => 'required|in:critical,high,medium,low,info',
            'description' => 'nullable|string',
            'cvss_score' => 'nullable|numeric|min:0|max:10',
            'cve_id' => 'nullable|string|max:50',
        ]);

        $vulnerability = Vulnerability::create($validated);

        return redirect()->route('vulnerabilities.index')
            ->with('success', 'Vulnerability added successfully.');
    }

    /**
     * Update the specified vulnerability.
     */
    public function update(Request $request, $id)
    {
        $vulnerability = Vulnerability::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,resolved,false_positive',
            'remediation' => 'nullable|string',
        ]);

        $vulnerability->update($validated);

        return redirect()->route('vulnerabilities.show', $id)
            ->with('success', 'Vulnerability updated successfully.');
    }

    /**
     * Remove the specified vulnerability.
     */
    public function destroy($id)
    {
        $vulnerability = Vulnerability::findOrFail($id);
        $vulnerability->delete();

        return redirect()->route('vulnerabilities.index')
            ->with('success', 'Vulnerability deleted successfully.');
    }
}
