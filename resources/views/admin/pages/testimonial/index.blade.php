@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All testimonial</h4>
                <a class="btn btn-sm btn-danger" href="{{ route('testimonial.trash') }}">Trash testimonial <i
                        class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Company</th>
                                @if ($form_type=='create')
                                <th>Created At</th> @endif
                                @if ($form_type=='edit')
                                <th>Updated At</th> @endif
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($testimonials as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->company}}</td>
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

                                    <a class="text-danger" href="{{ route('testimonial.status.update',$item->id) }}"><i
                                            class="fa fa-times" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @else

                                    <span class="badge badge-danger">Unpublished</span>
                                    @if (Auth::guard('admin')->user()->role->name == 'Admin')
                                    <a class="text-success" href="{{ route('testimonial.status.update',$item->id) }}"><i
                                            class="fa fa-check" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @endif
                                </td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-warning" href="{{ route('testimonial.edit', $item->id) }}"><i
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
                                        href="{{ route('testimonial.trash.update',$item->id) }}"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-danger text-center" colspan="5">No Data Found</td>
                            </tr>
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
                <h4 class="card-title">Add new testimonial</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('testimonial.store') }}" method="POST">
                    @csrf
                    <div class="form-group order">
                        <label>Name</label>
                        <input name="name" type="text" value="{{old('name')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Company</label>
                        <input name="company" type="text" value="{{old('company')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Testimonial</label>
                        <input name="testimonial" type="text" value="{{old('testimonial')}}" class="form-control" autofocus>
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
                <h4 class="card-title">Edit testimonial</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('testimonial.update',$edit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{$edit->name}}" type="text" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        <input name="company" value="{{$edit->company}}" type="text" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Testimonial</label>
                        <input name="testimonial" value="{{$edit->testimonial}}" type="text" class="form-control" autofocus>
                    </div>
                   
                    <div class="text-right">
                        <a class="btn btn-info" href="{{ route('testimonial.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection