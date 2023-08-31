<?php

namespace App\Http\Controllers\admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\projectProducers;
use App\Models\projectTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::paginate(8);
        $categories = Category::all();
        $companies = Company::all();
        $producers = User::all();
        return view('admin.projects.index',compact('project','categories','companies','producers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project = new Project;
        $project->category_id = $request->category_id;
        $project->user_id = auth()->user()->id;
        $project->project_name = $request->project_name;
        $project->description = $request->description;
        $project->company = $request->company;
        $project->exp_time = $request->exp_time;
        $project->save();
        if($request->producer)
        {
            foreach($request->producer as $producer)
            {
                $project->projectProducer()->create([
                    'project_id' => $project->id,
                    'producer_id' => $producer,
                ]);
            }
        }
            if($project)
            {
                return redirect()->back()->with('success','project created successfully');
            }
            else
            {
                return redirect()->back()->with('fail','project created fail');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $users = Project::find($id);
        $users->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        session()->flash('delete','delete project was successfully');
        Project::destroy($id);
        return back();
    }
}
