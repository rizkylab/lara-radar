@extends('layouts.app')

@section('title','Settings')
@section('page_title','Settings')
@section('page_subtitle','Application configuration')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">General Settings</h3>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label>Site Name</label>
                        <input type="text" class="form-control" value="{{ config('app.name') }}">
                    </div>
                    <div class="form-group">
                        <label>Default Alert Email</label>
                        <input type="email" class="form-control" value="{{ env('MAIL_FROM_ADDRESS') }}">
                    </div>
                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
