<?php

namespace App\Http\Controllers;

use App\Models\CVE;
use Illuminate\Http\Request;

class CVEController extends Controller
{
    /**
     * Display a listing of CVEs.
     */
    public function index()
    {
        $cves = CVE::orderByDesc('published_date')
            ->paginate(50);

        return view('cve.index', compact('cves'));
    }

    /**
     * Display the specified CVE.
     */
    public function show($id)
    {
        $cve = CVE::findOrFail($id);

        return view('cve.show', compact('cve'));
    }

    /**
     * Search CVEs by keyword.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $cves = CVE::where('cve_id', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orderByDesc('published_date')
            ->paginate(50);

        return view('cve.index', compact('cves', 'query'));
    }
}
