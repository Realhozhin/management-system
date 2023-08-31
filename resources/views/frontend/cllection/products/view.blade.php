@extends('dashboard.producer.dashboard')
@section('title','Project')
@section('content')
<div>
    <livewire:frontend.product.view :category="$category" :project="$project" :producers="$producers" >
</div>
@endsection

