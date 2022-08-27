@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Expertise</h4>
                <a class="btn btn-sm btn-danger" href="{{ route('slider.trash') }}">Trash Sliders <i
                        class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                @if ($form_type=='create')
                                <th>Created At</th> @endif
                                @if ($form_type=='edit')
                                <th>Updated At</th> @endif
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expertise as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->title}}</td>
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

                                    <a class="text-danger" href="{{ route('slider.status.update',$item->id) }}"><i
                                            class="fa fa-times" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @else

                                    <span class="badge badge-danger">Unpublished</span>
                                    @if (Auth::guard('admin')->user()->role->name == 'Admin')
                                    <a class="text-success" href="{{ route('slider.status.update',$item->id) }}"><i
                                            class="fa fa-check" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @endif
                                </td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-warning" href="{{ route('slider.edit', $item->id) }}"><i
                                            class="fa fa-edit" aria-hidden="true"></i></a>
                                    @if ($form_type=='create')
                                    {{-- <form class="d-inline delete-form"
                                        action="{{ route('admin-user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </form> --}}
                                    <a class="btn btn-sm btn-danger"
                                        href="{{ route('slider.trash.update',$item->id) }}"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>
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
                <h4 class="card-title">Add new expertise</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('expertise.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group order">
                        <label>Title</label>
                        <input name="title" type="text" value="{{old('title')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Sub title</label>
                        <input name="subtitle" type="text" value="{{old('subtitle')}}" class="form-control" autofocus>
                    </div>
                    
                    <div class="form-group order expertise-btn-opt">
                        <div class="expertise-btn-opt-area">
                        </div>
                        <a id="add-new-expertise-button" class="btn btn-info" href="">Add Expertise</a>
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
                <h4 class="card-title">Edit Slider</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('slider.update',$edit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" value="{{$edit->title}}" type="text" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Sub Title <small class="text-danger">( You have no permission to change it
                                )</small></label>
                        <input name="subtitle" value="{{$edit->subtitle}}" type="text" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Photo</label>
                        <br>
                        <img style="max-width: 100%;" id="slider-photo-preview"
                            src="{{ url('storage/sliders/'.$edit->photo) }}" alt="">
                        <br>
                        <input class="d-none" id="slider-photo" name="new_photo" type="file" class="form-control">
                        <label for="slider-photo"><img style="cursor: pointer" class="w-50"
                                src="{{ url('admin\assets\img\upload.png') }}" alt=""></label>
                        <input type="hidden" value="{{$edit->photo}}" name="old_photo">
                    </div>
                    <div class="form-group order slider-btn-opt">

                        <div class="btn-opt-area">
                            @foreach (json_decode($edit->btns) as $btn)
                            <div class="btn-section">
                                <div class="d-flex justify-content-between">
                                    <span>Button {{$loop->index+1}}</span>
                                    <span style="cursor: pointer" class="badge badge-danger remove-btn">Remove <i
                                            class="fa fa-close" aria-hidden="true"></i></span>
                                </div>
                                <input name="btn_title[]" value="{{$btn->btn_title}}" class="form-control my-3"
                                    type="text" placeholder="Button Link">
                                <input name="btn_link[]" value="{{$btn->btn_link}}" class="form-control my-3"
                                    type="text" placeholder="Button Title">

                                <select class="form-control my-3" name="btn_type[]">
                                    <option @if ($btn->btn_type =='btn-light-out')
                                        selected
                                        @endif value="btn-light-out">Default</option>
                                    <option @if ($btn->btn_type =='btn-color btn-full')
                                        selected
                                        @endif value="btn-color btn-full">Red</option>
                                </select>
                            </div>
                            @endforeach
                        </div>
                        <a id="add-new-slider-button" class="btn btn-info" href="">Add slider button</a>
                    </div>

                    <div class="text-right">
                        <a class="btn btn-info" href="{{ route('slider.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection