@extends('layouts.app')
@section('title','PROJECT Management')
@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">reports</h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>NAME</td>
                                    <td>EMAIL</td>
                                    <td>DESCRIPTION</td>
                                    <td>DELETE</td>
                                </tr>
                                @forelse ($report as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletereport{{ $item->id }}"><i class="bi bi-trash"></i> Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <h4>no data to show</h4>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal for delete report --}}
    @foreach ($report as $item)
    <div class="modal right fade" id="deletereport{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title fs-5" id="staticBackdropLabel">delete report</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('deletereport',$item->id) }}" method="post">
                    @csrf
                    {{-- @method('delete') --}}
                    <p>Are you Sure you want to delete this {{ $item->name }} ?</p>
                    <div class="form-footer">
                        <button class="btn btn-warning w-100">Delete</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    @endforeach

@endsection
