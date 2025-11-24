@extends('layouts.app')

@section('title', 'Vulnerabilities')
@section('page_title', 'Vulnerability Monitoring')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Vulnerabilities</h5>
            <div>
                <a href="#" class="btn btn-outline-secondary">Export</a>
                <a href="#" class="btn btn-primary">New Scan</a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">All Severities</option>
                    <option value="critical">Critical</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Search title, domain">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Domain</th>
                        <th>Severity</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Models\Vulnerability::latest()->take(50)->get() as $v)
                    <tr>
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->title }}</td>
                        <td>{{ $v->domain->name ?? '-' }}</td>
                        <td>{{ ucfirst($v->severity) }}</td>
                        <td>{{ $v->created_at?->format('Y-m-d') ?? '-' }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-secondary">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
