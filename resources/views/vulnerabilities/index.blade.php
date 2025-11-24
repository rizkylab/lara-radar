@extends('layouts.app')

@section('title', 'Vulnerability Intelligence')
@section('page_title', 'Vulnerability Intelligence')
@section('page_subtitle', 'CVE Trends & Weaponized Vulnerabilities')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Vulnerabilities</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Top Stats Row -->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="small-box bg-gradient-primary">
                <div class="inner">
                    <h3>{{ number_format($stats['total']) }}</h3>
                    <p>CVE Trends</p>
                </div>
                <div class="icon"><i class="fas fa-chart-line"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3>{{ $stats['critical'] }}</h3>
                    <p>Weaponized Vulnerabilities</p>
                </div>
                <div class="icon"><i class="fas fa-bomb"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <h3>{{ number_format($stats['total']) }}</h3>
                    <p>Exploited Vulnerabilities</p>
                </div>
                <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
            </div>
        </div>
    </div>

    <!-- Second Stats Row -->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-shield-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ransomware</span>
                    <span class="info-box-number">232</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-bug"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">CISA Known Exploited</span>
                    <span class="info-box-number">1.5K</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-fire"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Vulnerabilities</span>
                    <span class="info-box-number">372.3K</span>
                </div>
            </div>
        </div>
    </div>

    <!-- CVE Trends Chart -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">CVE Trends</h3>
                    <div class="card-tools">
                        <select class="form-control form-control-sm" style="width: auto;">
                            <option>Weekly</option>
                            <option>Monthly</option>
                            <option>Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart-cve-trends" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Top CVEs</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            CVE-2025-94491
                            <span class="badge badge-danger">2M</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            CVE-2025-13223
                            <span class="badge badge-warning">1.6M</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            CVE-2025-47857
                            <span class="badge badge-warning">1.5M</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            CVE-2025-14229
                            <span class="badge badge-info">848.6K</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            CVE-2025-11021
                            <span class="badge badge-info">688.6K</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Vulnerability Cards -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Vulnerabilities</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 300px;">
                            <input type="text" class="form-control" placeholder="Try GitHub 8.4">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vulnerability Grid -->
    <div class="row">
        @forelse($vulnerabilities as $vuln)
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-bug text-danger"></i> {{ $vuln->cve_id ?? 'CVE-' . date('Y') . '-' . rand(10000, 99999) }}
                        </h5>
                        <div>
                            <i class="far fa-star"></i>
                            <i class="far fa-bell"></i>
                        </div>
                    </div>
                    <p class="text-muted small">{{ $vuln->title }}</p>
                    <div id="chart-vuln-{{ $vuln->id }}" style="height: 100px;"></div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <small class="text-muted">CVSS Score:</small>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-{{ $vuln->cvss_score >= 7 ? 'danger' : ($vuln->cvss_score >= 4 ? 'warning' : 'info') }}" 
                                     style="width: {{ ($vuln->cvss_score / 10) * 100 }}%"></div>
                            </div>
                            <strong>{{ $vuln->cvss_score ?? '7.8' }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">EPSS Score:</small>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-danger" style="width: 77%"></div>
                            </div>
                            <strong>77</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">No vulnerabilities found.</div>
        </div>
        @endforelse
    </div>

    <div class="row">
        <div class="col-12">
            {{ $vulnerabilities->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// CVE Trends Chart
var trendsOptions = {
    series: [
        { name: 'CVE-2025-94491', data: [22, 23, 24, 25, 24, 23, 22] },
        { name: 'CVE-2025-13223', data: [13, 14, 15, 16, 15, 14, 13] },
        { name: 'CVE-2025-47857', data: [10, 11, 12, 13, 12, 11, 10] },
        { name: 'CVE-2025-14229', data: [8, 9, 10, 11, 10, 9, 8] },
        { name: 'CVE-2025-11021', data: [6, 7, 8, 9, 8, 7, 6] }
    ],
    chart: {
        type: 'line',
        height: 300,
        toolbar: { show: false }
    },
    stroke: { curve: 'smooth', width: 2 },
    xaxis: {
        categories: ['Nov 18', 'Nov 19', 'Nov 20', 'Nov 21', 'Nov 22', 'Nov 23', 'Nov 24']
    },
    colors: ['#dc3545', '#fd7e14', '#ffc107', '#0dcaf0', '#6c757d'],
    legend: { position: 'bottom' }
};
new ApexCharts(document.querySelector("#chart-cve-trends"), trendsOptions).render();

// Individual vulnerability mini charts
@foreach($vulnerabilities as $vuln)
var vulnChart{{ $vuln->id }} = {
    series: [{ data: [22, 23, 24, 25, 24, 23, 22] }],
    chart: { type: 'area', height: 100, sparkline: { enabled: true } },
    stroke: { curve: 'smooth', width: 2 },
    fill: { opacity: 0.3 },
    colors: ['#667eea']
};
new ApexCharts(document.querySelector("#chart-vuln-{{ $vuln->id }}"), vulnChart{{ $vuln->id }}).render();
@endforeach
</script>
@endpush
