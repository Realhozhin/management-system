@extends('layouts.app')
@section('title','Projects')
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
                    <h4 style="float: left">Add Projects</h4>
                    <a href="#" style="float: right" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addproject">
                        <i class="bi bi-plus-square"></i> Add New Projects
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-left">
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Company</th>
                            <th>status</th>
                            <th>Exp_Time</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        @foreach ($project as $item)
                            <tr>
                                <th>{{ $item->id }}</th>
                                <th>
                                    @if ($item->category)
                                        {{ $item->category->name }}
                                    @else
                                        no category
                                    @endif
                                </th>
                                <th>{{ $item->project_name }}</th>
                                <th>{{ $item->description }}</th>
                                <td>{{ $item->company }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->exp_time }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteproject{{ $item->id }}"><i class="bi bi-trash"></i> Delete</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editproject{{ $item->id }}"><i class="bi bi-pencil-square"></i> Update</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div>{{ $project->links() }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 row">
            <div class="card">
                <div class="card-header">
                    <h4>Search Project</h4>
                </div>
                <div class="card-body">
                    .........
                </div>
            </div>
        </div>
    </div>
    {{-- modal for add user --}}
        <div class="modal right fade" id="addproject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Add Project</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>select CATEGORY</label>
                            <select name="category_id" class="form-control" style="border: 2px inset lightslategray">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="project_name" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="description" id="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>select Company</label>
                            <select name="company" class="form-control" style="border: 2px inset lightslategray">
                                @foreach($companies as $company)
                                    <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>select producer</label>
                            <select name="producer[]" multiple class="form-control" style="border: 2px inset lightslategray">
                                @foreach($producers as $producer)
                                    <option value="{{ $producer->id }}">{{ $producer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Exp_Time</label>
                            <select name="exp_time" class="form-control">
                                <option value="2 weeks">2 weeks</option>
                                <option value="1 month">1 month</option>
                                <option value="6 weeks">6 weeks</option>
                                <option value="2 month">2 month</option>
                                <option value="10 weeks">10 weeks</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block w-100">Save Project</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    {{-- modal for edit project --}}
        @foreach ($project as $item)
        <div class="modal right fade" id="editproject{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Edit project</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.update',$item->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="project_name" value="{{ $item->project_name }}" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="description" value="{{ $item->description }}" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Company</label>
                            <input type="text" name="company" value="{{ $item->company }}" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Exp_Time</label> : {{ $item->exp_time }}
                            <select name="exp_time" class="form-control">
                                <option value="2 weeks">2 weeks</option>
                                <option value="1 month">1 month</option>
                                <option value="6 weeks">6 weeks</option>
                                <option value="2 month">2 month</option>
                                <option value="10 weeks">10 weeks</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block w-100">Update Project</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        @endforeach

    {{-- modal for delete project --}}
        @foreach ($project as $item)
        <div class="modal right fade" id="deleteproject{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">delete Project</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.destroy',$item->id) }}" method="post">
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
