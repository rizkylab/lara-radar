<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CVE;
use Illuminate\Http\Request;

class CVEController extends Controller
{
    /**
     * Display a listing of CVEs
     */
    public function index(Request $request)
    {
        $query = CVE::query();

        if ($request->has('severity')) {
            $query->where('severity', $request->severity);
        }

        $cves = $query->orderBy('published_at', 'desc')->paginate(20);

        return response()->json($cves);
    }

    /**
     * Display the specified CVE
     */
    public function show(string $id)
    {
        $cve = CVE::where('cve_id', $id)->orWhere('id', $id)->firstOrFail();
        
        return response()->json($cve);
    }

    /**
     * Get latest CVEs
     */
    public function latest()
    {
        $cves = CVE::orderBy('published_at', 'desc')->limit(10)->get();
        
        return response()->json($cves);
    }

    /**
     * Get trending CVEs
     */
    public function trending()
    {
        $cves = CVE::where('is_trending', true)
            ->orderBy('trending_score', 'desc')
            ->limit(10)
            ->get();
        
        return response()->json($cves);
    }

    /**
     * Search CVEs
     */
    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:3',
        ]);

        $cves = CVE::where('cve_id', 'like', '%' . $request->q . '%')
            ->orWhere('description', 'like', '%' . $request->q . '%')
            ->paginate(20);

        return response()->json($cves);
    }
}
