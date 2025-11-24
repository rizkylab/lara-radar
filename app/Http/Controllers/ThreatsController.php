<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Subdomain;
use App\Models\Vulnerability;
use App\Models\CVE;
use Illuminate\Http\Request;

class ThreatsController extends Controller
{
    /**
     * Display threat hunting dashboard.
     */
    public function index()
    {
        // Recent vulnerabilities
        $recentVulns = Vulnerability::with(['domain', 'subdomain'])
            ->where('status', 'open')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Critical CVEs
        $criticalCVEs = CVE::where('severity', 'CRITICAL')
            ->orderByDesc('published_date')
            ->limit(10)
            ->get();

        // Stats
        $stats = [
            'open_vulnerabilities' => Vulnerability::where('status', 'open')->count(),
            'critical_cves' => CVE::where('severity', 'CRITICAL')->count(),
            'monitored_domains' => Domain::where('is_monitored', true)->count(),
            'monitored_subdomains' => Subdomain::where('is_monitored', true)->count(),
        ];

        return view('threats.index', compact('recentVulns', 'criticalCVEs', 'stats'));
    }

    /**
     * Search for threats.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $type = $request->input('type', 'all');

        $results = [];

        if ($type === 'all' || $type === 'vulnerabilities') {
            $results['vulnerabilities'] = Vulnerability::where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->limit(20)
                ->get();
        }

        if ($type === 'all' || $type === 'cves') {
            $results['cves'] = CVE::where('cve_id', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->limit(20)
                ->get();
        }

        return view('threats.search', compact('results', 'query', 'type'));
    }
}
