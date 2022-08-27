<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingTable;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricing = PricingTable::where('trash', false)->get();
        return view('admin.pages.pricing.index', [
            'all_pricing' => $pricing,
            'form_type'  => 'create',
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
            'price' => 'required',
            'memory' => 'required',
            'memory_type' => 'required',
            'processor' => 'required',
            'disk' => 'required',
            'transfer' => 'required',
            'link' => 'required',
        ]);

        $pricing = PricingTable::create([
            'name' => $request->name,
            'price' => $request->price,
            'memory' => $request->memory,
            'memory_type' => $request->memory_type,
            'processor' => $request->processor,
            'disk' => $request->disk,
            'transfer' => $request->transfer,
            'link' => $request->link,
        ]);

        return back()->with('success', 'Pricing created successfully');
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
        $pricing = PricingTable::where('trash', false)->get();
        $item = PricingTable::findOrFail($id);
        return view('admin.pages.pricing.index', [
            'all_pricing' => $pricing,
            'form_type'  => 'edit',
            'edit'  => $item,
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
        $update_date = PricingTable::findOrFail($id);

        $update_date->update([
            'name' => $request->name,
            'price' => $request->price,
            'memory' => $request->memory,
            'memory_type' => $request->memory_type,
            'processor' => $request->processor,
            'disk' => $request->disk,
            'transfer' => $request->transfer,
            'link' => $request->link,
        ]);

        return back()->with('success', 'Pricing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id = PricingTable::findOrFail($id);
        $delete_id->delete();

        return back()->with('success-main', 'Pricing Deleted successfully');
    }
    public function updateStatus($id)

    {
        $data = PricingTable::findOrFail($id);


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
