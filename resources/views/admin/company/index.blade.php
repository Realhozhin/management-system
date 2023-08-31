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
                    <h4 style="float: left">Add company</h4>
                    <a href="#" style="float: right" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addcompany">
                        <i class="bi bi-plus-square"></i> Add New Company
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-left">
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Fax</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        @foreach ($company as $item)
                            <tr>
                                <th>{{ $item->id }}</th>
                                <th>
                                    @if ($item->category)
                                        {{ $item->category->name }}
                                    @else
                                        no category
                                    @endif
                                </th>
                                <th>{{ $item->company_name }}</th>
                                <th>{{ $item->company_address }}</th>
                                <th>{{ $item->company_phone }}</th>
                                <td>{{ $item->company_email }}</td>
                                <td>{{ $item->company_fax }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletecompany{{ $item->id }}"><i class="bi bi-trash"></i> Delete</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editcompany{{ $item->id }}"><i class="bi bi-pencil-square"></i> Update</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div>{{ $company->links() }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 row">
            <div class="card">
                <div class="card-header">
                    <h4>Search Company</h4>
                </div>
                <div class="card-body">
                    .........
                </div>
            </div>
        </div>
    </div>
    {{-- modal for add user --}}
        <div class="modal right fade" id="addcompany" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Add Project</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('companies.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>select CATEGORY</label>
                            <select name="categoryID" class="form-control" style="border: 2px inset lightslategray">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                           </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="company_name" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea type="text" name="company_address" id="" rows="3" class="form-control" style="resize: none"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="number" name="company_phone" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="company_email" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Fax</label>
                            <input type="number" name="company_fax" id="" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block w-100">Save Company</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    {{-- modal for edit user --}}
        @foreach ($company as $item)
        <div class="modal right fade" id="editcompany{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">Edit project</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('companies.update',$item->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="company_name" value="{{ $item->company_name }}" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea type="text" name="company_address" value="{{ $item->company_address }}" id="" rows="3" class="form-control" style="resize: none">{{ $item->company_address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="number" name="company_phone" value="{{ $item->company_phone }}" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="company_email" value="{{ $item->company_email }}" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Fax</label>
                            <input type="number" name="company_fax" value="{{ $item->company_fax }}" id="" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block w-100">Update Company</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        @endforeach

    {{-- modal for delete user --}}
        @foreach ($company as $item)
        <div class="modal right fade" id="deletecompany{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title fs-5" id="staticBackdropLabel">delete company</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('companies.destroy',$item->id) }}" method="post">
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
