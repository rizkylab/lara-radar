<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertsController extends Controller
{
    /**
     * Display a listing of alerts.
     */
    public function index()
    {
        $alerts = Alert::with('company')
            ->orderByDesc('created_at')
            ->paginate(50);

        $stats = [
            'total' => Alert::count(),
            'unread' => Alert::where('status', 'unread')->count(),
            'read' => Alert::where('status', 'read')->count(),
            'archived' => Alert::where('status', 'archived')->count(),
        ];

        return view('alerts.index', compact('alerts', 'stats'));
    }

    /**
     * Display the specified alert.
     */
    public function show($id)
    {
        $alert = Alert::with('company')
            ->findOrFail($id);

        // Mark as read
        if ($alert->status === 'unread') {
            $alert->update(['status' => 'read']);
        }

        return view('alerts.show', compact('alert'));
    }

    /**
     * Update alert status.
     */
    public function updateStatus(Request $request, $id)
    {
        $alert = Alert::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:unread,read,archived',
        ]);

        $alert->update($validated);

        return redirect()->route('alerts.show', $id)
            ->with('success', 'Alert status updated.');
    }

    /**
     * Mark all as read.
     */
    public function markAllRead()
    {
        Alert::where('status', 'unread')->update(['status' => 'read']);

        return redirect()->route('alerts.index')
            ->with('success', 'All alerts marked as read.');
    }

    /**
     * Remove the specified alert.
     */
    public function destroy($id)
    {
        $alert = Alert::findOrFail($id);
        $alert->delete();

        return redirect()->route('alerts.index')
            ->with('success', 'Alert deleted successfully.');
    }
}
