@extends('layouts.app')
@section('title', 'Dashboard Mentor')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-dark shadow-sm">
                    <i class="bi bi-diagram-3"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Divisi</span>
                    <span class="info-box-number">
                        0
                        <small>Divisi</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-secondary shadow-sm">
                    <i class="bi bi-person-badge"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Mentee</span>
                    <span class="info-box-number">
                        0
                        <small>Mentee</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
@endsection
