<div>

    <div>
        <div class="py-3 py-md-5 bg-light">
            <div class="container">
                <h4>My Cart</h4><hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="shopping-cart">

                            <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>projects</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>Task</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>Remove</h4>
                                    </div>
                                </div>
                            </div>
                            @forelse ($cart as $item)
                                @if ($item->project)
                                    <div class="cart-item">
                                        <div class="row">
                                            <div class="col-md-4 my-auto">
                                                <a href="{{ url('categories/'.$item->project->category->name.'/'.$item->project->project_name) }}">
                                                    <label class="project-name">
                                                        <h5>{{ $item->project->project_name }}</h5>
                                                    </label>
                                                </a>
                                            </div>

                                            <div class="col-md-4 my-auto">
                                                @if ($item->Task)
                                                    <label class="task" style="background-color: rgb(59, 216, 19);border-radius: 2px;width: 100px;text-align: center">{{ $item->Task->name }}</label>
                                                @else
                                                    ///
                                                @endif
                                            </div>

                                            <div class="col-md-4 col-5 my-auto">
                                                <div class="remove">
                                                    <button type="button" wire:loading.attr="disabled" wire:click="removeCartItem({{ $item->id }})" class="btn btn-danger btn-sm">
                                                        <span wire:loading.remove wire:target="removeCartItem({{ $item->id }})">
                                                            <i class="fa fa-trash"></i> Remove
                                                        </span>
                                                        <span wire:loading wire:target="removeCartItem({{ $item->id }})">
                                                            <i class="fa fa-trash"></i> Removeing
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <h4>no project in your basket</h4>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mt-3">
                        <a href="{{ Route('categories') }}" class="btn btn-info">see more project and task</a>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="shadow-sm bg-white p-3">
                            <a href="{{ route('checkout') }}" class="btn btn-warning w-100">check out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
