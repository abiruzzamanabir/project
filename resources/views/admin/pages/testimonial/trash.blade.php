@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Trash Testimonial</h4>
                <a class="btn btn-sm btn-success" href="{{ route('testimonial.index') }}">Active testimonial <i
                        class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>company</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($testimonial as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->company}}</td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('testimonial.trash.update', $item->id) }}">Restore user</a>
                                    @if ($form_type=='trash')
                                    <form class="d-inline delete-form"
                                        action="{{ route('testimonial.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete forever</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-danger text-center" colspan="3">No Data Found</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection