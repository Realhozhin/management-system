@extends('layouts.app')
@section('title','Users')
@section('content')
    <div class="container-fluid row d-flex justify-content-between p-5">
        @if(session('update'))
        <h3 class="text-center text-success">{{session('update')}}</h3>
        @endif
        @if(session('delete'))
            <h3 class="text-center text-danger">{{session('delete')}}</h3>
        @endif
        @if(session('success'))
            <h3 class="text-center text-success">{{session('success')}}</h3>
        @endif
        @if(session('fail'))
            <h3 class="text-center text-danger">{{session('fail')}}</h3>
        @endif
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 style="float: left">Add category</h4>
                    <a href="#" style="float: right" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addcategory">
                        <i class="bi bi-plus-square"></i> Add New category
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-left">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Descrption</th>
                            <th>Status</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        @foreach ($category as $item)
                            <tr>
                                <th>{{ $item->id }}</th>
                                <th>{{  $item->name }}</th>
                                <th>{{  $item->slug }}</th>
                                <th>{{  $item->description }}</th>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletecategory{{ $item->id }}"><i class="bi bi-trash"></i> Delete</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editcategory{{ $item->id }}"><i class="bi bi-pencil-square"></i> Update</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div>{{ $category->links() }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 row">
            <div class="card">
                <div class="card-header">
                    <h4>Search category</h4>
                </div>
                <div class="card-body">
                    .........
                </div>
            </div>
        </div>
    </div>
    {{-- modal for add user --}}
        <div class="modal right fade" id="addcategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Add User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input type="text" name="slug" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" name="description" id="" class="form-control" rows="3" style="resize: none"></textarea>
                        </div>
                        <div class="pt-2">
                            <label for="">Status</label>
                            <input type="checkbox" name="status" id="">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block w-100">Save category</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    {{-- modal for edit user --}}
        @foreach ($category as $item)
        <div class="modal right fade" id="editcategory{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Edit category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.update',$item->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" value="{{ $item->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input type="text" name="slug" id="" value="{{ $item->slug }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" name="description" id="" value="" rows="3" style="resize: none" class="form-control">{{ $item->description }}</textarea>
                        </div>
                        <div class="d-block mt-3 col-md-6 mb-3">
                            {!! Form::label('status','status') !!}
                            <input type="checkbox" name="status" {{ $item->status == 'on'?'checked':'' }}>
                            @error('status')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block w-100">update category</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        @endforeach

    {{-- modal for delete user --}}
        @foreach ($category as $item)
        <div class="modal right fade" id="deletecategory{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">delete category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.destroy',$item->id) }}" method="post">
                        @csrf
                        @method('delete')
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
    <style>
        .modal.right .modal-dialog{
            top: 0;
            right: 0;
            margin-right: 20vh;
        }

        .modal.fade:not(.in).right .modal-dialog{
            -webkit-transform: translate3d(25%, 0, 0);
            transform: translate3d(25%, 0, 0);
        }
    </style>
@endsection
