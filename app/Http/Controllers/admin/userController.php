<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(8);
        return view('admin.users.index', compact('users'));
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
        $users = new User;
            $users->name = $request->name;
            $users->email = $request->email;
            $users->phone = $request->phone;
            $users->password = md5($request->password);
            $users->role_as = $request->role_as;
            $users->save();
        if($users)
        {
            return redirect()->back()->with('success','user created successfully');
        }
        else
        {
            return redirect()->back()->with('fail','user created fail');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'role_as' => ['required'],
        // ]);
        // User::findOrfail($id)->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'password' => Hash::make($request->password),
        //     'role_as' => $request->role_as,

        // ]);
        // session()->flash('update','update was successfully');
        // return redirect()->route('users.index');
        $users = User::find($id);
        $users->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        session()->flash('delete','delete User was successfully');
        User::destroy($id);
        return back();
    }
}
