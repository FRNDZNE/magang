@extends('layouts.app')
@section('title', 'Dashboard Mentee')
@section('role', ucfirst(Auth::user()->getRoleNames()->first()))
@section('page-active', 'active')
@section('content')
    <h1>Dashboard Student</h1>
@endsection
