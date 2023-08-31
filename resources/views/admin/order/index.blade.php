@extends('layouts.app')
@section('title','PROJECT Management')
@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">projects</h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>Project ID</td>
                                    <td>Traking No</td>
                                    <td>User Name</td>
                                    <td>ordered Date</td>
                                    <td>Action</td>
                                </tr>
                                @forelse ($order as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->traking_no }}</td>
                                        <td>{{ $item->fullname }}</td>
                                        <td>{{ $item->created_at->format('y-m-d') }}</td>
                                        <td><a href="{{ url('admin/order/'.$item->id) }}" class="btn btn-primary">view</a></td>
                                    </tr>
                                @empty
                                    <h4>no data to show</h4>
                                @endforelse
                            </table>
                        </div>
                        {{-- <div>
                            {{ $orders->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
