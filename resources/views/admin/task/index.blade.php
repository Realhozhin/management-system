@extends('layouts.app')
@section('title','Tasks')
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
                    <h4 style="float: left">Add Task</h4>
                    <a href="#" style="float: right" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addtask">
                        <i class="bi bi-plus-square"></i> Add New Task
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-left">
                        <tr>
                            <th>ID</th>
                            <th>PROJECT</th>
                            <th>NAME</th>
                            <th>STATUS</th>
                            <th>OWNER</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        @foreach ($task as $item)
                            <tr>
                                <th>{{ $item->id }}</th>
                                <th>
                                    @if ($item->project)
                                        {{ $item->project->project_name }}
                                    @else
                                        no project
                                    @endif
                                </th>
                                <th>{{ $item->name }}</th>
                                <td>{{ $item->status }}</td>
                                <th>
                                    @if ($item->owner)
                                        {{ $item->owner->name }}
                                    @else
                                        no project
                                    @endif
                                </th>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletetask{{ $item->id }}"><i class="bi bi-trash"></i> Delete</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTask{{ $item->id }}"><i class="bi bi-pencil-square"></i> Update</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div>{{ $task->links() }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 row">
            <div class="card">
                <div class="card-header">
                    <h4>Search Task</h4>
                </div>
                <div class="card-body">
                    .........
                </div>
            </div>
        </div>
    </div>
    {{-- modal for add user --}}
        <div class="modal right fade" id="addtask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Add Task</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tasks.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>select PROJECT</label>
                            <select name="project_id" class="form-control" style="border: 2px inset lightslategray">
                                @foreach($project as $item)
                                    <option value="{{ $item->id }}">{{ $item->project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block w-100">Save Task</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    {{-- modal for edit project --}}
        @foreach ($task as $item)
        <div class="modal right fade" id="editTask{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Edit Task</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tasks.update',$item->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ $item->name }}" id="" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block w-100">Update Task</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        @endforeach

    {{-- modal for delete project --}}
        @foreach ($task as $item)
        <div class="modal right fade" id="deletetask{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">delete Project</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tasks.destroy',$item->id) }}" method="post">
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
