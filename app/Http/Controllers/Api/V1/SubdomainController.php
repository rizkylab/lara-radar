<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Subdomain;
use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Subdomain::query();

        if ($request->has('domain_id')) {
            $query->where('domain_id', $request->domain_id);
        }

        $subdomains = $query->paginate(20);

        return response()->json($subdomains);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subdomain = Subdomain::with(['ports', 'techStacks', 'vulnerabilities'])->findOrFail($id);
        
        return response()->json($subdomain);
    }
}
