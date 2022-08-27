<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vision;
use Illuminate\Http\Request;

class VisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visions = Vision::orderBy("title", "asc")->where('trash', false)->get();
        return view('admin.pages.vision.index', [
            'form_type' => 'create',
            'visions' => $visions,
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
            'title' => 'required',
            'subtitle' => 'required',
            'vision_name' => 'required',
            'vision_desc' => 'required',
        ]);

        

        $vision = [];

        for ($i = 0; $i < count($request->vision_name); $i++) {
            array_push($vision, [
                'vision_name' => $request->vision_name[$i],
                'vision_desc' => $request->vision_desc[$i],
            ]);
        }


        Vision::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'visions' => json_encode($vision),
        ]);

        return back()->with('success', 'Vision added successfully');
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
        $visions = Vision::orderBy("title", "asc")->get();
        $vision = Vision::findOrFail($id);
        return view('admin.pages.vision.index', [
            'form_type'  => 'edit',
            'edit'  => $vision,
            'visions' => $visions,
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
        $update_date = Vision::findOrFail($id);


        $vision = [];

        for ($i = 0; $i < count($request->vision_name); $i++) {
            array_push($vision, [
                'vision_name' => $request->vision_name[$i],
                'vision_desc' => $request->vision_desc[$i],
            ]);
        }

        $update_date->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'visions' => json_encode($vision),
        ]);

        return back()->with('success', 'Vision updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id = Vision::findOrFail($id);
        $delete_id->delete();


        return back()->with('success-main', 'Vision Deleted successfully');
    }
    public function updateStatus($id)
    {
        $data = Vision::findOrFail($id);


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
