@extends('dashboard.producer.dashboard')

@section('title','ALL Projects')
@section('content')

<livewire:frontend.product.index :project="$project" :category="$category">

@endsection

