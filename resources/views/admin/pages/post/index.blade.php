@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Posts</h4>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Type</th>
                                @if ($form_type=='create')
                                <th>Created At</th> @endif
                                @if ($form_type=='edit')
                                <th>Updated At</th> @endif
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->title}}</td>
                                <td>
                                    <ul class="list-unstyled">
                                        @foreach ($item->category as $cat)
                                        <li>
                                            <i class="fa fa-angle-right mr-1" aria-hidden="true"></i> {{$cat->name}}
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @php
                                    $featured= json_decode($item->featured);
                                    echo $featured->post_type;
                                    @endphp
                                </td>
                                @if ($form_type=='create')
                                <td>{{$item->created_at->diffForHumans()}}</td>
                                @endif
                                @if ($form_type=='edit')
                                <td>{{$item->updated_at->diffForHumans()}}</td>
                                @endif
                                <td>
                                    @if ($item->status)

                                    <span class="badge badge-success">Published</span>
                                    @if (Auth::guard('admin')->user()->role->name == 'Admin')

                                    <a class="text-danger" href="{{ route('post.status.update',$item->id) }}"><i
                                            class="fa fa-times" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @else

                                    <span class="badge badge-danger">Unpublished</span>
                                    @if (Auth::guard('admin')->user()->role->name == 'Admin')
                                    <a class="text-success" href="{{ route('post.status.update',$item->id) }}"><i
                                            class="fa fa-check" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @endif
                                </td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-warning" href="{{ route('post.edit', $item->id) }}"><i
                                            class="fa fa-edit" aria-hidden="true"></i></a>
                                    @if ($form_type=='create')
                                    <form class="d-inline delete-form" action="{{ route('post.destroy', $item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </form>
                                    {{-- <a class="btn btn-sm btn-danger"
                                        href="{{ route('skill.destroy',$item->id) }}"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a> --}}
                                    @endif
                                </td>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @if ($form_type == 'create')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add new post</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group order">
                        <label>Title</label>
                        <input name="title" type="text" value="{{old('title')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Post Type</label>
                        <select class="form-control" name="post_type" id="post-type-selector">
                            <option selected value="standard">Standard</option>
                            <option value="gallery">Gallery</option>
                            <option value="video">Video</option>
                            <option value="audio">Audio</option>
                            <option value="quote">Quote</option>
                        </select>
                    </div>
                    <div class="form-group order post-standard">
                        <label>Featured Photo</label>
                        <br>
                        <img style="max-width: 100%;" id="slider-photo-preview" src="" alt="">
                        <br>
                        <input class="d-none" id="slider-photo" name="standard" type="file" class="form-control">
                        <label for="slider-photo"><img style="cursor: pointer" class="w-50"
                                src="{{ url('admin\assets\img\upload.png') }}" alt=""></label>
                    </div>


                    <div class="form-group order post-gallery">
                        <label>Gallary Photo</label>
                        <br>
                        <div class="port-gall">

                        </div>
                        <br>
                        <input class="d-none" id="portfolio-gallery" name="gallery[]" multiple type="file"
                            class="form-control">
                        <label for="portfolio-gallery"><img style="cursor: pointer;width: 20%"
                                src="{{ url('admin\assets\img\gallary_image.png') }}" alt=""></label>
                    </div>

                    <div class="form-group order post-video">
                        <label>Video Post</label>
                        <input name="video" type="text" value="{{old('video')}}" class="form-control" autofocus>
                    </div>

                    <div class="form-group order post-audio">
                        <label>Audio Post</label>
                        <input name="audio" type="text" value="{{old('audio')}}" class="form-control" autofocus>
                    </div>

                    <div class="form-group order post-quote">
                        <label>Quote</label><br>
                        <textarea name="quote" id="" cols="37" rows="3"></textarea>
                    </div>

                    <div class="form-group order">
                        <label>Post Content</label>
                        <textarea name="content" id="portfolio-desc"></textarea>
                    </div>
                    <div class="form-group order">
                        <label>Select Categories</label>
                        <ul class="list-unstyled">
                            @foreach ($categories as $item)
                            <li>
                                <label><input class="mr-2" name="cat[]" value="{{$item->id}}"
                                        type="checkbox">{{$item->name}}</label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group order">
                        <label>Tags</label>
                        <select class="js-example-basic-multiple form-control" name="tags[]" multiple="multiple">
                            @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        @if ($form_type == 'edit')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Post</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('post.update',$edit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group order">
                        <label>Title</label>
                        <input name="title" type="text" value="{{$edit->title}}" class="form-control" autofocus>
                    </div>
                    @php
                    $featured= json_decode($edit->featured);
                    @endphp
                    <div class="form-group order">
                        <label>Post Type</label>
                        <select class="form-control" name="post_type" id="post-type-selector">
                            <option @if ($featured->post_type=='standard') selected @endif value="standard">Standard
                            </option>
                            <option @if ($featured->post_type=='gallery') selected @endif value="gallery">Gallery
                            </option>
                            <option @if ($featured->post_type=='video') selected @endif value="video">Video</option>
                            <option @if ($featured->post_type=='audio') selected @endif value="audio">Audio</option>
                            <option @if ($featured->post_type=='quote') selected @endif value="quote">Quote</option>
                        </select>
                    </div>
                    
                    <div class="form-group order post-standard">
                        <label>Featured Photo</label>
                        <br>
                        <img style="max-width: 100%;" id="slider-photo-preview" src="{{ url('storage/posts/'.$featured->standard)}}" alt="">
                        <br>
                        <input class="d-none" id="slider-photo" name="standard" type="file" class="form-control">
                        <label for="slider-photo"><img style="cursor: pointer" class="w-50"
                                src="{{ url('admin\assets\img\upload.png') }}" alt=""></label>
                    </div>
                    


                    
                    <div class="form-group order post-gallery">
                        <label>Gallary Photo</label>
                        <br>
\
                            <div class="port-gall">
                                @foreach (json_decode($featured->gallery) as $item)
                                <img style="max-width: 100%;" id="slider-photo-preview"
                                src="{{ url('storage/posts/'.$item) }}" alt="">
                                @endforeach
                            </div>
\
                        <br>
                        <input class="d-none" id="portfolio-gallery" name="gallery[]" multiple type="file"
                            class="form-control">
                        <label for="portfolio-gallery"><img style="cursor: pointer;width: 20%"
                                src="{{ url('admin\assets\img\gallary_image.png') }}" alt=""></label>
                    </div>
                    
                    
                    <div class="form-group order post-video">
                        <label>Video Post</label>
                        <input name="video" type="text" value="{{$featured->video}}" class="form-control" autofocus>
                    </div>
                    
                    <div class="form-group order post-audio">
                        <label>Audio Post</label>
                        <input name="audio" type="text" value="{{$featured->audio}}" class="form-control" autofocus>
                    </div>
                    
                    <div class="form-group order post-quote">
                        <label>Quote</label><br>
                        <textarea name="quote" id="" cols="37" rows="3">{{$featured->quote}}</textarea>
                    </div>
                 
                    <div class="form-group order">
                        <label>Post Content</label>
                        <textarea name="content" id="portfolio-desc">{{$edit->content}}</textarea>
                    </div>
                    {{-- <div class="form-group order">
                        <label>Select Categories</label>
                        <ul class="list-unstyled">
                            @foreach ($categories as $item)
                            <li>
                                <label><input class="mr-2" name="cat[]" value="{{$item->id}}"
                                        type="checkbox">{{$item->name}}</label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group order">
                        <label>Tags</label>
                        <select class="js-example-basic-multiple form-control" name="tags[]" multiple="multiple">
                            @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div> --}}


                    <div class="text-right">
                        <a class="btn btn-info" href="{{ route('post.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>


@endsection