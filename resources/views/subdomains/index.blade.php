@extends('layouts.app')

@section('title','Subdomains')
@section('page_title','Subdomains')
@section('page_subtitle','Enumerated subdomains')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Subdomains</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Domain</th>
                            <th>Subdomain</th>
                            <th>IP</th>
                            <th>Last Scanned</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rows = $subdomains ?? collect(); @endphp
                        @forelse($rows as $s)
                        <tr>
                            <td>{{ $s->id }}</td>
                            <td>{{ $s->domain->domain ?? '—' }}</td>
                            <td>{{ $s->subdomain }}</td>
                            <td>{{ $s->ip_address }}</td>
                            <td>{{ $s->last_scanned_at?->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No subdomains found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
