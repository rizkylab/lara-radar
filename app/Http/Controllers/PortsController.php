<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Domain;
use Illuminate\Http\Request;

class PortsController extends Controller
{
    /**
     * Display a listing of ports.
     */
    public function index()
    {
        $ports = Port::with(['domain', 'subdomain'])
            ->orderByDesc('created_at')
            ->paginate(50);

        return view('ports.index', compact('ports'));
    }

    /**
     * Display the specified port.
     */
    public function show($id)
    {
        $port = Port::with(['domain', 'subdomain'])
            ->findOrFail($id);

        return view('ports.show', compact('port'));
    }

    /**
     * Store a newly created port.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'domain_id' => 'required|exists:domains,id',
            'subdomain_id' => 'nullable|exists:subdomains,id',
            'port' => 'required|integer|min:1|max:65535',
            'service' => 'nullable|string|max:255',
            'protocol' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:50',
        ]);

        $port = Port::create($validated);

        return redirect()->route('ports.index')
            ->with('success', 'Port added successfully.');
    }

    /**
     * Remove the specified port.
     */
    public function destroy($id)
    {
        $port = Port::findOrFail($id);
        $port->delete();

        return redirect()->route('ports.index')
            ->with('success', 'Port deleted successfully.');
    }
}
