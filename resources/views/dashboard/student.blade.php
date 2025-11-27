@extends('layouts.app')
@section('title', 'Dashboard Mentee')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-people"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Mentor</span>
                    <span class="info-box-number">
                        0
                        <small>Orang</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
@endsection
