@extends('layouts.app')

@section('title','Botnet Data')
@section('page_title','Botnet Data')
@section('page_subtitle','Known botnet IPs and metadata')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Botnet List</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>IP Address</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Last Seen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rows = $botnets ?? collect(); @endphp
                        @forelse($rows as $b)
                        <tr>
                            <td>{{ $b->id }}</td>
                            <td>{{ $b->ip_address }}</td>
                            <td>{{ $b->botnet_name }}</td>
                            <td>{{ $b->country }}</td>
                            <td>{{ $b->last_seen_at?->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No botnet records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
