@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Trash team member</h4>
                <a class="btn btn-sm btn-success" href="{{ route('team-member.index') }}">Active team member <i
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
                                <th>Designation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_team as $user)
                            
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->designation}}</td>
                                <td>
                                    <img class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover"
                                        src="{{ url('storage/teams/'. $user->photo)}}" alt="Profile Picture">
                                </td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('team.member.trash.update', $user->id) }}">Restore user</a>
                                    @if ($form_type=='trash')
                                    <form class="d-inline delete-form"
                                        action="{{ route('team-member.destroy', $user->id) }}" method="POST">
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