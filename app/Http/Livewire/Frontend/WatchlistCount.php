<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Watchlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WatchlistCount extends Component
{
    public $watchlistcount;

    protected $listeners = ['watchlistAddedUpdated' => 'checkWatchlistCount'];
    public function checkWatchlistCount()
    {
        if(Auth::check()){
            return $this->watchlistcount = Watchlist::where('producer_id', auth()->user()->id)->count();
        }
        else
        {
            return $this->watchlistcount = 0;
        }
    }
    public function render()
    {
        $this->watchlistcount = $this->checkWatchlistCount();
        return view('livewire.frontend.watchlist-count',[
            'watchlistcount' => $this->watchlistcount
        ]);
    }
}
