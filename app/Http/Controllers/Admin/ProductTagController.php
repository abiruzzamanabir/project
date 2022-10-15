<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductTag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags= ProductTag::latest()->get();
        return view('admin.pages.product.tag.index',[
            'form_type' =>'create',
            'tags' => $tags,
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
            'name' =>'required|unique:product_tags',
            'photo' =>'required',
        ]);

        if ($request->hasFile('photo')) {
            $img = $request->file('photo');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter=Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/products/').$file_name);
            
        } 


        ProductTag::create([
            'name' =>Str::ucfirst($request->name),
            'slug' =>Str::lower(Str::slug($request->name)),
            'photo' => $file_name,
        ]);


        return back() ->with('success','Product tag added successfully');
    
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
        $edit= ProductTag::findOrFail($id);
        $tags= ProductTag::orderBy("name", "asc")->get();
        return view('admin.pages.product.tag.index',[
            'form_type' =>'edit',
            'tags' => $tags,
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
        $update_date = ProductTag::findOrFail($id);

        if ($request->hasFile('new_photo')) {
            $img = $request->file('new_photo');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $img->move(public_path('storage/products/'), $file_name);
            unlink('storage/products/' . $update_date->photo);
        } else {
            $file_name = $update_date->photo;
        }

        $update_date->update([
            'name' =>Str::ucfirst($request->name),
            'slug' =>Str::lower(Str::slug($request->name)),
            'photo' => $file_name,
        ]);

        return back() ->with('success','Product tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data= ProductTag::findOrFail($id);
        
        $delete_data->delete();
        unlink('storage/products/' . $delete_data->photo);

        return back() ->with('success-main','Product Tag deleted successfully');
    }
    public function updateStatus($id)
    {
        $data = ProductTag::findOrFail($id);


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
