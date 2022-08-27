<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->where('trash', false)->take(5)->get();
        return view('admin.pages.testimonial.index', [
            'form_type' => 'create',
            'testimonials' => $testimonials,
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
            'testimonial' => 'required',
            'name' => 'required',
            'company' => 'required',
        ]);

        Testimonial::create([
            'testimonial' => Str::ucfirst($request->testimonial),
            'name' => $request->name,
            'company' => $request->company,
        ]);

        return back()->with('success', 'Testimonial added successfully');
    
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
        $testimonials = Testimonial::orderBy("name", "asc")->get();
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.pages.testimonial.index', [
            'form_type'  => 'edit',
            'edit'  => $testimonial,
            'testimonials' => $testimonials,
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
        $update_date = Testimonial::findOrFail($id);

        $update_date->update([
            'testimonial' => Str::ucfirst($request->testimonial),
            'name' => $request->name,
            'company' => $request->company,
        ]);

        return back()->with('success', 'Testimonial updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id = Testimonial::findOrFail($id);
        $delete_id->delete();

        return back()->with('success-main', 'Testimonial Deleted successfully');
    }
    public function updateStatus($id)
    {
        $data = Testimonial::findOrFail($id);


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
    public function updateTrash($id)
    {
        $data = Testimonial::findOrFail($id);


        if ($data->trash) {
            $data->update([
                'status' => true,
                'trash' => false,
            ]);
        } else {
            $data->update([

                'status' => false,
                'trash' => true,
            ]);
        }
        return back()->with('success-main', 'Trash updated successfully');
    }

    public function trashUsers()
    {
        $testimonial = Testimonial::orderBy("name", "asc")->where('trash', true)->get();
        return view('admin.pages.testimonial.trash', [
            'testimonial' => $testimonial,
            'form_type'  => 'trash',
        ]);
    }
}
