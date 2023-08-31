<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('frontend.order.index',compact('orders'));
    }

    public function view($projectID)
    {
        $order = Order::where('user_id',Auth::user()->id)->where('id',$projectID)->first();
        $orderDetails = OrderDetails::where('order_id',$projectID)->first();
        if($order)
        {
            return view('frontend.order.view',compact('order','orderDetails'));
        }
        else
        {
            return redirect()->back()->with('message','No Project Found');
        }
    }

    public function cancel($id)
    {
        session()->flash('delete','delete company was successfully');
        Order::destroy($id);
        OrderDetails::destroy($id);
        // return redirect()->back();
        return redirect()->route('my_project');

    }

    public function compelete(Request $request, $id)
    {
        $users = Order::find($id);
        $users->update($request->all());
        return back()->with('message','good job project is compelete');
    }
}
