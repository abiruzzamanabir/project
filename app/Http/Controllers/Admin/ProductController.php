<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        $categories = ProductCategory::latest()->get();
        $tags = ProductTag::get();
        return view('admin.pages.product.index', [
            'form_type' => 'create',
            'products' => $products,
            'categories' => $categories,
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
        $this->validate($request, [
            'name' => 'required',
            'photo' => 'required',
            'gallery' => 'required',
            'price' => 'required',
            'shortdesc' => 'required',
            'desc' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $img = $request->file('photo');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/products/') . $file_name);
        }
        $gallery_files = [];
        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            foreach ($gallery as $gal) {
                $gall_name = md5(time() . rand()) . '.' . $gal->clientExtension();
                $inter = Image::make($gal->getRealPath());
                $inter->filesize();
                $inter->save(storage_path('app/public/products/') . $gall_name);
                array_push($gallery_files, $gall_name);
            }
        }

        $size = [];

        if (isset($request->size_name)) {

            for ($i = 0; $i < count($request->size_name); $i++) {
                array_push($size, [
                    'size_name' => $request->size_name[$i],
                ]);
            }
        }
        $color = [];

        if (isset($request->color_name)) {

            for ($i = 0; $i < count($request->color_name); $i++) {
                array_push($color, [
                    'color_name' => $request->color_name[$i],
                ]);
            }
        }



        $product = Product::create([
            'name' => Str::ucfirst($request->name),
            'slug' => Str::lower(Str::slug($request->name)),
            'featured' => $file_name,
            'gallery' => json_encode($gallery_files),
            'size' => json_encode($size),
            'color' => json_encode($color),
            'price' => $request->price,
            'old_price' => $request->old_price,
            'shortdesc' => $request->shortdesc,
            'desc' => $request->desc,
        ]);

        $product->category()->attach($request->cat);
        $product->tag()->attach($request->tags);
        return back()->with('success', 'Product added successfully');
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
        $edit = Product::findOrFail($id);
        $products = Product::latest()->get();
        $categories = ProductCategory::latest()->where('status', true)->get();
        $tags = ProductTag::latest()->where('status', true)->get();

        return view('admin.pages.product.index', [
            'form_type' => 'edit',
            'products' => $products,
            'edit' => $edit,
            'categories' => $categories,
            'tags' => $tags,
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
        $update_date = Product::findOrFail($id);

        if ($request->hasFile('standard')) {
            $img = $request->file('standard');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/products/') . $file_name);
        } else {
            $file_name = $update_date->featured;
        }

        $gallery_files = json_decode($update_date->gallery);
        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            foreach ($gallery as $gal) {
                $gall_name = md5(time() . rand()) . '.' . $gal->clientExtension();
                $inter = Image::make($gal->getRealPath());
                $inter->filesize();
                $inter->save(storage_path('app/public/products/') . $gall_name);
                array_push($gallery_files, $gall_name);
            }
        }

        $size = [];

        if (isset($request->size_name)) {

            for ($i = 0; $i < count($request->size_name); $i++) {
                array_push($size, [
                    'size_name' => $request->size_name[$i],
                ]);
            }
        }
        $color = [];

        if (isset($request->color_name)) {

            for ($i = 0; $i < count($request->color_name); $i++) {
                array_push($color, [
                    'color_name' => $request->color_name[$i],
                ]);
            }
        }


        $update_date->update([
            'name' => Str::ucfirst($request->name),
            'slug' => Str::lower(Str::slug($request->name)),
            'featured' => $file_name,
            'gallery' => json_encode($gallery_files),
            'size' => json_encode($size),
            'color' => json_encode($color),
            'price' => $request->price,
            'old_price' => $request->old_price,
            'shortdesc' => $request->shortdesc,
            'desc' => $request->desc,
        ]);

        $update_date->category()->sync($request->cat);
        $update_date->tag()->sync($request->tags);

        return back()->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data= Product::findOrFail($id);

        
            unlink('storage/products/' . $delete_data->featured);


            foreach (json_decode($delete_data->gallery) as $gal) {
                unlink('storage/products/' . $gal);
            }

        
        $delete_data->delete();

        return back() ->with('success-main','Products deleted successfully');
    }

    public function updateStatus($id)
    {
        $data = Product::findOrFail($id);


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
