<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy("title", "asc")->where('trash', false)->get();
        return view('admin.pages.slider.index', [
            'form_type' => 'create',
            'sliders' => $sliders,
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
            'photo' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $img = $request->file('photo');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/sliders/') . $file_name);
        }

        $buttons = [];

        for ($i = 0; $i < count($request->btn_title); $i++) {
            array_push($buttons, [
                'btn_title' => $request->btn_title[$i],
                'btn_link' => $request->btn_link[$i],
                'btn_type' => $request->btn_type[$i],
            ]);
        }


        Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'photo' => $file_name,
            'btns' => json_encode($buttons),
        ]);

        return back()->with('success', 'Slider added successfully');
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
        $sliders = Slider::orderBy("title", "asc")->get();
        $slider = Slider::findOrFail($id);
        return view('admin.pages.slider.index', [
            'form_type'  => 'edit',
            'edit'  => $slider,
            'sliders' => $sliders,
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
        $update_date = Slider::findOrFail($id);

        if ($request->hasFile('new_photo')) {
            $img = $request->file('new_photo');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/sliders/') . $file_name);
            unlink('storage/sliders/' . $request->old_photo);
        } else {
            $file_name = $request->old_photo;
        }
        $update_date->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'photo' => $file_name,
        ]);

        return back()->with('success', 'Slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id = Slider::findOrFail($id);
        $delete_id->delete();
        unlink('storage/sliders/' . $delete_id->photo);


        return back()->with('success-main', 'Slider Deleted successfully');
    }
    public function updateStatus($id)
    {
        $data = Slider::findOrFail($id);


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
        $data = Slider::findOrFail($id);


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
        $admin = Slider::orderBy("title", "asc")->where('trash', true)->get();
        return view('admin.pages.slider.trash', [
            'all_slider' => $admin,
            'form_type'  => 'trash',
        ]);
    }
}
