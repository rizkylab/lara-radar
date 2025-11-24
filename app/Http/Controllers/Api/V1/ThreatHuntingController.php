<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Subdomain;
use App\Models\Vulnerability;
use App\Models\Port;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThreatHuntingController extends Controller
{
    /**
     * Search across all threat intelligence data
     */
    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:3',
            'type' => 'nullable|in:domain,subdomain,vulnerability,port,all',
        ]);

        $query = $request->q;
        $type = $request->type ?? 'all';
        $results = [];

        if ($type === 'domain' || $type === 'all') {
            $results['domains'] = Domain::where('domain', 'like', '%' . $query . '%')
                ->limit(10)
                ->get();
        }

        if ($type === 'subdomain' || $type === 'all') {
            $results['subdomains'] = Subdomain::where('subdomain', 'like', '%' . $query . '%')
                ->limit(10)
                ->get();
        }

        if ($type === 'vulnerability' || $type === 'all') {
            $results['vulnerabilities'] = Vulnerability::where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('cve_id', 'like', '%' . $query . '%')
                ->limit(10)
                ->get();
        }

        if ($type === 'port' || $type === 'all') {
            $results['ports'] = Port::where('service', 'like', '%' . $query . '%')
                ->orWhere('banner', 'like', '%' . $query . '%')
                ->limit(10)
                ->get();
        }

        return response()->json($results);
    }
}
