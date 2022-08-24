@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Trash Sliders</h4>
                <a class="btn btn-sm btn-success" href="{{ route('slider.index') }}">Active Sliders <i
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
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_slider as $slider)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$slider->title}}</td>
                                <td>
                                    @if ($slider->photo == 'avatar.png')
                                    <img class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover"
                                        src="{{ url('storage/sliders/avatar.png') }}" alt="Profile Picture">
                                    @else
                                    <img class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover"
                                        src="{{ url('storage/sliders/'. $slider->photo)}}" alt="Profile Picture">

                                    @endif
                                </td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('slider.trash.update', $slider->id) }}">Restore slider</a>
                                    @if ($form_type=='trash')
                                    <form class="d-inline delete-form"
                                        action="{{ route('slider.destroy', $slider->id) }}" method="POST">
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