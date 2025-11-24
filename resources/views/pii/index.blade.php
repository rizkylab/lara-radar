@extends('layouts.app')

@section('title', 'PII Exposure')
@section('page_title', 'PII Exposure Monitoring')
@section('page_subtitle', 'Personal Identifiable Information Breach Detection')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">PII Exposure</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Stats Row -->
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Credential Timeline</h5>
                    <div id="chart-credential-timeline" style="height: 200px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Record Statuses</h5>
                    <div id="chart-record-status" style="height: 200px;"></div>
                    <div class="text-center mt-2">
                        <span class="badge badge-warning">Open: {{ $stats['total'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Top Alarm Generated Accounts</h5>
                    <div id="chart-top-accounts" style="height: 200px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $stats['total'] }} Total Findings</h3>
                    <div class="card-tools">
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-filter"></i> Record Status
                        </button>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-filter"></i> Other Filters
                        </button>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-calendar"></i> Discovery Date
                        </button>
                        <button class="btn btn-sm btn-primary">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="30"><input type="checkbox" id="selectAll"></th>
                                <th>Email</th>
                                <th>Source</th>
                                <th>Password</th>
                                <th>Status</th>
                                <th>Discovery Date</th>
                                <th>Breach Date</th>
                                <th>Related Alarm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($exposures as $exposure)
                            <tr>
                                <td><input type="checkbox" class="select-item"></td>
                                <td>{{ $exposure->email }}</td>
                                <td>
                                    <a href="{{ $exposure->source }}" target="_blank" class="badge badge-info">
                                        {{ parse_url($exposure->source, PHP_URL_HOST) }}
                                    </a>
                                </td>
                                <td>
                                    <span class="text-muted">{{ str_repeat('*', 8) }}</span>
                                </td>
                                <td>
                                    @if($exposure->is_verified)
                                        <span class="badge badge-warning">Open</span>
                                    @else
                                        <span class="badge badge-secondary">Unverified</span>
                                    @endif
                                </td>
                                <td>{{ $exposure->discovered_at->format('Y-m-d') }}</td>
                                <td>{{ $exposure->breach_date ? $exposure->breach_date->format('Y-m-d') : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('pii.show', $exposure->id) }}" class="badge badge-warning">
                                        Open <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No PII exposures found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $exposures->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Credential Timeline Chart
var timelineOptions = {
    series: [{
        name: 'Credentials',
        data: [30, 40, 35, 50, 49, 60, 70, 91, 125, 100, 85, 95]
    }],
    chart: {
        type: 'area',
        height: 200,
        toolbar: { show: false }
    },
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 2 },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    colors: ['#667eea'],
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.3,
        }
    }
};
new ApexCharts(document.querySelector("#chart-credential-timeline"), timelineOptions).render();

// Record Status Donut
var statusOptions = {
    series: [{{ $stats['total'] }}],
    labels: ['Open'],
    colors: ['#ffc107'],
    chart: {
        type: 'donut',
        height: 200
    },
    legend: { show: false }
};
new ApexCharts(document.querySelector("#chart-record-status"), statusOptions).render();

// Top Accounts Donut
var accountsOptions = {
    series: [3, 3, 2, 2],
    labels: ['account1@example.com', 'account2@example.com', 'account3@example.com', 'account4@example.com'],
    colors: ['#667eea', '#764ba2', '#f093fb', '#4facfe'],
    chart: {
        type: 'donut',
        height: 200
    },
    legend: {
        position: 'bottom',
        fontSize: '11px'
    }
};
new ApexCharts(document.querySelector("#chart-top-accounts"), accountsOptions).render();

// Select All Checkbox
document.getElementById('selectAll').addEventListener('change', function() {
    document.querySelectorAll('.select-item').forEach(cb => cb.checked = this.checked);
});
</script>
@endpush
