@extends('layouts.app')

@section('title','Tech Stack')
@section('page_title','Tech Stack')
@section('page_subtitle','Detected technology stack for domains')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tech Stack</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Domain</th>
                            <th>Technology</th>
                            <th>Version</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rows = $techStacks ?? collect(); @endphp
                        @forelse($rows as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td>{{ $t->domain->domain ?? '—' }}</td>
                            <td>{{ $t->name }}</td>
                            <td>{{ $t->version }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">No tech stacks found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
