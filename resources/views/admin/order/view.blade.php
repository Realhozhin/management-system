@extends('layouts.app')
@section('title','MY PROJECT Details')
@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4>project Details
                        <a href="{{ route('management') }}" class="btn btn-warning float-end">Back</a>
                        </h4>
                        <hr>
                    </div>
                        <br/>
                    <div class="row pt-5">
                        <div class="col-md-6">
                            <h5>Project Details</h5>
                            <hr>
                            <h6>
                                Project ID: <span style="color: rgb(50, 205, 89)">{{ $orderDetails->project_id }}</span>
                            </h6>
                            <h6>
                                Order ID: <span style="color: rgb(50, 205, 89)">{{ $order->id }}</span>
                            </h6>
                            <h6>
                                Task ID: <span style="color: rgb(50, 205, 89)">{{ $orderDetails->Task->name }}</span>
                            </h6>
                            <h6>
                                started at: <span style="color: rgb(50, 205, 89)">{{ $orderDetails->created_at->format('y-m-d') }}</span>
                            </h6>
                            <h6>
                                experation time: <span style="color: rgb(50, 205, 89)">{{ $orderDetails->exp_time }}</span>
                            </h6>
                            <h6>
                                Status: <span style="color: rgb(50, 205, 89)">{{ $order->status_message }}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>User Details</h5>
                            <hr>
                            <h6>
                                User ID: <span style="color: rgb(50, 205, 89)">{{ $order->user_id }}</span>
                            </h6>
                            <h6>
                                Name: <span style="color: rgb(50, 205, 89)">{{ $order->fullname }}</span>
                            </h6>
                            <h6>
                                Email: <span style="color: rgb(50, 205, 89)">{{ $order->email }}</span>
                            </h6>
                            <h6>
                                Phone: <span style="color: rgb(50, 205, 89)">{{ $order->phone }}</span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
