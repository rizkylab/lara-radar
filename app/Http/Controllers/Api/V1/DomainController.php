<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $domains = Domain::where('user_id', $request->user()->id)->paginate(10);
        return response()->json($domains);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'domain' => 'required|string|unique:domains,domain',
            'company_id' => 'required|exists:companies,id',
        ]);

        $domain = Domain::create([
            'domain' => $request->domain,
            'company_id' => $request->company_id,
            'user_id' => $request->user()->id,
            'status' => 'pending',
        ]);

        return response()->json($domain, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $domain = Domain::with(['subdomains', 'vulnerabilities', 'ports'])->findOrFail($id);
        
        // TODO: Add policy check
        // Gate::authorize('view', $domain);

        return response()->json($domain);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $domain = Domain::findOrFail($id);
        
        // Gate::authorize('update', $domain);

        $request->validate([
            'domain' => 'string|unique:domains,domain,' . $id,
        ]);

        $domain->update($request->only(['domain']));

        return response()->json($domain);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $domain = Domain::findOrFail($id);
        
        // Gate::authorize('delete', $domain);

        $domain->delete();

        return response()->json(['message' => 'Domain deleted successfully']);
    }

    public function scan(string $id)
    {
        $domain = Domain::findOrFail($id);
        
        // Gate::authorize('scan', $domain);

        $domain->update(['status' => 'scanning']);

        // TODO: Dispatch scan job
        // DomainScanJob::dispatch($domain);

        return response()->json(['message' => 'Scan started successfully']);
    }
}
