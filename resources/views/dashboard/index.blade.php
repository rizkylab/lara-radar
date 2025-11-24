@extends('layouts.app')

@section('title', 'Dashboard ASM')
@section('page-title', 'Dashboard ASM')
@section('page-subtitle', 'Attack Surface Management Overview')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
</ol>
@endsection

@section('content')
<div class="page-content">
    <!-- Statistics Cards -->
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Domains</h6>
                                    <h6 class="font-extrabold mb-0">{{ $stats['domains'] ?? 0 }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Subdomains</h6>
                                    <h6 class="font-extrabold mb-0">{{ $stats['subdomains'] ?? 0 }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Open Ports</h6>
                                    <h6 class="font-extrabold mb-0">{{ $stats['ports'] ?? 0 }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Vulnerabilities</h6>
                                    <h6 class="font-extrabold mb-0">{{ $stats['vulnerabilities'] ?? 0 }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Vulnerability Distribution</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-vulnerability-distribution"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Severity Breakdown</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-severity"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Alerts</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
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
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <p class="font-bold ms-3 mb-0">Critical SQL Injection</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <span class="badge badge-critical">Critical</span>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">Vulnerability</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">2 hours ago</p>
                                            </td>
                                            <td class="col-auto">
                                                <span class="badge bg-danger">Open</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <p class="font-bold ms-3 mb-0">Credential Leak Detected</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <span class="badge badge-high">High</span>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">Dark Web</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">5 hours ago</p>
                                            </td>
                                            <td class="col-auto">
                                                <span class="badge bg-warning">On Hold</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <p class="font-bold ms-3 mb-0">New CVE Published</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <span class="badge badge-medium">Medium</span>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">CVE</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">1 day ago</p>
                                            </td>
                                            <td class="col-auto">
                                                <span class="badge bg-success">Closed</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    // Vulnerability Distribution Chart
    var optionsVulnDist = {
        series: [{
            name: 'Vulnerabilities',
            data: [44, 55, 41, 67, 22, 43, 21]
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " vulnerabilities"
                }
            }
        },
        colors: ['#435ebe']
    };

    var chartVulnDist = new ApexCharts(document.querySelector("#chart-vulnerability-distribution"), optionsVulnDist);
    chartVulnDist.render();

    // Severity Donut Chart
    var optionsSeverity = {
        series: [44, 55, 13, 33, 22],
        labels: ['Critical', 'High', 'Medium', 'Low', 'Info'],
        colors: ['#dc3545', '#fd7e14', '#ffc107', '#0dcaf0', '#6c757d'],
        chart: {
            type: 'donut',
            height: 350
        },
        legend: {
            position: 'bottom'
        }
    };

    var chartSeverity = new ApexCharts(document.querySelector("#chart-severity"), optionsSeverity);
    chartSeverity.render();
</script>
@endpush
