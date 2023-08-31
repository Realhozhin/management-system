<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Watchlist;
use Livewire\Component;

class WatchlistShow extends Component
{

    public function removeWatchlist(int $id)
    {
        Watchlist::where('producer_id', auth()->user()->id)->where('id', $id)->delete();
        $this->emit('watchlistAddedUpdated');
        $this->dispatchBrowserEvent('message',[
            'text' => 'watchlist item removed successfuly',
            'type' => 'success',
            'status' => 200
        ]);
    }
    public function render()
    {
        $watchlist = Watchlist::where('producer_id',auth()->user()->id)->get();
        return view('livewire.frontend.watchlist-show',[
            'watchlist' => $watchlist
        ]);
    }
}
