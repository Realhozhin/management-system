<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\Report;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class frontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $carts;
    public function index()
    {
        return view('frontend.index');
    }

    public function categories(){
        $categories = Category::get();
        return view('frontend.cllection.category.index',compact('categories'));
    }
    public function projects(string $category_name){
        $category = Category::where('name',$category_name)->first();
        if($category){
            $project = $category->project()->get();
            return view('frontend.cllection.products.index',compact('project', 'category'));
        }else{
            return redirect()->back();
        }
    }
    public function projectView(string $category_name, string $project_name)
    {
        $category = Category::where('name',$category_name)->first();
        $producers = User::all();
        if($category){
            $project = $category->project()->where('project_name',$project_name)->where('status','available')->first();
            if($project)
            {
                return view('frontend.cllection.products.view',compact('category','project','producers'));
            }else
            {
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }

    }

    public function addTask()
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'traking_no' => 'MaS' . str::random(10),
            'fullname' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone,
            'status_message' => 'in progress',
        ]);
        foreach ($this->carts as $item) {
            $orderDetails = OrderDetails::create([
                'order_id' => $order->id,
                'project_id' => $item->project_id,
                'task' => $item->name,
                'status' => 'in progress',

            ]);
            // dd($item->task_id);
            if ($item->task_id != null) {
                $item->Task()->where('id', $item->task_id)->first()->update(['status' => 'taken']);
            }
        }
        return $order;
    }

    public function thankyou()
    {
        return view('frontend.thankyou');
    }

    public function Report()
    {
        return view('frontend.Report');
    }

    public function savereport(Request $request)
    {
        $report = new Report();
        $report->name = $request->name;
        $report->email = $request->email;
        $report->description = $request->description;
        $report->save();
        if($report)
        {
            return redirect()->back()->with('success','report save successfully');
        }
        else
        {
            return redirect()->back()->with('fail','report save fail');
        }
    }

    public function allreport()
    {
        $report = Report::paginate(8);
        return view('frontend.allReport',compact('report'));
    }

    public function deletereport($id)
    {
        session()->flash('delete','delete category was successfully');
        Report::destroy($id);
        return back();
    }
}
