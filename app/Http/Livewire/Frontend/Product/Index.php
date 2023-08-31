<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Project;
use App\Models\projectProducers;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $projects, $category, $projecProducer;
    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $user = User::find(auth()->user()->id);

        $project = $user->project()->where('category_id' , $this->category->id)->get();

        if($project)
        {
            return view('livewire.frontend.product.index',[
                'projects' => $this->projects,
                'project' => $project,
                'category' => $this->category
            ]);
        }
        else
        {
            $this->dispatchBrowserEvent('message',[
                'text' => 'No Project available for you',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }
}
