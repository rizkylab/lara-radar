@extends('layouts.app')

@section('title','CVE Intelligence')
@section('page_title','CVE Intelligence')
@section('page_subtitle','Recent CVEs and severity')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">CVE List</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>CVE ID</th>
                            <th>Description</th>
                            <th>CVSS</th>
                            <th>Published</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rows = $cves ?? collect(); @endphp
                        @forelse($rows as $c)
                        <tr>
                            <td>{{ $c->cve_id }}</td>
                            <td>{{ Str::limit($c->description, 120) }}</td>
                            <td>{{ $c->cvss_score }}</td>
                            <td>{{ $c->published_at?->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">No CVEs found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
