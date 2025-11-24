<?php

namespace App\Http\Controllers;

use App\Models\Botnet;
use Illuminate\Http\Request;

class BotnetController extends Controller
{
    /**
     * Display a listing of botnet data.
     */
    public function index()
    {
        $botnets = Botnet::orderByDesc('detected_at')
            ->paginate(50);

        $stats = [
            'total' => Botnet::count(),
            'active' => Botnet::where('is_active', true)->count(),
            'inactive' => Botnet::where('is_active', false)->count(),
        ];

        return view('botnet.index', compact('botnets', 'stats'));
    }

    /**
     * Display the specified botnet.
     */
    public function show($id)
    {
        $botnet = Botnet::findOrFail($id);

        return view('botnet.show', compact('botnet'));
    }

    /**
     * Update active status.
     */
    public function updateStatus(Request $request, $id)
    {
        $botnet = Botnet::findOrFail($id);

        $botnet->update([
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('botnet.show', $id)
            ->with('success', 'Botnet status updated.');
    }

    /**
     * Remove the specified botnet.
     */
    public function destroy($id)
    {
        $botnet = Botnet::findOrFail($id);
        $botnet->delete();

        return redirect()->route('botnet.index')
            ->with('success', 'Botnet data deleted successfully.');
    }
}
