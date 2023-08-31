<?php

namespace App\Http\Controllers\admin;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $categoryID;

    public function index()
    {
        $company = Company::paginate(8);
        $categories = Category::all();
        return view('admin.company.index',compact('company','categories'));
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
        $company = new Company();
        $company->categoryID = $request->categoryID;
        $company->company_name = $request->company_name;
        $company->company_address = $request->company_address;
        $company->company_phone = $request->company_phone;
        $company->company_email = $request->company_email;
        $company->company_fax = $request->company_fax;
        $company->save();
    if($company)
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
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $users = Company::find($id);
        $users->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        session()->flash('delete','delete company was successfully');
        Company::destroy($id);
        return back();
    }
}
