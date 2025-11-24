@extends('layouts.app')

@section('title','Dark Web Monitoring')
@section('page_title','Dark Web Monitoring')
@section('page_subtitle','Leaked credentials & exposures')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dark Web Credentials</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-sm btn-primary">Export</a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Source</th>
                            <th>Leaked At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rows = $darkwebCredentials ?? collect(); @endphp
                        @forelse($rows as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->company->name ?? '—' }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->source }}</td>
                            <td>{{ $item->leaked_at?->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No dark web credentials found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
