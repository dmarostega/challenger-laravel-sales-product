
@extends('_layouts.template')

@section('subtitle','Viewing User')

@section('content')
    <div class="row">
        <div class="col-6 mt-5 mb-3">
            <h3>@yield('subtitle')</h3>
        </div>        
    </div>
    <div class="row justify-content-center">
        <div class="col-6 justify-content-center">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">User</h5>
                    <p class="card-text"><strong>Name </strong>{{ $user->name }}</p>
                    <p class="card-text"><strong>Email </strong>{{ $user->email }}</p>                  
                </div>               
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <small>Created {{ date('d/m/Y', strtotime($user->created_at) ) }} </small>
                        </div>
                        <div class="col-6">
                            <small class="float-right">Updated  {{ date('d/m/Y', strtotime($user->updated_at) ) }} </small>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>              
    </div>
   <div class="row justify-content-center ">
       <div class="col-6  mb-3">
            <form style="display: inline-block" action="{{ route('user.destroy',['user'=>$user->id]) }}" method="post">
                @csrf
                @method('delete')
                <input type="hidden" name="user" value="{{$user->id }}">
                <input class="btn btn-sm btn-danger" type="submit" value="Remove">
            </form>
            <a class="btn btn-sm btn-primary" href="{{ route('user.edit',['user'=>$user->id]) }}">Edit</a>
           <a href="{{ route('user.index') }}" class="btn btn-sm btn-secondary float-right"> Back </a>
       </div>
   </div>
@endsection