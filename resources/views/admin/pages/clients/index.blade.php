@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Clients</h4>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Photo</th>
                                @if ($form_type=='create')
                                <th>Created At</th> @endif
                                @if ($form_type=='edit')
                                <th>Updated At</th> @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_client as $client)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$client->name}}</td>
                                <td>
                                    <img style="width: 50px; height: 50px;"
                                        src="{{ url('storage/clients/'. $client->photo) }}" alt="Profile Picture">
                                </td>
                                @if ($form_type=='create')
                                <td>{{$client->created_at->diffForHumans()}}</td>
                                @endif
                                @if ($form_type=='edit')
                                <td>{{$client->updated_at->diffForHumans()}}</td>
                                @endif

                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-warning" href="{{ route('client.edit', $client->id) }}"><i
                                            class="fa fa-edit" aria-hidden="true"></i></a>
                                    @if ($form_type=='create')
                                    <form class="d-inline delete-form"
                                        action="{{ route('client.destroy', $client->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </form>
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
                <h4 class="card-title">Add new client</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group order">
                        <label>Name</label>
                        <input name="name" type="text" value="{{old('name')}}" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label><br>
                        <input type="file" name="photo">
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
                <h4 class="card-title">Edit client</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('client.update',$edit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{$edit->name}}" type="text" class="form-control" autofocus>
                    </div>

                    <div class="form-group">
                        <label>Upload Image</label><br>
                        <input type="file" name="new_photo">
                        <input type="hidden" value="{{$edit->photo}}" name="old_photo">

                    </div>

                    <div class="text-right">
                        <a class="btn btn-info" href="{{ route('client.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection