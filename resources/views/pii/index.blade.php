@extends('layouts.app')

@section('title','PII Exposure')
@section('page_title','PII Exposure')
@section('page_subtitle','Personally Identifiable Information exposures')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">PII Exposures</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Type</th>
                            <th>Exposed Data</th>
                            <th>Source</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rows = $piiExposures ?? collect(); @endphp
                        @forelse($rows as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->company->name ?? '—' }}</td>
                            <td>{{ $p->data_type }}</td>
                            <td>{{ $p->exposed_data }}</td>
                            <td>{{ $p->source }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No PII exposures found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
