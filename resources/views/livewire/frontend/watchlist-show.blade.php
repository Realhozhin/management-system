<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Projects</h4>
                                </div>
                                <div class="col-md-3">
                                    <h4>Task</h4>
                                </div>
                                <div class="col-md-3">
                                    <h4>status</h4>
                                </div>
                                <div class="col-md-3">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($watchlist as $item)
                            @if ($item->project)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-3 my-auto">
                                            <a href="{{ url('categories/'.$item->project->category->name.'/'.$item->project->project_name) }}">
                                                <label class="product-name">
                                                    {{ $item->project->project_name }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-3 my-auto">
                                            @forelse ($item->project->projectTask as $Taskitem)
                                                <h5 class="colorselection"  style="background-color: rgb(154, 204, 237); width: 110px;text-align: center">
                                                    {{ $Taskitem->task->name }}
                                                </h5>
                                            @empty
                                                ====
                                            @endforelse
                                        </div>
                                        <div class="col-md-3 my-auto">
                                            @if($item->project->status == 'available')
                                                <label class="status text text-info">{{ $item->project->status }}</label>
                                            @elseif ($item->project->status == 'taken')
                                                <label class="status text text-warning">{{ $item->project->status }}</label>
                                            @endif
                                        </div>
                                        <div class="col-md-3 col-5 my-auto">
                                            <div class="remove">
                                                <button type="button" wire:click="removeWatchlist({{ $item->id }})" class="btn btn-danger btn-sm">
                                                    <span wire:loading.remove>
                                                        <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading wire:target="removeWatchlist({{ $item->id }})">
                                                        <i class="fa fa-trash"></i> Removing
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <h4>no wishlist added</h4>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
