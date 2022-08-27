@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All pricing</h4>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                @if ($form_type=='create')
                                <th>Created At</th> @endif
                                @if ($form_type=='edit')
                                <th>Updated At</th> @endif
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_pricing as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->name}}</td>
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

                                    <a class="text-danger"
                                        href="{{ route('pricing.table.status.update',$item->id) }}"><i
                                            class="fa fa-times" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @else

                                    <span class="badge badge-danger">unpublished</span>
                                    @if (Auth::guard('admin')->user()->role->name == 'Admin')
                                    <a class="text-success"
                                        href="{{ route('pricing.table.status.update',$item->id) }}"><i
                                            class="fa fa-check" aria-hidden="true"></i></a>
                                    @else

                                    @endif
                                    @endif
                                </td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-warning"
                                        href="{{ route('pricing-table.edit', $item->id) }}"><i class="fa fa-edit"
                                            aria-hidden="true"></i></a>
                                    @if ($form_type=='create')
                                    <form class="d-inline delete-form"
                                        action="{{ route('pricing-table.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </form>
                                    {{-- <a class="btn btn-sm btn-danger"
                                        href="{{ route('admin.trash.update',$user->id) }}"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a> --}}
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
                <h4 class="card-title">Add new Pricing</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('pricing-table.store') }}" method="POST">
                    @csrf
                    <div class="form-group order">
                        <label>Name</label>
                        <input name="name" type="text" value="{{old('name')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Price</label>
                        <input name="price" type="text" value="{{old('price')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Memory</label>
                        <input name="memory" type="text" value="{{old('memory')}}" class="form-control" autofocus>
                    </div>

                    <div class="form-group order">
                        <select class="form-control" name="memory_type" id="">
                            <option>Select</option>
                            <option value="MB">MB</option>
                            <option value="GB">GB</option>
                        </select>
                    </div>

                    <div class="form-group order">
                        <label>Processor</label>
                        <input name="processor" type="text" value="{{old('processor')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Disk</label>
                        <input name="disk" type="text" value="{{old('disk')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Transfer</label>
                        <input name="transfer" type="text" value="{{old('transfer')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Link</label>
                        <input name="link" type="text" value="{{old('link')}}" class="form-control" autofocus>
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
                <h4 class="card-title">Edit Pricing</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('pricing-table.update',$edit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{$edit->name}}" type="text" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Price</label>
                        <input name="price" type="text" value="{{$edit->price}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Memory</label>
                        <input name="memory" type="text" value="{{$edit->memory}}" class="form-control" autofocus>
                    </div>

                    <div class="form-group order">
                        <select class="form-control" name="memory_type" id="">
                            <option>Select</option>
                            <option @if($edit->memory_type=='MB') selected @endif value="MB">MB</option>
                            <option @if($edit->memory_type=='GB') selected @endif value="GB">GB</option>
                        </select>
                    </div>

                    <div class="form-group order">
                        <label>Processor</label>
                        <input name="processor" type="text" value="{{$edit->processor}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Disk</label>
                        <input name="disk" type="text" value="{{$edit->disk}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Transfer</label>
                        <input name="transfer" type="text" value="{{$edit->transfer}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group order">
                        <label>Link</label>
                        <input name="link" type="text" value="{{$edit->link}}" class="form-control" autofocus>
                    </div>
                    <div class="text-right">
                        <a class="btn btn-info" href="{{ route('pricing-table.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection