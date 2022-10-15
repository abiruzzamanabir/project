@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Portfolio</h4>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Featued</th>
                                <th>Category</th>
                                <th>Client</th>
                                <th>Date</th>
                                @if ($form_type=='create')
                                <th>Created At</th> @endif
                                @if ($form_type=='edit')
                                <th>Updated At</th> @endif
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($portfolios as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->title}}</td>
                                <td><img style="width: 60px" src="{{url('storage/portfolios/'.$item->featured
                                )}}" alt=""
                                        srcset=""></td>
                                <td>
                                    <ul class="list-unstyled">
                                        @foreach ($item->category as $cat)
                                            <li>
                                                <i class="fa fa-angle-right mr-1" aria-hidden="true"></i> {{$cat->name}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{$item->client}}</td>
                                <td>{{date('d F, Y',strtotime($item->date))}}</td>

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
                                    <a class="btn btn-sm btn-warning" href="{{ route('portfolio.edit', $item->id) }}"><i
                                            class="fa fa-edit" aria-hidden="true"></i></a>
                                    @if ($form_type=='create')
                                    <form class="d-inline delete-form"
                                        action="{{ route('portfolio.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </form>
                                    {{-- <a class="btn btn-sm btn-danger"
                                        href="{{ route('slider.trash.update',$item->id) }}"><i class="fa fa-trash"
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
                <h4 class="card-title">Add new portfolio</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group order">
                        <label>Title</label>
                        <input name="title" type="text" value="{{old('title')}}" class="form-control" autofocus>
                    </div>

                    <div class="form-group order">
                        <label>Featured Photo</label>
                        <br>
                        <img style="max-width: 100%;" id="slider-photo-preview" src="" alt="">
                        <br>
                        <input class="d-none" id="slider-photo" name="photo" type="file" class="form-control">
                        <label for="slider-photo"><img style="cursor: pointer" class="w-50"
                                src="{{ url('admin\assets\img\upload.png') }}" alt=""></label>
                    </div>


                    <div class="form-group order">
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
                        <label>Project Description</label>
                        <textarea id="portfolio-desc" name="desc"></textarea>
                    </div>
                    <div class="form-group order">
                        <label>Project Steps</label>
                        <div class="accordion" id="accordionExample">
                            <div class="card portfolio-step shadow-sm">
                                <div class="card-header" id="headingOne">
                                    <h6 class="mb-0" data-toggle="collapse" data-target="#collapseOne" style="cursor: pointer">
                                        Step 1
                                    </h6>
                                </div>

                                <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="my-3">
                                            <label>Title</label>
                                            <input type="text" name="stitle[]" id="" class="form-control" autofocus>
                                        </div>
                                        <div class="my-3">
                                            <label>Description</label>
                                            <textarea name="sdesc[]" class="form-control" autofocus></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card portfolio-step shadow-sm">
                                <div class="card-header" id="headingOne">
                                    <h6 class="mb-0" data-toggle="collapse" data-target="#collapseTwo" style="cursor: pointer">
                                        Step 2
                                    </h6>
                                </div>

                                <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="my-3">
                                            <label>Title</label>
                                            <input type="text" name="stitle[]" id="" class="form-control" autofocus>
                                        </div>
                                        <div class="my-3">
                                            <label>Description</label>
                                            <textarea name="sdesc[]" class="form-control" autofocus></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card portfolio-step shadow-sm">
                                <div class="card-header" id="headingOne">
                                    <h6 class="mb-0" data-toggle="collapse" data-target="#collapseThree" style="cursor: pointer">
                                        Step 3
                                    </h6>
                                </div>

                                <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="my-3">
                                            <label>Title</label>
                                            <input type="text" name="stitle[]" id="" class="form-control" autofocus>
                                        </div>
                                        <div class="my-3">
                                            <label>Description</label>
                                            <textarea name="sdesc[]" class="form-control" autofocus></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group order">
                        <label>Client Name</label>
                        <input name="client" type="text" value="{{old('client')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Project Link</label>
                        <input name="link" type="text" value="{{old('link')}}" class="form-control" autofocus>
                    </div>

                    <div class="form-group order">
                        <label>Date</label>
                        <input name="date" type="date" class="form-control" autofocus>
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
                <h4 class="card-title">Edit Portfolio</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('portfolio.update',$edit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" value="{{$edit->title}}" type="text" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Photo</label>
                        <br>
                        <img style="max-width: 100%;" id="slider-photo-preview"
                            src="{{ url('storage/portfolios/'.$edit->featured) }}" alt="">
                        <br>
                        <input class="d-none" id="slider-photo" name="new_photo" type="file" class="form-control">
                        <label for="slider-photo"><img style="cursor: pointer" class="w-50"
                                src="{{ url('admin\assets\img\upload.png') }}" alt=""></label>
                        <input type="hidden" value="{{$edit->featured}}" name="old_photo">
                    </div>
                    <div class="form-group order">
                        <label>Gallary Photo</label>
                        <br>
                        <div class="port-gall">
                            @foreach (json_decode($edit->gallery) as $item)
                            <img style="max-width: 100%;" id="slider-photo-preview"
                            src="{{ url('storage/portfolios/'.$item) }}" alt="">
                            @endforeach
                        </div>
                        <br>
                        <input class="d-none" id="portfolio-gallery" name="gallery[]" multiple type="file"
                            class="form-control">
                        <label for="portfolio-gallery"><img style="cursor: pointer;width: 20%"
                                src="{{ url('admin\assets\img\gallary_image.png') }}" alt=""></label>
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
                                <label><input class="mr-2" @if (in_array($item->id, $cate))
                                    checked
                                @endif name="cat[]" value="{{$item->id}}"
                                        type="checkbox">{{$item->name}}</label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group order">
                        <label>Project Description</label>
                        <textarea id="portfolio-desc" name="desc">{{ $edit->desc }}</textarea>
                    </div>
                    <div class="form-group order">
                        <label>Project Steps</label>
                        <div class="accordion" id="accordionExample">
                            @foreach (json_decode($edit->steps) as $item)
                            <div class="card portfolio-step shadow-sm">
                                <div class="card-header" id="headingOne">
                                    <h6 class="mb-0" data-toggle="collapse" data-target="#collapse{{$loop->index+1}}" style="cursor: pointer">
                                        Step {{$loop->index+1}}
                                    </h6>
                                </div>

                                <div id="collapse{{$loop->index+1}}" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="my-3">
                                            <label>Title</label>
                                            <input type="text" name="stitle[]" value="{{$item->title}}" id="" class="form-control" autofocus>
                                        </div>
                                        <div class="my-3">
                                            <label>Description</label>
                                            <textarea name="sdesc[]" class="form-control" autofocus>{{$item->sdesc}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                          

                        </div>
                    </div>
                    <div class="form-group order">
                        <label>Client Name</label>
                        <input name="client" type="text" value="{{$edit->client}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Project Link</label>
                        <input name="link" type="text" value="{{$edit->link}}" class="form-control" autofocus>
                    </div>

                    <div class="form-group order">
                        <label>Date</label>
                        <input name="date" type="date" value="{{$edit->date}}" class="form-control" autofocus>
                    </div>
                    

                    <div class="text-right">
                        <a class="btn btn-info" href="{{ route('portfolio.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection