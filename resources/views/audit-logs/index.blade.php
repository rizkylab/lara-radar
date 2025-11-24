@extends('layouts.app')

@section('title','Audit Logs')
@section('page_title','Audit Logs')
@section('page_subtitle','System audit trail')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Audit Logs</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>IP</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rows = $auditLogs ?? collect(); @endphp
                        @forelse($rows as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->user?->name ?? 'System' }}</td>
                            <td>{{ $log->action ?? $log->message ?? 'N/A' }}</td>
                            <td>{{ $log->ip_address ?? '—' }}</td>
                            <td>{{ $log->created_at?->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No audit logs found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
