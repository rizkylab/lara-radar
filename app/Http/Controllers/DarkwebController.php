<?php

namespace App\Http\Controllers;

use App\Models\DarkwebCredential;
use Illuminate\Http\Request;

class DarkwebController extends Controller
{
    /**
     * Display a listing of dark web credentials.
     */
    public function index()
    {
        $credentials = DarkwebCredential::with('company')
            ->orderByDesc('discovered_at')
            ->paginate(50);

        $stats = [
            'total' => DarkwebCredential::count(),
            'verified' => DarkwebCredential::where('is_verified', true)->count(),
            'unverified' => DarkwebCredential::where('is_verified', false)->count(),
        ];

        return view('darkweb.index', compact('credentials', 'stats'));
    }

    /**
     * Display the specified credential.
     */
    public function show($id)
    {
        $credential = DarkwebCredential::with('company')
            ->findOrFail($id);

        return view('darkweb.show', compact('credential'));
    }

    /**
     * Update verification status.
     */
    public function verify(Request $request, $id)
    {
        $credential = DarkwebCredential::findOrFail($id);

        $credential->update([
            'is_verified' => $request->boolean('is_verified'),
        ]);

        return redirect()->route('darkweb.show', $id)
            ->with('success', 'Verification status updated.');
    }

    /**
     * Remove the specified credential.
     */
    public function destroy($id)
    {
        $credential = DarkwebCredential::findOrFail($id);
        $credential->delete();

        return redirect()->route('darkweb.index')
            ->with('success', 'Credential deleted successfully.');
    }
}
