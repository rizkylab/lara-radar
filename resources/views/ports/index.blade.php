@extends('layouts.app')

@section('title','Open Ports')
@section('page_title','Open Ports')
@section('page_subtitle','Discovered open ports')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Open Ports</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Domain</th>
                            <th>Subdomain</th>
                            <th>Port</th>
                            <th>Service</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rows = $ports ?? collect(); @endphp
                        @forelse($rows as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->domain->domain ?? '—' }}</td>
                            <td>{{ $p->subdomain?->subdomain ?? '—' }}</td>
                            <td>{{ $p->port }}</td>
                            <td>{{ $p->service }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No ports found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
