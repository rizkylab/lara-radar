@extends('layouts.app')

@section('title','Users & Roles')
@section('page_title','Users & Roles')
@section('page_subtitle','Manage users and role assignments')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>
                <div class="card-tools">
                    <a href="{{ route('users.create') ?? '#' }}" class="btn btn-sm btn-primary">New User</a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Roles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rows = $users ?? collect(); @endphp
                        @forelse($rows as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->company->name ?? '—' }}</td>
                            <td>{{ $u->getRoleNames()->join(', ') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No users found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
