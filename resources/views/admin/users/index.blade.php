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
                    <h4 style="float: left">Add User</h4>
                    <a href="#" style="float: right" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#adduser">
                        <i class="bi bi-plus-square"></i> Add New User
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-left">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        @foreach ($users as $item)
                            <tr>
                                <th>{{ $item->id }}</th>
                                <th>{{  $item->name }}</th>
                                <th>{{  $item->phone }}</th>
                                <th>{{  $item->email }}</th>
                                <td>{{ $item->role_as }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteuser{{ $item->id }}"><i class="bi bi-trash"></i> Delete</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edituser{{ $item->id }}"><i class="bi bi-pencil-square"></i> Update</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div>{{ $users->links() }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 row">
            <div class="card">
                <div class="card-header">
                    <h4>Search Producer</h4>
                </div>
                <div class="card-body">
                    .........
                </div>
            </div>
        </div>
    </div>
    {{-- modal for add user --}}
        <div class="modal right fade" id="adduser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Add User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">confirm password</label>
                            <input type="password" name="confirm_password" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">role</label>
                            <select name="role_as" class="form-control">
                                <option value="admin">admin</option>
                                <option value="producer">producer</option>
                                <option value="user">user</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block w-100">Save User</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    {{-- modal for edit user --}}
        @foreach ($users as $item)
        <div class="modal right fade" id="edituser{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Edit User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.update',$item->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" value="{{ $item->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" id="" value="{{ $item->phone }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="" value="{{ $item->email }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">role</label> : {{ $item->role_as }}
                            <select name="role_as" class="form-control">
                                <option value="admin">admin</option>
                                <option value="producer">producer</option>
                                <option value="user">user</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block w-100">update User</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        @endforeach

    {{-- modal for delete user --}}
        @foreach ($users as $item)
        <div class="modal right fade" id="deleteuser{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">delete User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.destroy',$item->id) }}" method="post">
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
