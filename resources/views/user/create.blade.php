
@extends('_layouts.template')

@section('subtitle','Creating user')

@section('content')
    <div class="row">
        <div class="col-6 mt-5 mb-3">
            <h1>@yield('subtitle')</h1>
        </div>        
    </div>
    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Name">            
            @error('name')
                <small class="alert text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="email">            
            @error('email')
                <small class="alert text-danger">{{ $message }}</small>
            @enderror
        </div>   
        <div class="form-group">
            <input type="password"
                class="form-control  @error('password') is-invalid @enderror" name="password" id="password" aria-describedby="helpId" placeholder="Password">
                @error('password')
                    <small class="alert text-danger">{{ $message }}</small>
                @enderror
        </div>  
        <div class="form-group">
        <input type="password"
            class="form-control" name="password_confirmation" id="password-confirm" aria-describedby="helpId" placeholder="">
        </div>           
        <div class="row justify-content-end">
            <div class="btn-group mr-5 mb-3" role="group" aria-label="Basic example">
                <button class="btn btn-success " type="submit">Save</button>
                <a class="btn btn-secondary " href="{{ route('user.index') }}">To List</a>
            </div>
        </div>
    </form>
@endsection