@extends('layouts.app')

@section('title', 'Digital Footprint')
@section('page_title', 'Digital Footprint')
@section('page_subtitle', 'Attack Surface Discovery & Monitoring')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Subdomains</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Top Charts Row -->
    <div class="row mb-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Exposure Timeline</h5>
                    <div id="chart-exposure-heatmap" style="height: 250px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Top Open Ports</h5>
                    <div id="chart-top-ports" style="height: 250px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Top ASN/S Scores Table</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                            <small>*.goapotik.com</small>
                            <span class="badge badge-warning">992</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                            <small>shop.goapotik.com</small>
                            <span class="badge badge-warning">992</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                            <small>dev.goapotik.com</small>
                            <span class="badge badge-warning">992</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $subdomains->total() }} Total Assets</h3>
                    <div class="card-tools">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-secondary"><i class="fas fa-th"></i></button>
                            <button class="btn btn-outline-secondary"><i class="fas fa-bars"></i></button>
                            <button class="btn btn-outline-secondary"><i class="fas fa-list"></i></button>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary ml-2">
                            <i class="fas fa-filter"></i> Featured Filters
                        </button>
                        <button class="btn btn-sm btn-primary ml-2">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="30"><input type="checkbox" id="selectAll"></th>
                                <th>Asset Type</th>
                                <th>Asset Name</th>
                                <th>Discovery Date</th>
                                <th>Tags</th>
                                <th>Monitor</th>
                                <th>Exclude</th>
                                <th>Source</th>
                                <th>Discovery Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subdomains as $subdomain)
                            <tr>
                                <td><input type="checkbox" class="select-item"></td>
                                <td>
                                    @if($subdomain->ports_count > 0)
                                        <span class="badge badge-success">SSL Certificate</span>
                                    @else
                                        <span class="badge badge-info">Technology</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('subdomains.show', $subdomain->id) }}" class="text-primary">
                                        <i class="fas fa-link"></i> {{ $subdomain->subdomain }}
                                    </a>
                                </td>
                                <td>{{ $subdomain->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if($subdomain->status_code == 200)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" {{ $subdomain->is_monitored ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $subdomain->ip_address ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        @if($subdomain->ports_count > 0)
                                            Discovered via Domain SSL Certificate
                                        @else
                                            Website Radar
                                        @endif
                                    </small>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No subdomains found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $subdomains->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Toggle Switch */
.switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 20px;
}
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
}
.slider:before {
    position: absolute;
    content: "";
    height: 14px;
    width: 14px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
}
input:checked + .slider {
    background-color: #28a745;
}
input:checked + .slider:before {
    transform: translateX(20px);
}
.slider.round {
    border-radius: 20px;
}
.slider.round:before {
    border-radius: 50%;
}
</style>
@endpush

@push('scripts')
<script>
// Exposure Heatmap
var heatmapOptions = {
    series: [{
        name: 'M',
        data: generateHeatmapData()
    }, {
        name: 'T',
        data: generateHeatmapData()
    }, {
        name: 'W',
        data: generateHeatmapData()
    }, {
        name: 'T',
        data: generateHeatmapData()
    }, {
        name: 'F',
        data: generateHeatmapData()
    }, {
        name: 'S',
        data: generateHeatmapData()
    }, {
        name: 'S',
        data: generateHeatmapData()
    }],
    chart: {
        height: 250,
        type: 'heatmap',
        toolbar: { show: false }
    },
    plotOptions: {
        heatmap: {
            colorScale: {
                ranges: [{
                    from: 0,
                    to: 0,
                    color: '#f0f0f0',
                    name: 'none',
                }, {
                    from: 1,
                    to: 5,
                    color: '#c6e48b',
                    name: 'low',
                }, {
                    from: 6,
                    to: 10,
                    color: '#7bc96f',
                    name: 'medium',
                }, {
                    from: 11,
                    to: 20,
                    color: '#239a3b',
                    name: 'high',
                }, {
                    from: 21,
                    to: 50,
                    color: '#196127',
                    name: 'extreme',
                }]
            }
        }
    },
    dataLabels: { enabled: false },
    xaxis: {
        categories: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    }
};
new ApexCharts(document.querySelector("#chart-exposure-heatmap"), heatmapOptions).render();

function generateHeatmapData() {
    var data = [];
    for (var i = 0; i < 6; i++) {
        data.push({
            x: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'][i],
            y: Math.floor(Math.random() * 30)
        });
    }
    return data;
}

// Top Ports Donut
var portsOptions = {
    series: [30, 25, 20, 15, 10],
    labels: ['HTTP: 80', 'HTTPS: 443', 'SSH: 22', 'FTP: 21', 'Admin: 38'],
    colors: ['#e91e63', '#00bcd4', '#9c27b0', '#ff9800', '#4caf50'],
    chart: {
        type: 'donut',
        height: 250
    },
    legend: {
        position: 'bottom',
        fontSize: '11px'
    }
};
new ApexCharts(document.querySelector("#chart-top-ports"), portsOptions).render();

// Select All
document.getElementById('selectAll').addEventListener('change', function() {
    document.querySelectorAll('.select-item').forEach(cb => cb.checked = this.checked);
});
</script>
@endpush
