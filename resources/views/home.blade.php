@extends('layouts.app')
@section('title','dashboard')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <h4 class="card-header" style="background-color: #008b8b; color:aliceblue"><marquee>welcome to your dashboard and management system as admin</marquee></h4>

                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
