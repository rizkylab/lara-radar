@extends('layouts.app')

@section('title', 'Threat Hunting')
@section('page_title', 'Threat Hunting')
@section('page_subtitle', 'Search for Keywords, IP Addresses, Email Addresses, Domains, Hashes, URLs')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Threat Hunting</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Main Search Section -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <h1 class="display-4 mb-4">
                        <i class="fas fa-bolt text-danger"></i> Threat <span class="text-danger">Hunting</span>
                    </h1>
                    <form action="{{ route('threat-hunting.search') }}" method="GET">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" name="q" class="form-control" 
                                   placeholder="Search for Keywords, IP Addresses, Email Addresses, Domains, Hashes, URLs ..." 
                                   value="{{ $query ?? '' }}" required>
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="text-muted">
                        <small>
                            <i class="fas fa-info-circle"></i> 
                            Remaining Credits: <strong>50</strong>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trending Insights Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-fire text-warning"></i> Trending Insights
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach([
                            ['domain' => 'Goapotik.com', 'type' => 'Search result for company name', 'icon' => 'building'],
                            ['domain' => 'Goapotik.com', 'type' => 'Infected Device related to Com...', 'icon' => 'virus'],
                            ['domain' => 'Goapotik.com', 'type' => 'Company Related Information on ...', 'icon' => 'info-circle'],
                            ['domain' => 'Goapotik.com', 'type' => 'Search for domain in Code Repo...', 'icon' => 'code']
                        ] as $insight)
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <i class="fas fa-{{ $insight['icon'] }} fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $insight['domain'] }}</h6>
                                            <small class="text-muted">{{ $insight['type'] }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Add Shortcut Card -->
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card border-dashed h-100">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <button class="btn btn-outline-secondary">
                                        <i class="fas fa-plus"></i> Add shortcut
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Searches / Stats -->
    <div class="row mt-4">
        <div class="col-lg-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['open_vulnerabilities'] ?? 0 }}</h3>
                    <p>Open Vulnerabilities</p>
                </div>
                <div class="icon"><i class="fas fa-bug"></i></div>
                <a href="{{ route('vulnerabilities.index') }}" class="small-box-footer">
                    View Details <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stats['critical_cves'] ?? 0 }}</h3>
                    <p>Critical CVEs</p>
                </div>
                <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
                <a href="{{ route('cve.index') }}" class="small-box-footer">
                    View Details <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['monitored_domains'] ?? 0 }}</h3>
                    <p>Monitored Domains</p>
                </div>
                <div class="icon"><i class="fas fa-globe"></i></div>
                <a href="{{ route('domains.index') }}" class="small-box-footer">
                    View Details <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Vulnerabilities -->
    @if(isset($recentVulns) && $recentVulns->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Open Vulnerabilities</h5>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Severity</th>
                                <th>CVSS Score</th>
                                <th>Domain</th>
                                <th>Discovered</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentVulns as $vuln)
                            <tr>
                                <td>{{ $vuln->title }}</td>
                                <td>
                                    <span class="badge badge-{{ $vuln->severity == 'critical' ? 'danger' : ($vuln->severity == 'high' ? 'warning' : 'info') }}">
                                        {{ ucfirst($vuln->severity) }}
                                    </span>
                                </td>
                                <td>{{ $vuln->cvss_score ?? 'N/A' }}</td>
                                <td>{{ $vuln->domain->domain ?? 'N/A' }}</td>
                                <td>{{ $vuln->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('vulnerabilities.show', $vuln->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.border-dashed {
    border: 2px dashed #dee2e6 !important;
}
.border-left-primary {
    border-left: 4px solid #007bff !important;
}
</style>
@endpush
