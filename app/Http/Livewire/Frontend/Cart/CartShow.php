<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart;

    public function removeCartItem(int $id)
    {
        $cartRemove = Cart::where('producer_id',auth()->user()->id)->where('id',$id)->first();
        if($cartRemove)
        {
            $cartRemove->delete();
            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message',[
                'text' => 'cart item removed',
                'type' => 'success',
                'status' => 200
            ]);
        }
        else
        {
            $this->dispatchBrowserEvent('message',[
                'text' => 'cart item doesnt removed',
                'type' => 'error',
                'status' => 401
            ]);
        }
    }
    public function render()
    {
        $this->cart = Cart::where('producer_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show',[
            'cart' => $this->cart
        ]);
    }
}
