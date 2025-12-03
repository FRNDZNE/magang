@extends('layouts.app')
@section('title', 'Logbook')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Logbook Magang</h3>
        </div>
        <div class="card-body">
            <a href="" class="btn btn-md btn-primary"></a>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
