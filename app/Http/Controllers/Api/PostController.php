<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
        $posts = Post::all();
        if (count($posts) > 0) {
            return response()->json($posts, 200);
        } else {
            return response()->json([
                'message' => "Post Not Found!"
            ], 404);
        }
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

        $validate = Validator::make($request->all(), [
            'title' =>'required|unique:posts',
            'content' => 'required',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 422);
        }

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
            'video' => $this->embed($request->video),
            'gallery' => json_encode($gallery_files),
            'quote' => $request->quote,
        ];

        

        $post=Post::create([
            'admin_id' => 1,
            'title' =>Str::ucfirst($request->title),
            'slug' =>Str::lower(Str::slug($request->title)),
            'content' => $request->content,
            'featured' => json_encode($post_type),
        ]);

        $post->category()->attach($request->cat);
        $post->tag()->attach($request->tags);

        return response()->json([
            'message' => "Post Created Successfully!"
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if ($post) {
            return response()->json($post, 200);
        } else {
            return response()->json([
                'message' => "Post Not Found!"
            ], 404);
        }
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
        $post = Post::find($id);
        $featured= json_decode($post->featured);


        if ($request->hasFile('standard')) {
            $img = $request->file('standard');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/posts/') . $file_name);
        }else{
            $file_name=$featured->standard;
        }

        $gallery_files = json_decode($featured->gallery);
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
            'video' => $this->embed($request->video),
            'gallery' => json_encode($gallery_files)??null,
            'quote' => $request->quote,
        ];
        
        $post->update([
            'admin_id' => 1,
            'title' =>Str::ucfirst($request->title),
            'slug' =>Str::lower(Str::slug($request->title)),
            'content' => $request->content,
            'featured' => json_encode($post_type),
        ]);

        $post->category()->sync($request->cat);
        $post->tag()->sync($request->tags);


        return response()->json([
            'message' => "Post Updated Successfully!"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->delete();
            return response()->json([
                'message' => "Post Deleted Successfully"
            ],200);
        } else {
            return response()->json([
                'message' => "Post Not Found!"
            ],404);
        }
    }
}
