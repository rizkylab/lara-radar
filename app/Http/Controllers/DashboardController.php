<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Subdomain;
use App\Models\Port;
use App\Models\Vulnerability;
use App\Models\Alert;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     */
    public function index()
    {
        // Basic statistics
        $stats = [
            'domains' => Domain::count(),
            'subdomains' => Subdomain::count(),
            'ports' => Port::count(),
            'vulnerabilities' => Vulnerability::count(),
        ];

        // Recent alerts (latest 5)
        $alerts = Alert::orderByDesc('created_at')->limit(5)->get();

        // Vulnerability distribution for the last 7 days (placeholder data)
        $vulnDistDays = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
        $vulnDistribution = [];
        foreach ($vulnDistDays as $day) {
            $vulnDistribution[] = rand(0, 20);
        }

        // Severity breakdown (placeholder)
        $severityDistribution = [
            'critical' => Vulnerability::where('severity', 'critical')->count(),
            'high' => Vulnerability::where('severity', 'high')->count(),
            'medium' => Vulnerability::where('severity', 'medium')->count(),
            'low' => Vulnerability::where('severity', 'low')->count(),
            'info' => Vulnerability::where('severity', 'info')->count(),
        ];
        $severityDistribution = array_values($severityDistribution);
        // Unread alerts count for sidebar badge
        $unreadAlerts = Alert::where('status', 'unread')->count();

        return view('dashboard.index', compact('stats', 'alerts', 'vulnDistribution', 'vulnDistDays', 'severityDistribution', 'unreadAlerts'));
    }
}
