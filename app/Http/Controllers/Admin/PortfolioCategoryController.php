<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::latest()->get();
        return view('admin.pages.category.index',[
            'form_type' =>'create',
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required|unique:categories',
        ]);


        Category::create([
            'name' =>Str::ucfirst($request->name),
            'slug' =>Str::lower(Str::slug($request->name)),
        ]);


        return back() ->with('success','Portfolio Category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit= Category::findOrFail($id);
        $categories= Category::orderBy("name", "asc")->get();
        return view('admin.pages.category.index',[
            'form_type' =>'edit',
            'categories' => $categories,
            'edit' => $edit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_date = Category::findOrFail($id);

        $update_date->update([
            'name' =>Str::ucfirst($request->name),
            'slug' =>Str::lower(Str::slug($request->name)),
        ]);

        return back() ->with('success','Portfolio Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data= Category::findOrFail($id);
        
        $delete_data->delete();

        return back() ->with('success-main','Portfolio Category deleted successfully');
    }
    public function updateStatus($id)
    {
        $data = Category::findOrFail($id);


        if ($data->status) {
            $data->update([
                'status' => false,
            ]);
        } else {
            $data->update([
                'status' => true,
            ]);
        }
        return back()->with('success-main', 'Status updated successfully');
    }
}
