<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        $categories = Category::latest()->where('status',true)->get();
        return view('admin.pages.portfolio.index', [
            'form_type' => 'create',
            'portfolios' => $portfolios,
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
        $this->validate($request, [
            'title' =>  'required',
            'desc'  =>  'required',
            'photo' =>  'required',
        ]);

        if ($request->hasFile('photo')) {
            $img = $request->file('photo');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/portfolios/') . $file_name);
        }

        $gallery_files = [];
        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            foreach ($gallery as $gal) {
                $gall_name = md5(time() . rand()) . '.' . $gal->clientExtension();
                $inter = Image::make($gal->getRealPath());
                $inter->filesize();
                $inter->save(storage_path('app/public/portfolios/') . $gall_name);
                array_push($gallery_files, $gall_name);
            }
        }

        $steps = [];
        if (count($request->stitle) > 0) {
            for ($i = 0; $i < count($request->stitle); $i++) {
                array_push($steps, [
                    'title' => $request->stitle[$i],
                    'sdesc' => $request->sdesc[$i],
                ]);
            }
        }

        $portfolio= Portfolio::create([
            'title' => Str::ucfirst($request->title),
            'slug' => Str::lower(Str::slug($request->title)),
            'featured' => $file_name,
            'gallery' => json_encode($gallery_files),
            'desc' => $request->desc,
            'client' => Str::ucfirst($request->client),
            'link' => $request->link,
            'steps' => json_encode($steps),
            'date' => $request->date,
        ]);

        $portfolio->category()->attach($request->cat);

        return back()->with('success', 'Portfolio added successfully');
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
        $edit= Portfolio::findOrFail($id);
        $portfolios= Portfolio::orderBy("title", "asc")->get();
        $categories = Category::latest()->where('status',true)->get();
        return view('admin.pages.portfolio.index',[
            'form_type' =>'edit',
            'portfolios' => $portfolios,
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
        $update_date = Portfolio::findOrFail($id);

        if ($request->hasFile('new_photo')) {
            $img = $request->file('new_photo');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/portfolios/') . $file_name);
        }else{
            $file_name=$update_date->featured;
        }

        $gallery_files = json_decode($update_date->gallery);
        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            foreach ($gallery as $gal) {
                $gall_name = md5(time() . rand()) . '.' . $gal->clientExtension();
                $inter = Image::make($gal->getRealPath());
                $inter->filesize();
                $inter->save(storage_path('app/public/portfolios/') . $gall_name);
                array_push($gallery_files, $gall_name);
            }
            $gallery_files=json_encode($gallery_files);
        }else{
            $gallery_files=json_encode($gallery_files);
        }

        $steps = [];
        if (count($request->stitle) > 0) {
            for ($i = 0; $i < count($request->stitle); $i++) {
                array_push($steps, [
                    'title' => $request->stitle[$i],
                    'sdesc' => $request->sdesc[$i],
                ]);
            }
        }
        
        $update_date->update([
            'title' => Str::ucfirst($request->title),
            'slug' => Str::lower(Str::slug($request->title)),
            'featured' => $file_name,
            'gallery' => $gallery_files,
            'desc' => $request->desc,
            'client' => Str::ucfirst($request->client),
            'link' => $request->link,
            'steps' => json_encode($steps),
            'date' => $request->date,
        ]);

        $update_date->category()->sync($request->cat);

        return back()->with('success', 'Portfolio updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data= Portfolio::findOrFail($id);
        unlink('storage/portfolios/' . $delete_data->featured);
        foreach (json_decode($delete_data->gallery) as $gal) {
            unlink('storage/portfolios/' . $gal);
        }
        
        $delete_data->delete();

        return back() ->with('success-main','Portfolio deleted successfully');
    }
}
