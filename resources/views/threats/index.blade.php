@extends('layouts.app')

@section('title','Threat Hunting')
@section('page_title','Threat Hunting')
@section('page_subtitle','Search and investigate threat indicators')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Threat Hunting</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('threat-hunting.index') }}" class="form-inline mb-3">
                    <div class="input-group w-50">
                        <input type="text" name="q" class="form-control" placeholder="Search indicators, domain, IP, CVE" value="{{ request('q') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Indicator</th>
                                <th>Type</th>
                                <th>First Seen</th>
                                <th>Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $rows = $threats ?? collect(); @endphp
                            @forelse($rows as $t)
                            <tr>
                                <td>{{ $t->indicator }}</td>
                                <td>{{ $t->type }}</td>
                                <td>{{ $t->first_seen?->diffForHumans() }}</td>
                                <td>{{ $t->source }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center">No threat indicators found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
