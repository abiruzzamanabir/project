@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Expertise</h4>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Icon</th>
                                @if ($form_type=='create')
                                <th>Created At</th> @endif
                                @if ($form_type=='edit')
                                <th>Updated At</th> @endif
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expertises as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->title}}</td>
                                <td><i class="{{$item->icon}}"></i></td>
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

                                    <a class="text-danger" href="{{ route('expertise.status.update',$item->id) }}"><i
                                            class="fa fa-times" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @else

                                    <span class="badge badge-danger">Unpublished</span>
                                    @if (Auth::guard('admin')->user()->role->name == 'Admin')
                                    <a class="text-success" href="{{ route('expertise.status.update',$item->id) }}"><i
                                            class="fa fa-check" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @endif
                                </td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-warning" href="{{ route('expertise.edit', $item->id) }}"><i
                                            class="fa fa-edit" aria-hidden="true"></i></a>
                                    @if ($form_type=='create')
                                    <form class="d-inline delete-form"
                                        action="{{ route('expertise.destroy', $item->id) }}" method="POST">
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
                    
                    <div class="form-group order">
                        <label>Icon</label> <br>
                        <button class="btn btn-sm btn-info mb-3 show-icon">Select icon</button>
                        <input name="icon" type="text" value="{{old('icon')}}" class="form-control select-abir-icon-input" readonly autofocus>
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
                <h4 class="card-title">Edit Expertise</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('expertise.update',$edit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" value="{{$edit->title}}" type="text" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Sub Title</label>
                        <input name="subtitle" value="{{$edit->subtitle}}" type="text" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Icon</label> <br>
                        <button class="btn btn-sm btn-info mb-3 show-icon">Select icon</button>
                        <input name="icon" type="text" value="{{$edit->icon}}" class="form-control select-abir-icon-input" readonly autofocus>
                    </div>

                    <div class="text-right">
                        <a class="btn btn-info" href="{{ route('expertise.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@include('icon')
@endsection