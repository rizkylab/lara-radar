@extends('layouts.app')

@section('title', 'Domain Detail')
@section('page_title', 'Domain Detail')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="mb-0">Domain: {{ $id ?? 'N/A' }}</h4>
                        <small class="text-muted">Overview and recent findings</small>
                    </div>
                    <div>
                        <a href="{{ route('domains.index') }}" class="btn btn-outline-secondary">Back to list</a>
                    </div>
                </div>

                <ul class="nav nav-tabs mt-4" id="domainTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Overview</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="subdomains-tab" data-bs-toggle="tab" data-bs-target="#subdomains" type="button" role="tab">Subdomains</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ports-tab" data-bs-toggle="tab" data-bs-target="#ports" type="button" role="tab">Open Ports</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vulns-tab" data-bs-toggle="tab" data-bs-target="#vulns" type="button" role="tab">Vulnerabilities</button>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6>Domain Status</h6>
                                        <p class="mb-0">Active</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6>Recent Activity</h6>
                                        <p class="text-muted">No recent scans.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="subdomains" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Host</th>
                                        <th>IP</th>
                                        <th>Last Seen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Subdomain::where('domain_id', $id)->take(50)->get() as $sub)
                                    <tr>
                                        <td>{{ $sub->id }}</td>
                                        <td>{{ $sub->host }}</td>
                                        <td>{{ $sub->ip }}</td>
                                        <td>{{ $sub->created_at?->format('Y-m-d') ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="ports" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Subdomain</th>
                                        <th>Port</th>
                                        <th>Service</th>
                                        <th>Banner</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Port::whereIn('subdomain_id', App\Models\Subdomain::where('domain_id', $id)->pluck('id'))->get() as $port)
                                    <tr>
                                        <td>{{ $port->subdomain->host ?? '-' }}</td>
                                        <td>{{ $port->port }}</td>
                                        <td>{{ $port->service }}</td>
                                        <td>{{ Str::limit($port->banner ?? '-', 80) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="vulns" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Severity</th>
                                        <th>Discovered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(App\Models\Vulnerability::where('domain_id', $id)->get() as $v)
                                    <tr>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->title }}</td>
                                        <td>{{ ucfirst($v->severity) }}</td>
                                        <td>{{ $v->created_at?->format('Y-m-d') ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
