@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Product Category</h4>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Photo</th>
                                @if ($form_type=='create')
                                <th>Created At</th> @endif
                                @if ($form_type=='edit')
                                <th>Updated At</th> @endif
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->slug}}</td>
                                <td>
                                    <img style="width: 50px; height: 50px;"
                                        src="{{ url('storage/products/'. $item->photo) }}" alt="Profile Picture">
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

                                    <a class="text-danger" href="{{ route('product.category.status.update',$item->id) }}"><i
                                            class="fa fa-times" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @else

                                    <span class="badge badge-danger">Unpublished</span>
                                    @if (Auth::guard('admin')->user()->role->name == 'Admin')
                                    <a class="text-success" href="{{ route('product.category.status.update',$item->id) }}"><i
                                            class="fa fa-check" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @endif
                                </td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-warning" href="{{ route('products-category.edit', $item->id) }}"><i
                                            class="fa fa-edit" aria-hidden="true"></i></a>
                                    @if ($form_type=='create')
                                    <form class="d-inline delete-form"
                                        action="{{ route('products-category.destroy', $item->id) }}" method="POST">
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
                <h4 class="card-title">Add new product category</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('products-category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group order">
                        <label>Name</label>
                        <input name="name" type="text" value="{{old('name')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Photo</label>
                        <br>
                        <img style="max-width: 100%;" id="slider-photo-preview" src="" alt="">
                        <br>
                        <input class="d-none" id="slider-photo" name="photo" type="file" class="form-control">
                        <label for="slider-photo"><img style="cursor: pointer" class="w-50"
                                src="{{ url('admin\assets\img\upload.png') }}" alt=""></label>
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
                <h4 class="card-title">Edit Product Category</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('products-category.update',$edit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{$edit->name}}" type="text" class="form-control" autofocus>
                    </div>

                    <div class="form-group order">
                        <label>Photo</label>
                        <br>
                        <img style="max-width: 100%;" id="slider-photo-preview" src="{{ url('storage/products/'.$edit->photo) }}" alt="">
                        <br>
                        <input class="d-none" id="slider-photo" name="new_photo" type="file" class="form-control">
                        <label for="slider-photo"><img style="cursor: pointer" class="w-50"
                                src="{{ url('admin\assets\img\upload.png') }}" alt=""></label>
                    </div>
                    

                    <div class="text-right">
                        <a class="btn btn-info" href="{{ route('products-category.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>


@endsection