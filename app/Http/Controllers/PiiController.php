<?php

namespace App\Http\Controllers;

use App\Models\PiiExposure;
use Illuminate\Http\Request;

class PiiController extends Controller
{
    /**
     * Display a listing of PII exposures.
     */
    public function index()
    {
        $exposures = PiiExposure::with('company')
            ->orderByDesc('discovered_at')
            ->paginate(50);

        $stats = [
            'total' => PiiExposure::count(),
            'verified' => PiiExposure::where('is_verified', true)->count(),
            'unverified' => PiiExposure::where('is_verified', false)->count(),
        ];

        return view('pii.index', compact('exposures', 'stats'));
    }

    /**
     * Display the specified PII exposure.
     */
    public function show($id)
    {
        $exposure = PiiExposure::with('company')
            ->findOrFail($id);

        return view('pii.show', compact('exposure'));
    }

    /**
     * Update verification status.
     */
    public function verify(Request $request, $id)
    {
        $exposure = PiiExposure::findOrFail($id);

        $exposure->update([
            'is_verified' => $request->boolean('is_verified'),
        ]);

        return redirect()->route('pii.show', $id)
            ->with('success', 'Verification status updated.');
    }

    /**
     * Remove the specified PII exposure.
     */
    public function destroy($id)
    {
        $exposure = PiiExposure::findOrFail($id);
        $exposure->delete();

        return redirect()->route('pii.index')
            ->with('success', 'PII exposure deleted successfully.');
    }
}
