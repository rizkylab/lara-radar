@extends('layouts.app')

@section('title', 'Domains')
@section('page_title', 'Domains')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Domain List</h5>
            <a href="#" class="btn btn-primary">Add Domain</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Domain</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach(App\Models\Domain::latest()->take(20)->get() as $domain)
                <tr>
                    <td>{{ $domain->id }}</td>
                    <td><a href="{{ route('domains.show', $domain->id) }}">{{ $domain->name }}</a></td>
                    <td>{{ $domain->company->name ?? '-' }}</td>
                    <td>{{ ucfirst($domain->status) }}</td>
                    <td>
                        <a href="{{ route('domains.show', $domain->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
