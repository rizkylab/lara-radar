@extends('layouts.app')

@php
    $alerts = $alerts ?? collect();
@endphp

@section('title','Dashboard')
@section('page_title','Dashboard ASM')
@section('page_subtitle','Attack Surface Management Overview')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Small boxes -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $stats['domains'] ?? 0 }}</h3>
                    <p>Domains</p>
                </div>
                <div class="icon"><i class="fas fa-globe"></i></div>
                <a href="{{ route('domains.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['subdomains'] ?? 0 }}</h3>
                    <p>Subdomains</p>
                </div>
                <div class="icon"><i class="fas fa-sitemap"></i></div>
                <a href="{{ route('subdomains.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['ports'] ?? 0 }}</h3>
                    <p>Open Ports</p>
                </div>
                <div class="icon"><i class="fas fa-network-wired"></i></div>
                <a href="{{ route('ports.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stats['vulnerabilities'] ?? 0 }}</h3>
                    <p>Vulnerabilities</p>
                </div>
                <div class="icon"><i class="fas fa-bug"></i></div>
                <a href="{{ route('vulnerabilities.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <section class="col-lg-6 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Vulnerability Distribution</h3>
                </div>
                <div class="card-body">
                    <div id="chart-vulnerability-distribution"></div>
                </div>
            </div>
        </section>
        <section class="col-lg-6 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Severity Breakdown</h3>
                </div>
                <div class="card-body">
                    <div id="chart-severity"></div>
                </div>
            </div>
        </section>
    </div>

    <!-- Recent Alerts -->
    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Alerts</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Alert</th>
                                <th>Severity</th>
                                <th>Category</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alerts as $alert)
                            <tr>
                                <td>{{ $alert->title }}</td>
                                <td><span class="badge bg-{{ $alert->severity_class }}">{{ ucfirst($alert->severity) }}</span></td>
                                <td>{{ $alert->category }}</td>
                                <td>{{ $alert->created_at->diffForHumans() }}</td>
                                <td><span class="badge bg-{{ $alert->status_class }}">{{ ucfirst($alert->status) }}</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center">No alerts found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var optionsVulnDist = {
        series: [{ name: 'Vulnerabilities', data: {{ json_encode($vulnDistribution ?? [0,0,0,0,0,0,0]) }} }],
        chart: { type: 'bar', height: 350 },
        plotOptions: { bar: { horizontal: false, columnWidth: '55%', endingShape: 'rounded' } },
        dataLabels: { enabled: false },
        stroke: { show: true, width: 2, colors: ['transparent'] },
        xaxis: { categories: {{ json_encode($vulnDistDays ?? ['Mon','Tue','Wed','Thu','Fri','Sat','Sun']) }} },
        fill: { opacity: 1 },
        tooltip: { y: { formatter: function(val){ return val + ' vulnerabilities'; } } },
        colors: ['#435ebe']
    };
    new ApexCharts(document.querySelector('#chart-vulnerability-distribution'), optionsVulnDist).render();

    var optionsSeverity = {
        series: {{ json_encode($severityDistribution ?? [0,0,0,0,0]) }},
        labels: ['Critical','High','Medium','Low','Info'],
        colors: ['#dc3545','#fd7e14','#ffc107','#0dcaf0','#6c757d'],
        chart: { type: 'donut', height: 350 },
        legend: { position: 'bottom' }
    };
    new ApexCharts(document.querySelector('#chart-severity'), optionsSeverity).render();
</script>
@endpush
