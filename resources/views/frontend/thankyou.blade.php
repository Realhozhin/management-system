@extends('dashboard.producer.dashboard')

@section('title','build something amazing')
@section('content')

    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="p-4 shadow bg-white">
                        <h1>PARNAS</h1>
                        <h4>*remember who you wanted to be*</h4>
                        <hr>
                        <a href="{{ route('categories') }}" class="btn btn-primary">see more offer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
