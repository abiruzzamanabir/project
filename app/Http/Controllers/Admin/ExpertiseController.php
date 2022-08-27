<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expertise;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expertise = Expertise::where('trash', false)->get();
        return view('admin.pages.expertise.index', [
            'form_type' => 'create',
            'expertise' => $expertise,
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
            'expertise_name' => 'required',
            'expertise_desc' => 'required',
            'photo' => 'required',
        ]);


        $expertise = [];

        for ($i = 0; $i < count($request->expertise_name); $i++) {
            array_push($expertise, [
                'expertise_name' => $request->expertise_name[$i],
                'expertise_desc' => $request->expertise_desc[$i],
                'expertise_photo' => $request->expertise_photo[$i],
            ]);
        }


        Expertise::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'exp' => json_encode($expertise),
        ]);

        return back()->with('success', 'Expertise added successfully');
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
        //
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
