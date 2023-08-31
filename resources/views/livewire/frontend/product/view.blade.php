<div>
    <div class="py-3 py-md-5 ">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-warning text-center">
                    {{ session('message') }}
                </div>
            @endif
            @if (session()->has('message1'))
            <div class="alert alert-success text-center">
                {{ session('message1') }}
            </div>
            @endif
            @if (session()->has('message2'))
            <div class="alert alert-danger text-center">
                {{ session('message2') }}
            </div>
            @endif
            <div class="row">
                <div class="col-md-8 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $project->project_name }}
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $project->category->name }} / {{ $project->project_name }}
                        </p>
                        <div>
                            @if($project->status == 'available')
                                <label class="btn-sm py-1 mt-2 text-white bg-success">available</label>
                            @elseif ($project->status == 'taken')
                                <label class="btn-sm py-1 mt-2 text-white bg-danger">not available</label>
                            @endif
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="AddToCart({{ $project->id }})" class="btn btn1">
                                <i class="bi bi-basket-fill"></i> request for this
                            </button>
                            <button type="button" wire:click="watchlist({{ $project->id }})" class="btn btn1">
                                 <i class="bi bi-balloon-heart-fill"></i> Add To Watchlist
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Description</h5>
                            <p>
                                {{ $project->description }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="card-header">
                        <h4 style="float: left">Add Task</h4>
                        <a href="#" style="float: right" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addTask">
                            <i class="bi bi-plus-square"></i> Add New Task
                        </a>
                    </div>
                    <br/>
                    <br/>
                    <hr>
                    {{-- modal for add TASK --}}
                    <div class="modal right fade" id="addTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title fs-5" id="staticBackdropLabel">Add task</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('addTask') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="project_name" id="" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>select producer</label>
                                        <select name="producer" class="form-control" style="border: 2px inset lightslategray">
                                            @foreach($producers as $producer)
                                                <option value="{{ $producer->id }}">{{ $producer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary btn-block w-100">Save task</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mt-3">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4>Tasks</h4>
                    </div>
                    <div class="card-body">
                        <div>
                            @forelse ($project->Task as $item)
                                <label class="colorselection"  style="background-color: springgreen;" wire:click="Taskselected({{ $item->id }})">
                                    {{ $item->name }}
                                </label>

                            @empty
                                ====
                            @endforelse
                            <div>
                                @if($this->productSelectedItem == 'taken')
                                    <label class="btn-sm py-1 mt-2 text-white bg-danger">on available</label>
                                @elseif ($this->productSelectedItem == 'available')
                                    <label class="btn-sm py-1 mt-2 text-white bg-success">available</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


