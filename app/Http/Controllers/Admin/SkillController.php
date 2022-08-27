<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::where('trash', false)->get();
        return view('admin.pages.skills.index', [
            'form_type' => 'create',
            'skills' => $skills,
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
            'percentage' => 'required',
        ]);

        Skill::create([
            'name' => $request->name,
            'percentage' => $request->percentage,
        ]);

        return back()->with('success', 'Skill added successfully');
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
        $skills = Skill::get();
        $skill = Skill::findOrFail($id);
        return view('admin.pages.skills.index', [
            'form_type'  => 'edit',
            'edit'  => $skill,
            'skills' => $skills,
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
        $update_date = Skill::findOrFail($id);

        $update_date->update([
            'name' => $request->name,
            'percentage' => $request->percentage,
        ]);

        return back()->with('success', 'Skill updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id = Skill::findOrFail($id);
        $delete_id->delete();


        return back()->with('success-main', 'Skill Deleted successfully');
    }
    public function updateStatus($id)
    {
        $data = Skill::findOrFail($id);


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
