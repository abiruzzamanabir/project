<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts= Post::latest()->get();
        $categories=PostCategory::latest()->get();
        $tags=Tag::get();
        return view('admin.pages.post.index',[
            'form_type' =>'create',
            'posts' => $posts,
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
        $this->validate($request,[
            'title' =>'required|unique:posts',
        ]);

        if ($request->hasFile('standard')) {
            $img = $request->file('standard');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/posts/') . $file_name);
        }

        $gallery_files = [];
        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            foreach ($gallery as $gal) {
                $gall_name = md5(time() . rand()) . '.' . $gal->clientExtension();
                $inter = Image::make($gal->getRealPath());
                $inter->filesize();
                $inter->save(storage_path('app/public/posts/') . $gall_name);
                array_push($gallery_files, $gall_name);
            }
        }
        $post_type=[
            'post_type' => $request->post_type,
            'standard' => $file_name ?? null,
            'audio' => $request->audio,
            'video' => $request->video,
            'gallery' => json_encode($gallery_files),
            'quote' => $request->quote,
        ];

        

        $post=Post::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'title' =>Str::ucfirst($request->title),
            'slug' =>Str::lower(Str::slug($request->title)),
            'content' => $request->content,
            'featured' => json_encode($post_type),
        ]);

        $post->tag()->attach($request->cat);
        $post->category()->attach($request->tags);
        return back() ->with('success','Post added successfully');
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
        $edit= Post::findOrFail($id);
        $posts= Post::latest()->get();
        return view('admin.pages.post.index',[
            'form_type' =>'edit',
            'posts' => $posts,
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
        //
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
    public function updateStatus($id)
    {
        $data = Post::findOrFail($id);


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
