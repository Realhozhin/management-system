<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = TAsk::paginate(8);
        $project = Project::all();
        return view('admin.task.index',compact('task','project'));
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
        $task = new Task;
        $task->project_id = $request->project_id;
        $task->name = $request->name;
        $task->owner_id = auth()->user()->id;
        $task->save();
        if($task)
            {
                return redirect()->back()->with('success','task created successfully');
            }
            else
            {
                return redirect()->back()->with('fail','task created fail');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        session()->flash('update','update task was successfully');
        $task = Task::find($id);
        $task->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        session()->flash('delete','delete task was successfully');
        Task::destroy($id);
        return back();
    }
}
