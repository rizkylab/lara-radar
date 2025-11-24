<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    /**
     * Display a listing of alerts
     */
    public function index(Request $request)
    {
        $query = Alert::query();

        if ($request->user()->company_id) {
            $query->where('company_id', $request->user()->company_id);
        }

        if ($request->has('severity')) {
            $query->where('severity', $request->severity);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $alerts = $query->orderBy('created_at', 'desc')->paginate(20);

        return response()->json($alerts);
    }

    /**
     * Store a newly created alert
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'severity' => 'required|in:critical,high,medium,low,info',
        ]);

        $alert = Alert::create([
            'company_id' => $request->user()->company_id,
            'title' => $request->title,
            'message' => $request->message,
            'severity' => $request->severity,
            'status' => 'unread',
        ]);

        return response()->json($alert, 201);
    }

    /**
     * Display the specified alert
     */
    public function show(string $id)
    {
        $alert = Alert::findOrFail($id);
        
        // Check if user has access to this company's alert
        if ($alert->company_id !== auth()->user()->company_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        return response()->json($alert);
    }

    /**
     * Update the specified alert
     */
    public function update(Request $request, string $id)
    {
        $alert = Alert::findOrFail($id);
        
        // Check if user has access to this company's alert
        if ($alert->company_id !== auth()->user()->company_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'status' => 'in:read,unread,archived',
        ]);

        if ($request->status === 'read' && !$alert->read_at) {
            $alert->read_at = now();
        }

        $alert->update($request->only(['status']));

        return response()->json($alert);
    }

    /**
     * Remove the specified alert
     */
    public function destroy(string $id)
    {
        $alert = Alert::findOrFail($id);
        
        // Check if user has access to this company's alert
        if ($alert->company_id !== auth()->user()->company_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $alert->delete();

        return response()->json(['message' => 'Alert deleted successfully']);
    }

    /**
     * Test alert notification
     */
    public function test(Request $request)
    {
        $alert = Alert::create([
            'company_id' => $request->user()->company_id,
            'title' => 'Test Alert',
            'message' => 'This is a test alert notification',
            'severity' => 'info',
            'status' => 'unread',
        ]);

        // TODO: Dispatch alert notification job
        // AlertNotificationJob::dispatch($alert);

        return response()->json([
            'message' => 'Test alert created successfully',
            'alert' => $alert,
        ]);
    }
}
