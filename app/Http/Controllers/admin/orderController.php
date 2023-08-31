<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function index()
    {
        $order = Order::all();
        return view('admin.order.index',compact('order'));
    }
    public function view($projectID)
    {
        $order = Order::where('id',$projectID)->first();
        $orderDetails = OrderDetails::where('order_id',$projectID)->first();
        if($order)
        {
            return view('admin.order.view',compact('order','orderDetails'));
        }
        else
        {
            return redirect()->back()->with('message','No Project Found');
        }
    }
}
