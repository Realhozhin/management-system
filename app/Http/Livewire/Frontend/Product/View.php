<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Watchlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $project, $projectTaskId, $productSelectedItem, $producers;


    public function Taskselected($projectTaskId)
    {
        $this->projectTaskId = $projectTaskId;

        $Task = $this->project->Task()->where('id',$projectTaskId)->first();

        $this->productSelectedItem =  $Task->status;

        if($this->productSelectedItem == 'taken')
        {
            $this->productSelectedItem = 'taken';
        }
    }
    public function AddToCart(int $id)
    {
        if(Auth::check())
        {
            if($this->project->where('id',$id)->where('status','available')->exists())
            {
                if($this->project->where('id',$id)->where('status','available')->exists())
            {
                if($this->productSelectedItem != null)
                {
                    $projectTask=$this->project->Task()->where('id',$this->projectTaskId)->first();
                    if($projectTask->status == 'available')
                    {
                        // insert to cart
                        if(Cart::where('producer_id',auth()->user()->id)->where('project_id', $id)->exists())
                        {
                            $this->dispatchBrowserEvent('message',[
                                'text' => 'project is alredy added to cart',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                        else
                        {
                            Cart::create([
                                'producer_id' =>auth()->user()->id,
                                'project_id' => $id,
                                'task_id' => $this->projectTaskId
                            ]);
                            $this->emit('CartAddedUpdated');
                            $this->dispatchBrowserEvent('message',[
                                'text' => 'project is added to cart',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }
                    else
                    {
                        $this->dispatchBrowserEvent('message',[
                            'text' => 'task is not available',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                }
                else
                {
                    $this->dispatchBrowserEvent('message',[
                        'text' => 'select your project Task',
                        'type' => 'info',
                        'status' => 401
                    ]);
                }
            }
            else
            {
                $this->dispatchBrowserEvent('message',[
                    'text' => 'project is not available',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        }
        else
        {
            $this->dispatchBrowserEvent('message',[
                'text' => 'please login to continue',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }
    }
    public function watchlist($project_id)
    {
        if(Auth::check())
        {
            if(Watchlist::where('producer_id',auth()->user()->id)->where('project_id',$project_id)->exists())
            {
                $this->dispatchBrowserEvent('message',[
                    'text' => 'already added to watchlist',
                    'type' => 'info',
                    'status' => 401
                ]);
                return false;
            }
            else
            {
                Watchlist::create([
                    'producer_id' => auth()->user()->id,
                    'project_id' => $project_id
                ]);
                $this->emit('watchlistAddedUpdated');
                $this->dispatchBrowserEvent('message',[
                    'text' => 'watchlist added successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        }
        else
        {
            $this->dispatchBrowserEvent('message',[
                'text' => 'please login to continue',
                'type' => 'info',
                'status' => 401
            ]);
           return false;
        }
    }


    public function mount($category, $project, $producers)
    {
        $this->category = $category;
        $this->project = $project;
        $this->producers = $producers;
    }
    public function render()
    {

        return view('livewire.frontend.product.view',[
            'category' => $this->category,
            'project' => $this->project,
            'producers' => $this->producers
        ]);
            // return view('livewire.frontend.product.view')
            // ->with(compact('category', 'project', 'producer'));
    }
}
