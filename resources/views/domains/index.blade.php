@extends('layouts.app')

@section('title', 'Domains')
@section('page_title', 'Attack Surface Management')
@section('page_subtitle', 'Domain Monitoring & Discovery')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Domains</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Stats Row -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $domains->total() }}</h3>
                    <p>Total Domains</p>
                </div>
                <div class="icon"><i class="fas fa-globe"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $domains->where('is_monitored', true)->count() }}</h3>
                    <p>Monitored</p>
                </div>
                <div class="icon"><i class="fas fa-eye"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $domains->sum('subdomains_count') }}</h3>
                    <p>Total Subdomains</p>
                </div>
                <div class="icon"><i class="fas fa-sitemap"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $domains->sum('vulnerabilities_count') }}</h3>
                    <p>Vulnerabilities</p>
                </div>
                <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
            </div>
        </div>
    </div>

    <!-- Domains Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Domain List</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDomainModal">
                            <i class="fas fa-plus"></i> Add Domain
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Domain</th>
                                <th>Subdomains</th>
                                <th>Vulnerabilities</th>
                                <th>Status</th>
                                <th>Last Scanned</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($domains as $domain)
                            <tr>
                                <td>
                                    <a href="{{ route('domains.show', $domain->id) }}" class="text-primary">
                                        <i class="fas fa-globe mr-1"></i> {{ $domain->domain }}
                                    </a>
                                </td>
                                <td><span class="badge badge-info">{{ $domain->subdomains_count ?? 0 }}</span></td>
                                <td><span class="badge badge-danger">{{ $domain->vulnerabilities_count ?? 0 }}</span></td>
                                <td>
                                    @if($domain->is_monitored)
                                        <span class="badge badge-success">Monitored</span>
                                    @else
                                        <span class="badge badge-secondary">Not Monitored</span>
                                    @endif
                                </td>
                                <td>{{ $domain->last_scanned_at ? $domain->last_scanned_at->diffForHumans() : 'Never' }}</td>
                                <td>
                                    <a href="{{ route('domains.show', $domain->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $domain->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No domains found. Add your first domain to start monitoring.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $domains->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Domain Modal -->
<div class="modal fade" id="addDomainModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('domains.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Domain</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Domain Name</label>
                        <input type="text" name="domain" class="form-control" placeholder="example.com" required>
                    </div>
                    <input type="hidden" name="company_id" value="{{ auth()->user()->company_id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Domain</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this domain?')) {
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '/domains/' + id;
        form.innerHTML = '@csrf @method("DELETE")';
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush
