@extends('_layouts.template')

@section('subtitle','Users')

@section('content')  
    <div class="row">
        <div class="col-6 mt-5">
            <h1>@yield('subtitle')</h1>
        </div>
        <div class="col-6 mt-5">
            <a class="btn btn-primary float-right" href="{{ route('user.create') }}" >Create</a>
        </div>       
    </div>
    @if(    session('success')  )
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            {{ session('success') }}
        </div>
    @endif
    @if(    session('fail')  )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            {{ session('fail') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12 table-responsive-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Code') }}</th>
                        <th class="w-50 "scope="col">Name</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th class="w-25" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td >{{ $user->id }}</td>
                            <td >{{ $user->name }}</td>
                            <td >{{ $user->email }}</td>
                            <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($user->updated_at)) }}</td>
                            <td>
                                <div class="float-right">
                                    <a class="btn btn-sm btn-secondary" href="{{ route('user.show',['user'=>$user->id]) }}"  title="View Details this User">View</a>
                                    <a class="btn btn-sm btn-default" href="{{ route('logger.index',['user'=>$user->id]) }}"  title="View Log´ s this User">Logs</a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('user.edit',['user'=>$user->id]) }}"  title="Edit this User">Edit</a>
                                    <form style="display: inline-block" action="{{ route('user.destroy',['user'=>$user->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="user" value="{{$user->id }}">
                                        <input class="btn btn-sm btn-danger" type="submit" value="X" title="Remove this User">
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
@endsection