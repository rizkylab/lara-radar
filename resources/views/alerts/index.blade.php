@extends('layouts.app')

@section('title','Alert Center')
@section('page_title','Alert Center')
@section('page_subtitle','System alerts and notifications')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Alerts</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-sm btn-success">Mark all read</a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Severity</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rows = $alerts ?? collect(); @endphp
                        @forelse($rows as $a)
                        <tr>
                            <td>{{ $a->title }}</td>
                            <td>{{ ucfirst($a->severity) }}</td>
                            <td>{{ $a->created_at?->diffForHumans() }}</td>
                            <td>{{ ucfirst($a->status) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">No alerts found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
