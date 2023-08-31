<div>
    {{-- <div class="row">
        <div class="col-3">
            @if (! $category->brand)
                <div class="card">
                    <div class="card-header"><h4>BRANDS</h4></div>
                    <div class="card-body">
                        @foreach ($category->brands as $item)
                        <label class="d-block">
                            <input type="checkbox" wire:model="brandInput" value="{{ $item->name }}"/>{{ $item->name }}
                        </label>
                        @endforeach
                    </div>
                </div>
            @else
                no brand to show
            @endif
            <div class="card mt-3">
                <div class="card-header"><h4>PRICE</h4></div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low"/>high to low
                    </label>
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high"/>low to high
                    </label>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-9 offset-3">
        <div class="row">
            @forelse ($project as $item)
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-card-body">
                        <p class="product-brand">{{ $item->company }}</p>
                        <div>
                            @if($item->status == 'available')
                                <label class="btn-sm py-1 mt-2 text-white bg-success">available</label>
                            @elseif ($item->status == 'taken')
                                <label class="btn-sm py-1 mt-2 text-white bg-danger">not available</label>
                            @endif
                        </div>
                        <h5 class="product-name">
                        <a href="{{ url('/categories/'.$item->category->name.'/'.$item->project_name) }}">
                                {{ $item->project_name }}
                        </a>
                        <hr>
                        <div>
                            <span class="selling-price p-1"><h5 style="color: lightseagreen">expiration  time :</h5> {{ $item->exp_time }}</span>
                        </div>
                    </div>
                </div>

            </div>
            @empty
                <h1>NO DATA TO SHOW FOR {{ $category->name }}</h1>
            @endforelse
        </div>
    </div>
</div>
