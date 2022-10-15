@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Products</h4>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>photo</th>
                                @if ($form_type=='create')
                                <th>Created At</th> @endif
                                @if ($form_type=='edit')
                                <th>Updated At</th> @endif
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->name}}</td>
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
                                    <img style="width: 50px; height: 50px;"
                                    src="{{ url('storage/products/'. $item->featured) }}" alt="Profile Picture">
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

                                    <a class="text-danger" href="{{ route('product.status.update',$item->id) }}"><i
                                            class="fa fa-times" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @else

                                    <span class="badge badge-danger">Unpublished</span>
                                    @if (Auth::guard('admin')->user()->role->name == 'Admin')
                                    <a class="text-success" href="{{ route('product.status.update',$item->id) }}"><i
                                            class="fa fa-check" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @endif
                                </td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-warning" href="{{ route('products.edit', $item->id) }}"><i
                                            class="fa fa-edit" aria-hidden="true"></i></a>
                                    @if ($form_type=='create')
                                    <form class="d-inline delete-form" action="{{ route('products.destroy', $item->id) }}"
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
                <h4 class="card-title">Add new products</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group order">
                        <label>Name</label>
                        <input name="name" type="text" value="{{old('name')}}" class="form-control" autofocus>
                    </div>
                
                    <div class="form-group order post-standard">
                        <label>Featured Photo</label>
                        <br>
                        <img style="max-width: 100%;" id="slider-photo-preview" src="" alt="">
                        <br>
                        <input class="d-none" id="slider-photo" name="photo" type="file" class="form-control">
                        <label for="slider-photo"><img style="cursor: pointer" class="w-50"
                                src="{{ url('admin\assets\img\upload.png') }}" alt=""></label>
                    </div>


                    <div class="form-group order product-gallery">
                        <label>Gallary Photo</label>
                        <br>
                        <div class="product-gall">

                        </div>
                        <br>
                        <input class="d-none" id="product-gallery" name="gallery[]" multiple type="file"
                            class="form-control">
                        <label for="product-gallery"><img style="cursor: pointer;width: 20%"
                                src="{{ url('admin\assets\img\gallary_image.png') }}" alt=""></label>
                    </div>

                    
                    <div class="form-group order">
                        <label>Old Price</label>
                        <input name="old_price" type="text" value="{{old('old_price')}}" class="form-control" autofocus>
                    </div>


                    <div class="form-group order">
                        <label>Price</label>
                        <input name="price" type="text" value="{{old('price')}}" class="form-control" autofocus>
                    </div>
                

                    <div class="form-group order">
                        <label>Short Description</label>
                        <textarea name="shortdesc" id="short-desc"></textarea>
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

                    <div class="form-group order">
                        <label>Description</label>
                        <textarea name="desc" id="desc"></textarea>
                    </div>
                    
                    
                    
                    <div class="form-group order slider-btn-opt">
                        <label>Size</label>

                        <div class="btn-size-area">
                        </div>
                        <a id="add-new-size-button" class="btn btn-info" href="">Add Size</a>
                    </div>

                    <div class="form-group order slider-btn-opt">
                        <label>Color</label>

                        <div class="btn-color-area">
                        </div>
                        <a id="add-new-color-button" class="btn btn-info" href="">Add Color</a>
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
                <h4 class="card-title">Edit Products</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('products.update',$edit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group order">
                        <label>Name</label>
                        <input name="name" type="text" value="{{$edit->name}}" class="form-control" autofocus>
                    </div>
                                        
                    <div class="form-group order post-standard">
                        <label>Featured Photo</label>
                        <br>
                        <img style="max-width: 100%;" id="slider-photo-preview" src="{{ url('storage/products/'.$edit->featured)}}" alt="">
                        <br>
                        <input class="d-none" id="slider-photo" name="standard" type="file" class="form-control">
                        <label for="slider-photo"><img style="cursor: pointer" class="w-50"
                                src="{{ url('admin\assets\img\upload.png') }}" alt=""></label>
                    </div>
                    


                    
                    <div class="form-group order product-gallery">
                        <label>Gallary Photo</label>
                        <br>

                            <div class="product-gall">
                                @foreach (json_decode($edit->gallery) as $item)
                                <img style="max-width: 100%;" id="slider-photo-preview"
                                src="{{ url('storage/products/'.$item) }}" alt="">
                                @endforeach
                            </div>

                        <br>
                        <input class="d-none" id="product-gallery" name="gallery[]" multiple type="file"
                            class="form-control">
                        <label for="product-gallery"><img style="cursor: pointer;width: 20%"
                                src="{{ url('admin\assets\img\gallary_image.png') }}" alt=""></label>
                    </div>

                    <div class="form-group order">
                        <label>Price</label>
                        <input name="price" type="text" value="{{$edit->price}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Old Price</label>
                        <input name="old_price" type="text" value="{{$edit->old_price}}" class="form-control" autofocus>
                    </div>
                    
                 
                    <div class="form-group order">
                        <label>Short Description</label>
                        <textarea name="shortdesc" id="short-desc">{{$edit->shortdesc}}</textarea>
                    </div>
                    <div class="form-group order">
                        <label>Select Categories</label>
                        <ul class="list-unstyled">
                            @foreach ($edit->category as $item)
                             @php
                                 $cate[] = $item->id
                             @endphp                                             
                            @endforeach
                            @foreach ($categories as $item)
                            <li>
                                <label><input @if (in_array($item->id, $cate))
                                    checked
                                @endif class="mr-2" name="cat[]" value="{{$item->id}}"
                                        type="checkbox">{{$item->name}}</label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group order">
                        <label>Tags</label>
                        <select class="js-example-basic-multiple form-control" name="tags[]" multiple="multiple">
                            @foreach ($edit->tag as $item)
                            @php
                                $ta[] = $item->id
                            @endphp                                             
                           @endforeach
                            @foreach ($tags as $tag)
                            <option @if (in_array($tag->id, $ta))
                                selected
                            @endif value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group order">
                        <label>Description</label>
                        <textarea name="desc" id="desc">{{$edit->desc}}</textarea>
                    </div>

                    <div class="form-group order slider-btn-opt">
                        <label>Size</label>

                        <div class="btn-size-area">
                            @foreach (json_decode($edit->size) as $size)
                            <div class="btn-section">
                                <div class="d-flex justify-content-between">
                                    <span>Button {{$loop->index+1}}</span>
                                    <span style="cursor: pointer" class="badge badge-danger remove-btn">Remove <i
                                            class="fa fa-close" aria-hidden="true"></i></span>
                                </div>
                                <input name="size_name[]" value="{{$size->size_name}}" class="form-control my-3"
                                    type="text" placeholder="Button {{$loop->index+1}}">

                            </div>
                            @endforeach
                        </div>
                        <a id="add-new-size-button" class="btn btn-info" href="">Add Size</a>
                    </div>

                    <div class="form-group order slider-btn-opt">
                        <label>Color</label>

                        <div class="btn-color-area">
                            @foreach (json_decode($edit->color) as $color)
                            <div class="btn-section">
                                <div class="d-flex justify-content-between">
                                    <span>Button {{$loop->index+1}}</span>
                                    <span style="cursor: pointer" class="badge badge-danger remove-btn">Remove <i
                                            class="fa fa-close" aria-hidden="true"></i></span>
                                </div>
                                <input name="color_name[]" value="{{$color->color_name}}" class="form-control my-3"
                                    type="text" placeholder="Button {{$loop->index+1}}">

                            </div>
                            @endforeach
                        </div>
                        <a id="add-new-color-button" class="btn btn-info" href="">Add Color</a>
                    </div>


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