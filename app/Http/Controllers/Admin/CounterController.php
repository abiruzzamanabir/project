<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counts = Counter::where('trash', false)->get();
        return view('admin.pages.count.index', [
            'form_type' => 'create',
            'counts' => $counts,
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
        $this->validate($request, [
            'name' => 'required',
            'count' => 'required',
            'icon' => 'required',
        ]);

        Counter::create([
            'name' => $request->name,
            'count' => $request->count,
            'icon' => $request->icon,
        ]);

        return back()->with('success', 'Counter added successfully');
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
        $counts = Counter::get();
        $count = Counter::findOrFail($id);
        return view('admin.pages.count.index', [
            'form_type'  => 'edit',
            'edit'  => $count,
            'counts' => $counts,
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
        $update_date = Counter::findOrFail($id);

        $update_date->update([
            'name' => $request->name,
            'count' => $request->count,
            'icon' => $request->icon,
        ]);

        return back()->with('success', 'Counter updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id = Counter::findOrFail($id);
        $delete_id->delete();


        return back()->with('success-main', 'Counter Deleted successfully');
    }
    public function updateStatus($id)
    {
        $data = Counter::findOrFail($id);


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
