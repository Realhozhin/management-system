<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderDetails;
use Livewire\Component;

class CheckoutShow extends Component
{

    public $carts, $projectAmount = 0;

    public $fullname, $email, $phone;

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'traking_no' => 'MaS' . str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'status_message' => 'in progress',
        ]);
        foreach ($this->carts as $item) {
            $orderDetails = OrderDetails::create([
                'order_id' => $order->id,
                'project_id' => $item->project_id,
                'task' => $item->task_id,
                'exp_time' => $item->project->exp_time,
                'status' => 'in progress',

            ]);
            // dd($item->task_id);
            if ($item->task_id != null) {
                $item->Task()->where('id', $item->task_id)->first()->update(['status' => 'taken']);
            }
        }
        return $order;
    }

    public function codOrder()
    {
        $codOrder = $this->placeOrder();
        if($codOrder)
        {
            Cart::where('producer_id', auth()->user()->id)->delete();
            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message',[
                'text' => 'Project placed successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->route('thankyou');

        }
        else
        {
            $this->dispatchBrowserEvent('message',[
                'text' => 'something went wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }
    public function projectAmount()
    {
        $this->projectAmount = 0;

        $this->carts = Cart::where('producer_id', auth()->user()->id)->get();
        foreach($this->carts as $item)
        {
            $this->projectAmount += $item->project->price * $item->quantity;
        }

        return $this->projectAmount;
    }
    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->projectAmount = $this->projectAmount();
        return view('livewire.frontend.checkout.checkout-show',[
            'projectAmount' => $this->projectAmount
        ]);
    }
}
