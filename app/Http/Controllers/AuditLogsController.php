<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogsController extends Controller
{
    /**
     * Display a listing of audit logs.
     */
    public function index()
    {
        $logs = AuditLog::with('user')
            ->orderByDesc('created_at')
            ->paginate(50);

        $stats = [
            'total' => AuditLog::count(),
            'today' => AuditLog::whereDate('created_at', today())->count(),
            'this_week' => AuditLog::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        return view('audit-logs.index', compact('logs', 'stats'));
    }

    /**
     * Display the specified audit log.
     */
    public function show($id)
    {
        $log = AuditLog::with('user')
            ->findOrFail($id);

        return view('audit-logs.show', compact('log'));
    }

    /**
     * Filter logs by action.
     */
    public function filter(Request $request)
    {
        $action = $request->input('action');
        $userId = $request->input('user_id');

        $query = AuditLog::with('user');

        if ($action) {
            $query->where('action', $action);
        }

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $logs = $query->orderByDesc('created_at')->paginate(50);

        $stats = [
            'total' => $query->count(),
            'today' => (clone $query)->whereDate('created_at', today())->count(),
            'this_week' => (clone $query)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        return view('audit-logs.index', compact('logs', 'stats', 'action', 'userId'));
    }

    /**
     * Export audit logs.
     */
    public function export(Request $request)
    {
        $logs = AuditLog::with('user')
            ->orderByDesc('created_at')
            ->get();

        // Simple CSV export
        $filename = 'audit_logs_' . now()->format('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'User', 'Action', 'Description', 'IP Address', 'Created At']);

            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->user->name ?? 'N/A',
                    $log->action,
                    $log->description,
                    $log->ip_address,
                    $log->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
