<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Subdomain;
use App\Models\Vulnerability;
use App\Models\Alert;
use App\Models\DarkwebCredential;
use App\Models\PiiExposure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Get analytics data
     */
    public function analytics(Request $request)
    {
        $companyId = $request->user()->company_id;

        $analytics = [
            'domains' => [
                'total' => Domain::where('company_id', $companyId)->count(),
                'active' => Domain::where('company_id', $companyId)->whereIn('status', ['scanning', 'completed'])->count(),
                'pending' => Domain::where('company_id', $companyId)->where('status', 'pending')->count(),
            ],
            'subdomains' => [
                'total' => Subdomain::whereHas('domain', function($q) use ($companyId) {
                    $q->where('company_id', $companyId);
                })->count(),
                'monitored' => Subdomain::whereHas('domain', function($q) use ($companyId) {
                    $q->where('company_id', $companyId);
                })->where('is_monitored', true)->count(),
            ],
            'vulnerabilities' => [
                'total' => Vulnerability::whereHas('domain', function($q) use ($companyId) {
                    $q->where('company_id', $companyId);
                })->count(),
                'critical' => Vulnerability::whereHas('domain', function($q) use ($companyId) {
                    $q->where('company_id', $companyId);
                })->where('severity', 'critical')->count(),
                'high' => Vulnerability::whereHas('domain', function($q) use ($companyId) {
                    $q->where('company_id', $companyId);
                })->where('severity', 'high')->count(),
                'open' => Vulnerability::whereHas('domain', function($q) use ($companyId) {
                    $q->where('company_id', $companyId);
                })->where('status', 'open')->count(),
            ],
            'alerts' => [
                'total' => Alert::where('company_id', $companyId)->count(),
                'unread' => Alert::where('company_id', $companyId)->where('status', 'unread')->count(),
            ],
            'darkweb' => [
                'credentials' => DarkwebCredential::where('company_id', $companyId)->count(),
                'pii_exposures' => PiiExposure::where('company_id', $companyId)->count(),
            ],
        ];

        return response()->json($analytics);
    }

    /**
     * Get summary statistics
     */
    public function summaries(Request $request)
    {
        $companyId = $request->user()->company_id;

        // Vulnerability trend (last 30 days)
        $vulnerabilityTrend = Vulnerability::whereHas('domain', function($q) use ($companyId) {
                $q->where('company_id', $companyId);
            })
            ->where('created_at', '>=', now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top vulnerabilities by severity
        $topVulnerabilities = Vulnerability::whereHas('domain', function($q) use ($companyId) {
                $q->where('company_id', $companyId);
            })
            ->where('status', 'open')
            ->orderByRaw("FIELD(severity, 'critical', 'high', 'medium', 'low', 'info')")
            ->limit(10)
            ->get();

        // Recent alerts
        $recentAlerts = Alert::where('company_id', $companyId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Domain scan status
        $domainStatus = Domain::where('company_id', $companyId)
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        return response()->json([
            'vulnerability_trend' => $vulnerabilityTrend,
            'top_vulnerabilities' => $topVulnerabilities,
            'recent_alerts' => $recentAlerts,
            'domain_status' => $domainStatus,
        ]);
    }
}
